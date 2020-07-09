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

    public function __construct($bid, $name, $owner, $pfad, $aufnahmeDatum, $isPublic, $longitude, $latitude)
    {
        $this->bid = $bid;
        $this->name = $name;
        $this->owner = $owner;
        $this->pfad = $pfad;
        $this->aufnahmeDatum = $aufnahmeDatum;
        $this->isPublic = $isPublic;
        $this->longitude = $longitude;
        $this->latitude = $latitude;
    }

    public function getHTML($userStatus)
    {
      echo $this->bid;
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
