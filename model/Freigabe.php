<?php

class Freigabe {

    private $uid; // refences User ID
    private $bid; // references Bild ID

    function __construct($uid, $bid) {
        $this->uid = $uid;
        $this->bid = $bid;
    }

    function getUid() {
        return $this->uid;
    }

    function getBid() {
        return $this->bid;
    }

    function setUid($uid): void {
        $this->uid = $uid;
    }

    function setBid($bid): void {
        $this->bid = $bid;
    }

}
