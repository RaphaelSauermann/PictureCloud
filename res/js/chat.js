// variables to store values for chat functions
var sender;
var recipient;
var senderName;
var recipientName;
var workerRunning = 0;

/* from List of Users one is selected to chat with, this prints their Message History*/
function chooseUser(myId, theirId, myUsername, theirUsername) {
    // variables are set to allow access from different functions
    sender = myId;
    recipient = theirId;
    senderName = myUsername;
    recipientName = theirUsername;

    // replaces content from div "chat_content" with contents from url
    $.ajax({
        type: 'POST',
        url: 'inc/chat_messages.php',
        data: {myId: sender, theirId: recipient, myUsername: senderName, theirUsername: recipientName},
        success: function (result) {
            $("#chat_content").html(result);
        }
    });
    // enables fields for text input
    document.getElementById("inputFields").style.display = 'block';

    // activate Worker function for regular Updates of chat
    if (workerRunning === 0) {
        workerRunning = 1;
        worker();
    }

}

/* ends the chat and returns to List of Users to chat with */
function backToUserlist() {
    // disables worker
    workerRunning = 0;
    // disables input fields 
    document.getElementById("inputFields").style.display = 'none';
    $.ajax({
        success: function () {
            $("#chat_content").html(document.getElementById('userlist').innerHTML);
        }
    });
}

/* ajax call to send message and save it in JSON file*/
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
            // calls "chooseUser" to update chatHistory
            chooseUser(sender, recipient, senderName, recipientName);
        }
    });
    document.getElementById('msg').value = "";
}

/* worker function, regularly updates the chat history window */
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


/* opens the chat box */
function openForm() {
    document.getElementById("myForm").style.display = "block";
}

/* closes the chat box */
function closeForm() {
    document.getElementById("myForm").style.display = "none";
}
