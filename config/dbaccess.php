<?php 
function connectDB() {
    $servername = "localhost";
    $username = "root";
    $password = "123abc123";
    $dbname = "picturecloud";

    // connection with Database
    $db = new mysqli($servername, $username, $password, $dbname);

    // check connection
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

    return $db;
}
