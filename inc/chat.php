<!-- creates a button at the bottom of the page for chat functionality-->

<?php
// creates a List of all Users available for Chat
$userList = getAllUsers();
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


<!-- Button which opens chat window -->
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
            <input type="text" name="msg" id="msg" style="width:434px;" required>
            <button type = "button" class = "btn btn-success" id="sendMsg" onclick="sendMessage()">Send</button>
        </div>

        <button type = "button" class = "btn btn-danger" onclick = "closeForm()">Close</button>
    </form>
</div>
