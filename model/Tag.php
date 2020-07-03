<?php

class Tag {

    private $tid;
    private $name;

    function __construct($tid, $name) {
        $this->tid = $tid;
        $this->name = $name;
    }

    function getTid() {
        return $this->tid;
    }

    function getName() {
        return $this->name;
    }

    function setTid($tid): void {
        $this->tid = $tid;
    }

    function setName($name): void {
        $this->name = $name;
    }

}
