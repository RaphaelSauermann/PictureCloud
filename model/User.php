<?php

class User {

    private $uid;
    private $username;
    private $passwort;
    private $anrede;
    private $vorname;
    private $nachname;
    private $adresse;
    private $plz;
    private $ort;
    private $email;
    private $isAdmin;
    private $isActive;

    function __construct($uid, $username, $passwort, $anrede, $vorname, $nachname, $adresse, $plz, $ort, $email, $isAdmin, $isActive) {
        $this->uid = $uid;
        $this->username = $username;
        $this->passwort = $passwort;
        $this->anrede = $anrede;
        $this->vorname = $vorname;
        $this->nachname = $nachname;
        $this->adresse = $adresse;
        $this->plz = $plz;
        $this->ort = $ort;
        $this->email = $email;
        $this->isAdmin = $isAdmin;
        $this->isActive = $isActive;
    }

    function addToDB() {
        $params[0] = $this->username;
        $params[1] = $this->passwort;
        $params[2] = $this->anrede;
        $params[3] = $this->vorname;
        $params[4] = $this->nachname;
        $params[5] = $this->adresse;
        $params[6] = $this->plz;
        $params[7] = $this->ort;
        $params[8] = $this->email;
        return addNewEntry("INSERT INTO user (username, passwort, anrede, vorname, nachname, adresse, plz, ort, email) VALUES (?,?,?,?,?,?,?,?,?)", $params, $types = "ssssssiss");
    }

    function changeUserPassword($old_password, $new_password) {
        $success = FALSE;
        if (password_verify($old_password, $this->getPasswort())) {
            $pw = password_hash($new_password, PASSWORD_DEFAULT); // Hashes PW
            $userId = $this->getUid();
            $db = connectDB();
            if (($stmt = $db->prepare("UPDATE user SET passwort = ? WHERE uid = ?"))) {
                $stmt->bind_param("si", $pw, $userId);
                $success = $stmt->execute();
            }
            $stmt->close();
            $db->close();
        }
        return $success;
    }

    function updateUserData() {
        $success = FALSE;

        $db = connectDB();
        if (($stmt = $db->prepare("UPDATE user SET anrede = ?, vorname = ?, nachname = ?, adresse = ?, plz = ?, ort = ?, email = ? WHERE uid = ?"))) {
            $stmt->bind_param("ssssissi", $this->anrede, $this->vorname, $this->nachname, $this->adresse, $this->plz, $this->ort, $this->email, $this->uid);
            $success = $stmt->execute();
        }
        $stmt->close();
        $db->close();
        return $success;
    }

    function getUid() {
        return $this->uid;
    }

    function getUsername() {
        return $this->username;
    }

    function getPasswort() {
        return $this->passwort;
    }

    function getAnrede() {
        return $this->anrede;
    }

    function getVorname() {
        return $this->vorname;
    }

    function getNachname() {
        return $this->nachname;
    }

    function getAdresse() {
        return $this->adresse;
    }

    function getPlz() {
        return $this->plz;
    }

    function getOrt() {
        return $this->ort;
    }

    function getEmail() {
        return $this->email;
    }

    function getIsAdmin() {
        return $this->isAdmin;
    }

    function getIsActive() {
        return $this->isActive;
    }

    function setUid($uid): void {
        $this->uid = $uid;
    }

    function setUsername($username): void {
        $this->username = $username;
    }

    function setPasswort($passwort): void {
        $this->passwort = $passwort;
    }

    function setAnrede($anrede): void {
        $this->anrede = $anrede;
    }

    function setVorname($vorname): void {
        $this->vorname = $vorname;
    }

    function setNachname($nachname): void {
        $this->nachname = $nachname;
    }

    function setAdresse($adresse): void {
        $this->adresse = $adresse;
    }

    function setPlz($plz): void {
        $this->plz = $plz;
    }

    function setOrt($ort): void {
        $this->ort = $ort;
    }

    function setEmail($email): void {
        $this->email = $email;
    }

    function setIsAdmin($isAdmin): void {
        $this->isAdmin = $isAdmin;
    }

    function setIsActive($isActive): void {
        $this->isActive = $isActive;
    }

}
