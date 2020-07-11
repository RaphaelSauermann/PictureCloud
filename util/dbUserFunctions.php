<?php

/* User Login function, checks if input username and password are correct */

function userLogin($username, $passwort) {
    $db = connectDB();

    // gets Userdata from Database 
    if (($stmt = $db->prepare("SELECT uid, username, passwort, isAdmin, isActive FROM user WHERE username = ?"))) {

        // check with given username input, fields are saved with bind_result
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->bind_result($db_uid, $db_username, $db_passwort, $db_isAdmin, $db_isActive);

        // gets the next row from result, username is unique therefore only one (or none) row is selected
        $stmt->fetch();

        // compare input password with hashed password from db, on success set Session vaiables
        if (password_verify($passwort, $db_passwort)) {
            if ($db_isActive == 0) {
                $valid = 2; // login is valid, but user is inactive and not allowed to log in
            } else {
                $valid = 1; // user login is valid
                $_SESSION['uid'] = $db_uid;
                $_SESSION['username'] = $db_username;
                $_SESSION["loginStatus"] = TRUE;
                $_SESSION["isAdmin"] = $db_isAdmin;
            }
        } else {
            $valid = 0; // login is invalid
        }
    }
    $stmt->close();
    $db->close();
    return $valid;
}

/* User Register Function */

function userRegister() {
    // takes values from POST Form and tries to insert into DB
    $username = filter_input(INPUT_POST, "username");
    $passwort = password_hash(filter_input(INPUT_POST, "password"), PASSWORD_DEFAULT); // Hashes PW
    $anrede = filter_input(INPUT_POST, "anrede");
    $vorname = filter_input(INPUT_POST, "vorname");
    $nachname = filter_input(INPUT_POST, "nachname");
    $adresse = filter_input(INPUT_POST, "adresse");
    $plz = filter_input(INPUT_POST, "plz");
    $ort = filter_input(INPUT_POST, "ort");
    $email = filter_input(INPUT_POST, "email");

    // null values are managed by Database, Object is only used to insert
    $registerUser = new User(null, $username, $passwort, $anrede, $vorname, $nachname, $adresse, $plz, $ort, $email, null, null);
    return $registerUser->addToDB();
}

/* checks if a Username already exists or is available */

function userExists($username) {
    $db = connectDB();

    // selects for username and counts rows returned - 0 rows -> username available
    if (($stmt = $db->prepare("SELECT username FROM user WHERE username = ?"))) {
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

/* gets a User by thair ID to display information */

function getUserById($userId) {
    $db = connectDB();

    if (($stmt = $db->prepare("SELECT uid, username, passwort, anrede, vorname, nachname, adresse, plz, ort, email, isAdmin, isActive FROM user WHERE uid = ?"))) {
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $stmt->bind_result($uid, $username, $passwort, $anrede, $vorname, $nachname, $adresse, $plz, $ort, $email, $isAdmin, $isActive);
        $stmt->fetch(); // because ID is the key, only one (or none) row can be returned
        $userObject = new User($uid, $username, $passwort, $anrede, $vorname, $nachname, $adresse, $plz, $ort, $email, $isAdmin, $isActive);
    }
    $stmt->close();
    $db->close();
    return $userObject;
}

/* gets a List with all UserIDs in DB */

function getAllUsers() {
    $db = connectDB();

    if (($stmt = $db->prepare("SELECT uid FROM user"))) {
        $stmt->execute();
        $stmt->bind_result($db_uid);

        // on each call fetch() gets the next row from result set
        while ($stmt->fetch()) {
            $userIdList[] = $db_uid;
        }
    }

    $stmt->close();
    $db->close();
    return $userIdList;
}

/* Used to show Admins permissions of pictures of users during user management */

function getPicsFromUser($userId) {
    $db = connectDB();

    $pictureList = [];
    if (($stmt = $db->prepare("SELECT bid, name, isPublic FROM bild WHERE owner = ?"))) {
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $stmt->bind_result($db_bid, $db_name, $db_isPublic);

        // fetch() liefert beim Aufruf immer die nächste row solange es noch welche gibt
        while ($stmt->fetch()) {
            $pictureList[] = new Bild($db_bid, $db_name, $userId, null, null, $db_isPublic, null, null);
        }
    }

    $stmt->close();
    $db->close();
    return $pictureList;
}

/* Admins can set Users to be active or inactive, disabling their login */

function setIsActiveStatus($userID, $newStatus) {
    $db = connectDB();

    if (($stmt = $db->prepare("UPDATE user SET isActive = ? WHERE uid = ?"))) {
        $stmt->bind_param("ii", $newStatus, $userID);
        $success = $stmt->execute();
    }
    $stmt->close();
    $db->close();
    return $success;
}
