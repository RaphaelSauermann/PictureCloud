<?php

$userObject = getUserById($_SESSION['uid']);

echo "<h2> Willkommen " . $userObject->getVorname() . "!</h2>";

echo "<h5> Profilverwaltung </h5>";

include 'inc/userpage_regular.php';

if ($userObject->getIsAdmin() !== 0) {
    include 'inc/userpage_admin.php';   
}
?>