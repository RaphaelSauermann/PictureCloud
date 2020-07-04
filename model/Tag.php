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
        $this->addToDB();
    }

    /* returns ID from DB */
    public function addToDB()
    {
        return addTag($this->name);
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
