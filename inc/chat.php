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
    $tempUserObject = getUserById($user);
    $userlist .= '<button type="button" class="btn btn-light" onclick="chooseUser(' . $_SESSION['uid'] . ',' . $tempUserObject->getUid() . ',\'' . $_SESSION['username'] . '\',\'' . $tempUserObject->getUsername() . '\')">' . $tempUserObject->getUsername() . '</button>';
}
$userlist .= '</div>';

// Überschrift, "Message User "_username_"
$messageTitle = '<label for="msg"><b>Message User <i>"' . filter_input(INPUT_GET, "theirUsername") . '"</i></b></label>';
$messageTitle .= '<hr>';
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
        <div id="messageTitle" hidden><?php echo $messageTitle ?></div>
        <div id="chat_content">
            <!-- creates buttons for all users, on click opens chat with user -->
            <?php echo $userlist ?>
        </div>
        <div id="inputFields" style="display: none;">
            <input type="text" name="msg" id="msg" required>
            <button type = "button" class = "btn btn-success" id="sendMsg">Send</button>
        </div>

        <button type = "button" class = "btn btn-danger" onclick = "closeForm()">Close</button>
    </form>
</div>










<script>

    function chooseUser(myId, theirId, myUsername, theirUsername) {
        $.ajax({
            // replaces content from div "chat_content" with contents from url
            type: 'GET',
            url: 'inc/chat_messages.php',
            data: {myId: myId, theirId: theirId, myUsername: myUsername, theirUsername: theirUsername},
            success: function (result) {
                $("#chat_content").html(result);
            }
        });
        document.getElementById("inputFields").style.display = 'block';
    }




    function backToUserlist() {
        document.getElementById("inputFields").style.display = 'none';
        $.ajax({
            success: function () {
                $("#chat_content").html(document.getElementById('userlist').innerHTML);
            }
        });
    }



    function openForm() {
        document.getElementById("myForm").style.display = "block";
    }

    function closeForm() {
        document.getElementById("myForm").style.display = "none";
    }


</script>
