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

    public function getHTML()
    {
        /* get additonal information */
        $zusatzInfos = getBildAdditonalInformation($this);
        if (empty($this->uploadDatum)) {
            $this->uploadDatum = $zusatzInfos["uploadDatum"];
        }

        /* setting the visability levels (write or readable or part part)*/
        if ($zusatzInfos["status"]=="admin") {
        } elseif ($zusatzInfos["owner"]) {
            // code...
        } else {
        }

        // Todos: get name of owner; get UpdateDatum; get Tags; get freigaben
        echo '<div class="container" id="bild'.$this->bid.'">';
        echo '<div class="card" style="width: 1/3%;">';
        echo '<!-- thumbnail -->';
        echo '<img src="'.$this->pfad.'" class="card-img-top" alt="">';
        echo '<div class="card-body">';
        echo '<!-- Button zum aufklappen -->';
        echo '<a class="btn btn-outline-dark" data-toggle="collapse" href="#collapseBild'.$this->bid.'" role="button" aria-expanded="true" aria-controls="collapseExample">';
        echo '+/- Zusatzinfos';
        echo '</a>';
        echo '<!-- aufklappbare zusatzinfos -->';
        echo '<div class="container collapse show" id="collapseBild'.$this->bid.'">';
        echo '<form action="index.php?page=pics" method="post">';
        echo '<!-- Anzeige der Attribute des Bildes -->';
        echo '<div class="row">';
        echo '<div class="col">';
        echo '<!-- Bildname -->';
        echo '<div class="form-group">';
        echo '<label for="formGroupExampleInput">Bildname</label>';
        echo '<input type="text" class="form-control" name="name" id="name'.$this->bid.'" value="'.$this->name.'">';
        echo '</div>';
        echo '</div>';
        echo '<div class="col">';
        echo '<!-- Bildowner -->';
        echo '<div class="form-group">';
        echo '<label for="formGroupExampleInput2">Owner</label>';
        echo '<input type="text" class="form-control" name="owner" id="owner'.$this->bid.'" value="'.$zusatzInfos["ownerName"].'">';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '<div class="row">';
        echo '<div class="col">';
        echo '<!-- Änderungsdatum -->';
        echo '<div class="form-group">';
        echo '<label for="uploadDatum'.$this->bid.'">Änderungsdatum</label>';
        echo '<input type="text" class="form-control" name="uploadDatum" id="uploadDatum'.$this->bid.'" value="'.$this->uploadDatum.'">';
        echo '</div>';
        echo '</div>';
        echo '<div class="col">';
        echo '<!-- Aufnahmedatum -->';
        echo '<div class="form-group">';
        echo '<label for="aufnahmeDatum'.$this->bid.'">Aufnahmedatum</label>';
        echo '<input type="text" class="form-control" name="aufnahmeDatum" id="aufnahmeDatum'.$this->bid.'" value="'.$this->aufnahmeDatum.'">';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '<div class="row">';
        echo '<div class="col-sm-3">';
        echo '<!-- Latitude -->';
        echo '<div class="form-group">';
        echo '<label for="latitude'.$this->bid.'">Latitude</label>';
        echo '<input type="text" class="form-control" name="latitude" id="latitude'.$this->bid.'" value="'.$this->latitude.'">';
        echo '</div>';
        echo '</div>';
        echo '<div class="col-sm-3">';
        echo '<!-- Longitude -->';
        echo '<div class="form-group">';
        echo '<label for="longitude'.$this->bid.'">Longitude</label>';
        echo '<input type="text" class="form-control" name="longitude" id="longitude'.$this->bid.'" value="'.$this->longitude.'">';
        echo '</div>';
        echo '</div>';
        echo '<div class="col-sm-6">';
        echo '<!-- is Public & update -->';
        echo '<div class="form-group">';
        echo '<div class="form-check">';
        echo '<input type="text" class="" name="bid" value="'.$this->bid.'" hidden>';
        echo '<input class="form-check-input" name="isPublic" type="checkbox" value="1" id="isPublic'.$this->bid.'">';
        echo '<label class="form-check-label" for="isPublic'.$this->bid.'">';
        echo 'is Public';
        echo '</label>';
        echo '</div>';
        echo '</div>';
        // echo '<a href="#" class="btn-sm btn-primary">Update felder</a>';
        echo '<input type="submit" class="btn-sm btn-primary" value="Update felder" />';
        echo '<a href="index.php?page=pics&deleteBild='.$this->bid.'" class="btn-sm btn-danger">Bild löschen</a>';
        echo '</div>';
        echo '</div>';
        echo '</form>';
        echo '<!-- Spacer -->';
        echo '<hr />';
        echo '<!-- Anzeige alles TAGS -->';
        echo '<div class="row">';
        echo '<div class="col">';
        echo '<div class="list-group">';
        echo '<li class="list-group-item disabled" aria-disabled="true">Tags</li>';
        foreach ($zusatzInfos["tags"] as $key => $value) {
            // print for all tags
            echo '<a href="index.php?page=pics&deleteTagTag='.$value.'&delteTagBild='.$this->bid.'" class="list-group-item list-group-item-action">'.$value.'</a>';
        }
        // echo '<a href="" class="list-group-item list-group-item-action">Meer</a>';
        // echo '<a href="" class="list-group-item list-group-item-action">Berge</a>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '<!-- Hinzufügen von TAGS -->';
        echo '<form action="index.php?page=pics" method="post">';
        echo '<div class="input-group mb-3">';
        echo '<input type="text" class="form-control" name="newTag" placeholder="neuer Tag" aria-label="neuer Tag" aria-describedby="button-addon">';
        echo '<input type="text" class="" name="bid" value="'.$this->bid.'" hidden>';
        echo '<div class="input-group-append">';
        // echo '<button class="btn btn-outline-secondary" type="button" id="addTagButton'.$this->bid.'">hinzufügen</button>';
        echo '<input type="submit" class="btn btn-outline-secondary" value="Tag hinzufügen" />';
        echo '</div>';
        echo '</div>';
        echo '</form>';
        echo '<!-- Spacer -->';
        echo '<hr />';
        echo '<!-- Anzeige der Freigaben -->';
        echo '<div class="row">';
        echo '<div class="col">';
        echo '<div class="list-group">';
        echo '<li class="list-group-item disabled" aria-disabled="true">Freigaben</li>';
        // foreach ($freigaben as $key => $value) {
        //   // code...
        // }
        foreach ($zusatzInfos["freigabenNames"] as $key => $value) {
            // print for all tags
            // echo '<a href="index.php?page=pics&deleteTagTag='.$value.'&delteTagBild='.$this->bid.'" class="list-group-item list-group-item-action">Sonnenuntergang</a>';
            echo '<a href="index.php?page=pics&deleteUser='.$zusatzInfos["freigabenUids"][$key].'&delteUserBild='.$this->bid.'" class="list-group-item list-group-item-action">'.$value.'</a>';
        }

        // echo '<a href="" class="list-group-item list-group-item-action">user43</a>';
        // echo '<a href="" class="list-group-item list-group-item-action">bananebrot</a>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '<!-- Hinzufügen von Freigaben -->';
        echo '<form action="index.php?page=pics" method="post">';
        echo '<div class="input-group mb-3">';
        echo '<input type="text" class="form-control" name="newPublic" placeholder="neue Freigabe" aria-label="neuer Tag" aria-describedby="button-addon">';
        echo '<input type="text" class="" name="bid" value="'.$this->bid.'" hidden>';
        echo '<div class="input-group-append">';
        // echo '<button class="btn btn-outline-secondary" type="button" id="addFreigabe'.$this->bid.'">hinzufügen</button>';
        echo '<input type="submit" class="btn btn-outline-secondary" value="Freigabe hinzufügen" />';
        echo '</div>';
        echo '</div>';
        echo '</form>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
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
