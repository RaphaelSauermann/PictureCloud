<?php

/**
 * SQL INSERT
 * 
 * prepare(): defines the statement
 * bind_param(): defines datatypes:  i - integer; d - double; s - string; b - BLOB
 * execute(): executes statement
 * close(): closes statement
 */
switch (true) {
    case filter_has_var(INPUT_POST, "newBild"):
        echo "Bild";
        // newBild();
        break;
    case filter_has_var(INPUT_POST, "newFreigabe"):
        echo "Freigabe";
        // newFreigabe();
        break;
    case filter_has_var(INPUT_POST, "newNachricht"):
        echo "Nachricht";
        // newNachricht();
        break;
    case filter_has_var(INPUT_POST, "newTag"):
        echo "Tag";
        // newTag();
        break;
    case filter_has_var(INPUT_POST, "newTagOnBild"):
        echo "TagOnBild";
        // newTagOnBild();
        break;
    case filter_has_var(INPUT_POST, "newUser"):
        echo "User";
        // newUser();
        break;
}

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

function newBild() {
    $db = connectDB();

    $stmt = $db->prepare("INSERT INTO bild (name, owner, pfad, aufnahmeDatum, isPublic, longitute, latitude) VALUES (?,?,?,?,?,?,?)");
    $stmt->bind_param("sissidd", $name, $owner, $pfad, $aufnahmeDatum, $isPublic, $longitute, $latitude);

    $name = filter_input(INPUT_POST, "name");
    $owner = filter_input(INPUT_POST, "owner");
    $pfad = filter_input(INPUT_POST, "pfad");
    $aufnahmeDatum = filter_input(INPUT_POST, "aufnahmeDatum");
    // $uploadDatum; done by Database
    $isPublic = filter_input(INPUT_POST, "isPublic");
    $longitute = filter_input(INPUT_POST, "longitute");
    $latitude = filter_input(INPUT_POST, "latitude");

    $stmt->execute();
    $stmt->close();
    $db->close();
}

function newFreigabe() {
    $db = connectDB();

    $stmt = $db->prepare("INSERT INTO freigabe (uid, bid) VALUES (?, ?)");
    $stmt->bind_param("ii", $uid, $bid);

    $uid = filter_input(INPUT_POST, "uid");
    $bid = filter_input(INPUT_POST, "bid");

    $stmt->execute();
    $stmt->close();
    $db->close();
}

function newNachricht() {
    $db = connectDB();

    $stmt = $db->prepare("INSERT INTO nachricht (vonID, zuID, message) VALUES (?,?,?)");
    $stmt->bind_param("", $vonID, $zuID, $message);

    $vonID = filter_input(INPUT_POST, "vonID");
    $zuID = filter_input(INPUT_POST, "zuID");
    //$isRead = 0; // FALSE; default - managed by Database
    $message = filter_input(INPUT_POST, "message");
    //$absendeDatum = current_timestamp(); default - managed by Database

    $stmt->execute();
    $stmt->close();
    $db->close();
}

function newTag() {
    $db = connectDB();

    $stmt = $db->prepare("INSERT INTO tag (name) VALUES (?)");
    $stmt->bind_param("s", $tagname);

    $tagname = filter_input(INPUT_POST, "tagname");

    $stmt->execute();
    $stmt->close();
    $db->close();
}

function newTagOnBild() {
    $db = connectDB();

    $stmt = $db->prepare("INSERT INTO tagonbild (bid, tid) VALUES (?, ?)");
    $stmt->bind_param("ii", $bid, $tid);

    $bid = filter_input(INPUT_POST, "bid");
    $tid = filter_input(INPUT_POST, "tid");

    $stmt->execute();
    $stmt->close();
    $db->close();
}

function newUser() {
    $db = connectDB();

    // TODO Check if username is unique!

    $stmt = $db->prepare("INSERT INTO user (username, passwort, anrede, vorname, nachname, adresse, plz, ort, email) VALUES (?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param("ssssssiss", $username, $passwort, $anrede, $vorname, $nachname, $adresse, $plz, $ort, $email);

    $username = filter_input(INPUT_POST, "username");
    $passwort = filter_input(INPUT_POST, "passwort");
    $anrede = filter_input(INPUT_POST, "anrede");
    $vorname = filter_input(INPUT_POST, "vorname");
    $nachname = filter_input(INPUT_POST, "nachname");
    $adresse = filter_input(INPUT_POST, "adresse");
    $plz = filter_input(INPUT_POST, "plz");
    $ort = filter_input(INPUT_POST, "ort");
    $email = filter_input(INPUT_POST, "email");
    //$isAdmin = 0; // FALSE; default - managaged by Database
    //$isActive = 1; // TRUE; default - managed by Database

    $stmt->execute();
    $stmt->close();
    $db->close();
}
