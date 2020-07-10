<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$userList = getAllUsers();
?>



<button class="chat-open-button" onclick="openForm()">Chat</button>

<div class="chat-popup" id="myForm">
    <form action="" class="chat-form-container">
        <div class="row">
            <div class="col-md-8">
                <h3>Chat</h3>
            </div>
            <div class="col-md-4">
                <!-- <button type = "button" style="float: right;" class = "btn btn-outline-secondary" onclick = "backToUserlist()">Back</button> -->
            </div>
        </div>
        <div id="chat_content">
            <!-- creates buttons for all users, on click opens chat with user -->
            <?php include "inc/chat_userlist.php" ?>
        </div>

        <button type = "button" class = "btn btn-danger" onclick = "closeForm()">Close</button>
    </form>
</div>

<script>
    $(document).ready(function () {
        $('#userIdButton1').click(function () {
            $.ajax({
                success: function (data, textStatus, jqXHR) {
                    alert('YES');
                }
                //url: 'inc/testChat.php'
            });
        });
    });

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
    }
    function backToUserlist() {
        $.ajax({
            // replaces content from div "chat_content" with contents from url
            type: 'GET',
            url: 'inc/chat_userlist.php',
            success: function (result) {
                $("#chat_content").html(result);
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
