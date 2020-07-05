<?php

function userLogin($username, $passwort) {
    $db = connectDB();

    if ($stmt = $db->prepare("SELECT uid, username, passwort FROM user WHERE username = ?")) {

        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->bind_result($db_uid, $db_username, $db_passwort);

        // bekommt alle zutreffenden rows, username ist unique also kann nur max. eine row geliefert werden
        $stmt->fetch();

        // stimmt das eingegebene PW und das in der DB überein, wird die Session auf angemeldet gesetzt.
        if ($passwort === $db_passwort) {
            $valid = TRUE;
            $_SESSION['uid'] = $db_uid;
            $_SESSION['username'] = $db_username;
            $_SESSION["loginStatus"] = TRUE;
        } else {
            $valid = FALSE;
        }
    }

    $stmt->close();
    $db->close();
    return $valid;
}

function userRegister() {
    $username = filter_input(INPUT_POST, "username");
    $passwort = filter_input(INPUT_POST, "password");
    $anrede = filter_input(INPUT_POST, "anrede");
    $vorname = filter_input(INPUT_POST, "vorname");
    $nachname = filter_input(INPUT_POST, "nachname");
    $adresse = filter_input(INPUT_POST, "adresse");
    $plz = filter_input(INPUT_POST, "plz");
    $ort = filter_input(INPUT_POST, "ort");
    $email = filter_input(INPUT_POST, "email");

    new User($username, $passwort, $anrede, $vorname, $nachname, $adresse, $plz, $ort, $email);
}

function userExists($username) {
    $db = connectDB();

    // selects for username and counts rows returned - 0 rows -> username available
    if ($stmt = $db->prepare("SELECT username FROM user WHERE username = ?")) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $exists = TRUE;
        } else {
            $exists = FALSE;
        }
    }

    $stmt->close();
    $db->close();
    return $exists;
}
