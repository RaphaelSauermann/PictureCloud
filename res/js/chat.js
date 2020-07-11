// variables to store values for chat functions
var sender;
var recipient;
var senderName;
var recipientName;
var workerRunning = 0;

function chooseUser(myId, theirId, myUsername, theirUsername) {
    sender = myId;
    recipient = theirId;
    senderName = myUsername;
    recipientName = theirUsername;
    $.ajax({
        // replaces content from div "chat_content" with contents from url
        type: 'POST',
        url: 'inc/chat_messages.php',
        data: {myId: sender, theirId: recipient, myUsername: senderName, theirUsername: recipientName},
        success: function (result) {
            $("#chat_content").html(result);
        }
    });
    document.getElementById("inputFields").style.display = 'block';
    // activate Worker function for regular Updates of chat
    if (workerRunning === 0) {
        workerRunning = 1;
        //worker();
    }

}


function backToUserlist() {
    // disables worker
    workerRunning = 0;
    document.getElementById("inputFields").style.display = 'none';
    $.ajax({
        success: function () {
            $("#chat_content").html(document.getElementById('userlist').innerHTML);
        }
    });
}

function sendMessage() {
    var msg = $("#msg").val();
    if (msg.length === 0)
    {
        alert("Enter a message first!");
        return;
    }

    var messageData = {
        sender: sender,
        recipient: recipient,
        senderName: senderName,
        recipientName: recipientName,
        message: msg,
        timestamp: new Date().toISOString().slice(0, 19).replace('T', ' '),
        read: 0
    };
    $.ajax({
        type: "POST",
        url: "inc/chat_send.php",
        data: messageData,
        success: function (result) {
            chooseUser(sender, recipient, senderName, recipientName);
        }
    });
    document.getElementById('msg').value = "";
}

// worker function, regularly updates the chat window
function worker() {
    if (workerRunning) {
        $.ajax({
            // replaces content from div "chat_content" with contents from url
            type: 'POST',
            url: 'inc/chat_messages.php',
            data: {myId: sender, theirId: recipient, myUsername: senderName, theirUsername: recipientName},
            success: function (result) {
                chooseUser(sender, recipient, senderName, recipientName);
            },
            complete: function () {
                // Schedule the next request when the current one is complete
                setTimeout(worker, 3000);
            }
        });
    }
}



function openForm() {
    document.getElementById("myForm").style.display = "block";
}

function closeForm() {
    document.getElementById("myForm").style.display = "none";
}
