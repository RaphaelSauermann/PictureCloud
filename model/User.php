<?php

class Patient {

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
