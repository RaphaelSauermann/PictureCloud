<?php

class Nachricht {

    private $nID;
    private $vonID; // User ID von dem die Nachricht kommt
    private $zuID; // User ID an den die Nachricht geht
    private $isRead;
    private $message;
    private $absendeDatum;

    function __construct($nID, $vonID, $zuID, $isRead, $message, $absendeDatum) {
        $this->nID = $nID;
        $this->vonID = $vonID;
        $this->zuID = $zuID;
        $this->isRead = $isRead;
        $this->message = $message;
        $this->absendeDatum = $absendeDatum;
    }

    function getNID() {
        return $this->nID;
    }

    function setNID($nID): void {
        $this->nID = $nID;
    }

    function getVonID() {
        return $this->vonID;
    }

    function getZuID() {
        return $this->zuID;
    }

    function getIsRead() {
        return $this->isRead;
    }

    function getMessage() {
        return $this->message;
    }

    function getAbsendeDatum() {
        return $this->absendeDatum;
    }

    function setVonID($vonID): void {
        $this->vonID = $vonID;
    }

    function setZuID($zuID): void {
        $this->zuID = $zuID;
    }

    function setIsRead($isRead): void {
        $this->isRead = $isRead;
    }

    function setMessage($message): void {
        $this->message = $message;
    }

    function setAbsendeDatum($absendeDatum): void {
        $this->absendeDatum = $absendeDatum;
    }

}
