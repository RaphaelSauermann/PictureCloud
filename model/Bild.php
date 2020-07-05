<?php

class Bild
{
    private $bid;
    private $name;
    private $owner; // references User ID
    private $pfad;
    private $aufnahmeDatum; // Datum, du dem das Bild aufgenommen wurde
    private $uploadDatum; // Datum der letzten Änderung
    private $isPublic;
    private $longitude;
    private $latitude;

    public function __construct($name, $owner, $pfad, $aufnahmeDatum, $isPublic, $longitude, $latitude)
    {
        $this->name = $name;
        $this->owner = $owner;
        $this->pfad = $pfad;
        $this->aufnahmeDatum = $aufnahmeDatum;
        $this->isPublic = $isPublic;
        $this->longitude = $longitude;
        $this->latitude = $latitude;
        if ($this->bid = $this->addToDB()) {
            echo "added to DB: ".$this->bid;
        }
    }

    public function addToDB()
    {
        $params[0] = $this->name;
        $params[1] = $this->owner;
        $params[2] = $this->pfad;
        $params[3] = $this->aufnahmeDatum;
        $params[4] = $this->isPublic;
        $params[5] = $this->longitude;
        $params[6] = $this->latitude;
        return addNewEntry("INSERT INTO bild(name,owner,pfad,aufnahmeDatum,isPublic,longitude,latitude) VALUES (?,?,?,?,?,?,?)", $params, $types = "sissidd");
    }

    public function getHTML($userStatus)
    {
      // echo code for generation of bildanzeige
    }

    public function getBid()
    {
        return $this->bid;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getOwner()
    {
        return $this->owner;
    }

    public function getPfad()
    {
        return $this->pfad;
    }

    public function getAufnahmeDatum()
    {
        return $this->aufnahmeDatum;
    }

    public function getUploadDatum()
    {
        return $this->uploadDatum;
    }

    public function getIsPublic()
    {
        return $this->isPublic;
    }

    public function getlongitude()
    {
        return $this->longitude;
    }

    public function getLatitude()
    {
        return $this->latitude;
    }

    public function setBid($bid): void
    {
        $this->bid = $bid;
    }

    public function setName($name): void
    {
        $this->name = $name;
    }

    public function setOwner($owner): void
    {
        $this->owner = $owner;
    }

    public function setPfad($pfad): void
    {
        $this->pfad = $pfad;
    }

    public function setAufnahmeDatum($aufnahmeDatum): void
    {
        $this->aufnahmeDatum = $aufnahmeDatum;
    }

    public function setUploadDatum($uploadDatum): void
    {
        $this->uploadDatum = $uploadDatum;
    }

    public function setIsPublic($isPublic): void
    {
        $this->isPublic = $isPublic;
    }

    public function setlongitude($longitude): void
    {
        $this->longitude = $longitude;
    }

    public function setLatitude($latitude): void
    {
        $this->latitude = $latitude;
    }
}
