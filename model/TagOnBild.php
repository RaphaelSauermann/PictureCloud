<?php

class TagOnBild {

    private $bid; // refernces Bild ID
    private $tid; // references Tag ID

    function __construct($bid, $tid) {
        $this->bid = $bid;
        $this->tid = $tid;
    }

    function getBid() {
        return $this->bid;
    }

    function getTid() {
        return $this->tid;
    }

    function setBid($bid): void {
        $this->bid = $bid;
    }

    function setTid($tid): void {
        $this->tid = $tid;
    }

}
