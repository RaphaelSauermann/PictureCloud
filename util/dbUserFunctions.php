<?php

function userLogin($username, $passwort) {
    $db = connectDB();

    if ($stmt = $db->prepare("SELECT passwort FROM user WHERE username = ?")) {

        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->bind_result($db_passwort);

        // bekommt alle zutreffenden rows, username ist unique also kann nur max. eine row geliefert werden
        $stmt->fetch();
        if ($passwort === $db_passwort) {
            $valid = TRUE;
        } else {
            $valid = FALSE;
        }
        $stmt->close();
        return $valid;
    }
}

//SELECT * FROM user WHERE username = "User1" AND passwort = "abc123"

