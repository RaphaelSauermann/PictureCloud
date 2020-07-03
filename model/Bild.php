<?php

class Bild {

    private $bid;
    private $name;
    private $owner; // references User ID
    private $pfad;
    private $aufnahmeDatum; // Datum, du dem das Bild aufgenommen wurde
    private $uploadDatum; // Datum der letzten Änderung
    private $isPublic;
    private $longitute;
    private $latitude;

    function __construct($bid, $name, $owner, $pfad, $aufnahmeDatum, $uploadDatum, $isPublic, $longitute, $latitude) {
        $this->bid = $bid;
        $this->name = $name;
        $this->owner = $owner;
        $this->pfad = $pfad;
        $this->aufnahmeDatum = $aufnahmeDatum;
        $this->uploadDatum = $uploadDatum;
        $this->isPublic = $isPublic;
        $this->longitute = $longitute;
        $this->latitude = $latitude;
    }

    function getBid() {
        return $this->bid;
    }

    function getName() {
        return $this->name;
    }

    function getOwner() {
        return $this->owner;
    }

    function getPfad() {
        return $this->pfad;
    }

    function getAufnahmeDatum() {
        return $this->aufnahmeDatum;
    }

    function getUploadDatum() {
        return $this->uploadDatum;
    }

    function getIsPublic() {
        return $this->isPublic;
    }

    function getLongitute() {
        return $this->longitute;
    }

    function getLatitude() {
        return $this->latitude;
    }

    function setBid($bid): void {
        $this->bid = $bid;
    }

    function setName($name): void {
        $this->name = $name;
    }

    function setOwner($owner): void {
        $this->owner = $owner;
    }

    function setPfad($pfad): void {
        $this->pfad = $pfad;
    }

    function setAufnahmeDatum($aufnahmeDatum): void {
        $this->aufnahmeDatum = $aufnahmeDatum;
    }

    function setUploadDatum($uploadDatum): void {
        $this->uploadDatum = $uploadDatum;
    }

    function setIsPublic($isPublic): void {
        $this->isPublic = $isPublic;
    }

    function setLongitute($longitute): void {
        $this->longitute = $longitute;
    }

    function setLatitude($latitude): void {
        $this->latitude = $latitude;
    }

}
