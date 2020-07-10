<?php

// Userlist
echo '<div class="list-group">';

foreach ($userList as $user) {
    $tempUserObject = getUserById($user);
    echo '<button type="button" class="btn btn-light" id="userIdButton" onclick="chooseUser(' . $_SESSION['uid'] . ',' . $tempUserObject->getUid() . ',\'' . $_SESSION['username'] . '\',\'' . $tempUserObject->getUsername() . '\')">' . $tempUserObject->getUsername() . '</button>';
}
//echo '<button type = "button" class = "btn btn-light" id = "userIdButton">' . $tempUserObject->getUsername() . '</button>';
echo '</div>';