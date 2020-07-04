<?php

class Tag
{
    private $tid;
    private $name;

    // function __construct($tid, $name) {
    //     $this->tid = $tid;
    //     $this->name = $name;
    // }

    public function __construct($name)
    {
        // $this->tid = $tid;
        $this->name = $name;
        if ($this->tid = $this->addToDB()) {
            echo "added to DB: ".$this->tid;
        }
    }

    /* returns ID from DB */
    public function addToDB()
    {
        $params[0] = $this->name;
        return addNewEntry("INSERT INTO tag(name) VALUES (?)", $params, $types = "s");
    }

    public function getTid()
    {
        return $this->tid;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setTid($tid): void
    {
        $this->tid = $tid;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }
}
