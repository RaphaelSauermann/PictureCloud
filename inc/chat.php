<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$userList = getAllUsers();

// Userlist
$userlist = '<div class="list-group">';
foreach ($userList as $user) {
    // oneself is excluded from chat list
    if ($user !== $_SESSION['uid']) {
        $tempUserObject = getUserById($user);
        $userlist .= '<button type="button" class="btn btn-light" onclick="chooseUser(' . $_SESSION['uid'] . ',' . $tempUserObject->getUid() . ',\'' . $_SESSION['username'] . '\',\'' . $tempUserObject->getUsername() . '\')">' . $tempUserObject->getUsername();
        if ($tempUserObject->getIsActive()) {
            $userlist .= ' <i style="color:green;">active</i>';
        } else {
            $userlist .= ' <i style="color:red;">inactive</i>';
        }
        $userlist .= '</button>';
    }
}
$userlist .= '</div>';
?>



<button class="chat-open-button" onclick="openForm()">Chat</button>

<div class="chat-popup" id="myForm">
    <form action="" class="chat-form-container">
        <div class="row">
            <div class="col-md-8">
                <h3>Chat</h3>
            </div>
            <div class="col-md-4">
                <button type = "button" style="float: right;" class = "btn btn-outline-secondary" onclick = "backToUserlist()">Back</button>
            </div>
        </div>
        <div id="userlist" hidden><?php echo $userlist ?></div>
        <div id="chat_content">
            <!-- creates buttons for all users, on click opens chat with user -->
            <?php echo $userlist ?>
        </div>
        <div id="inputFields" style="display: none;">
            <input type="text" name="msg" id="msg" required>
            <button type = "button" class = "btn btn-success" id="sendMsg" onclick="sendMessage()">Send</button>
        </div>

        <button type = "button" class = "btn btn-danger" onclick = "closeForm()">Close</button>
    </form>
</div>





<script>
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
            worker();
        }

    }


    function backToUserlist() {
        document.getElementById("inputFields").style.display = 'none';
        $.ajax({
            success: function () {
                $("#chat_content").html(document.getElementById('userlist').innerHTML);
            }
        });
        workerRunning = 0;
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
                    // Schedule the next request when the current one's complete
                    setTimeout(worker(), 3000);
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


</script>
