<?php
/* standard values when page is newly opened up */
if (!isset($_SESSION["showPicturesData"])) {
    echo "Muss neue Session initalisieren!";
    $filterData["freigabeFilterung"] = ["own","open","public"];
    $filterData["sortBy"] = "";
    $filterData["tags"] = [];
    $filterData["search"] = "";
    $_SESSION["showPicturesData"] = $filterData;
}


/* get all freigabe Choosen */
if (isset($_GET["clearence"])) {
    // toggle the selected freigabestufe in the session array
    $_SESSION["showPicturesData"]["freigabeFilterung"] = toggleElementInArray($_SESSION["showPicturesData"]["freigabeFilterung"], $_GET["clearence"]);
}

/* get sort by */
if (isset($_GET["sortBy"])) {
    // sets the value after which should be sorted
    $_SESSION["showPicturesData"]["sortBy"] = $_GET["sortBy"];
    // echo $_SESSION["showPicturesData"]["sortBy"];
}

/* get tags */
if (isset($_GET["addTagInput"])) {
    if (!in_array($_GET["addTagInput"], $_SESSION["showPicturesData"]["tags"], true)) {
        array_push($_SESSION["showPicturesData"]["tags"], $_GET["addTagInput"]);
    }
    // var_dump($_SESSION["showPicturesData"]["tags"]);
}
/* get search input */

 ?>
<h2>Bilder anschauen</h2>
<!-- Suche und Filterungsteil -->
<div class="container">
  <div class="row">
    <div class="col-sm-2">
      <!-- Freigabe filterung -->
      <div class="dropdown">
        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="freigabeFilterungDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Freigabe Filterung
        </a>

        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
          <a class="dropdown-item" href="index.php?page=pics&clearence=own">nur eigene </a>
          <a class="dropdown-item" href="index.php?page=pics&clearence=open">für mich freigegeben</a>
          <a class="dropdown-item" href="index.php?page=pics&clearence=public">alle Public</a>
        </div>
      </div>
    </div>
    <div class="col-sm-2">
      <!-- Sortieren nach -->
      <div class="dropdown">
        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="sortByDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Sortieren nach
        </a>

        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
          <a class="dropdown-item" href="index.php?page=pics&sortBy=name">Bildname </a>
          <a class="dropdown-item" href="index.php?page=pics&sortBy=owner">Owner</a>
          <a class="dropdown-item" href="index.php?page=pics&sortBy=changeDate">Änderungsdatum</a>
          <a class="dropdown-item" href="index.php?page=pics&sortBy=takenDate">Aufnahmedatum</a>
          <a class="dropdown-item" href="index.php?page=pics&sortBy=lat">Latitude</a>
          <a class="dropdown-item" href="index.php?page=pics&sortBy=long">Longitude</a>
        </div>
      </div>
    </div>
    <div class="col-sm-4">
      <!-- Filtern nach Tags -->
      <form action="index.php" method="get">


        <div class="input-group mb-3">
          <!-- Hidden element to set additional get parameter (page) -->
          <input type="text" name="page" value="pics" hidden>
          <input type="text" class="form-control" name="addTagInput" id="addTagInput" placeholder="tag suchen" aria-label="tag suchen" aria-describedby="button-addon2">
          <div class="input-group-append">
            <!-- <button class="btn btn-outline-secondary" type="submit" id="addTagButton">adden</button> -->
            <input type="submit" class="btn btn-outline-secondary" value="tag hinzufügen" />
          </div>

          <div class="input-group-append">
            <button class="btn btn-outline-secondary dropdown-toggle" id="searchTagsDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">tags</button>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <a class="dropdown-item" href="#">Something else here</a>
              <div role="separator" class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Separated link</a>
            </div>
          </div>

        </div>
      </form>
    </div>
    <div class="col-sm-4">
      <!-- Suchfeld -->
      <div class="input-group mb-3">
        <input type="text" class="form-control" id="searchInput" placeholder="meta-suche" aria-label="meta-suche" aria-describedby="button-addon">
        <div class="input-group-append">
          <button class="btn btn-outline-secondary" type="button" id="searchButton">suchen</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- hauptteil wo bilder sind -->
<?php
/* Get pictures by filters*/


?>


<div class="container" id="pics">
  <div class="card" style="width: 40rem;">
    <!-- thumbnail -->
    <img src="pics/misc/tab.png" class="card-img-top" alt="...">
    <div class="card-body">
      <!-- Button zum aufklappen -->
      <a class="btn btn-outline-dark" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="true" aria-controls="collapseExample">
        +/- Zusatzinfos
      </a>
      <!-- aufklappbare zusatzinfos -->
      <div class="container collapse show" id="collapseExample">
        <form>
          <!-- Anzeige der Attribute des Bildes -->
          <div class="row">
            <div class="col">
              <!-- Bildname -->
              <div class="form-group">
                <label for="formGroupExampleInput">Bildname</label>
                <input type="text" class="form-control" id="formGroupExampleInput" value="Sonnenuntergang">
              </div>
            </div>
            <div class="col">
              <!-- Bildowner -->
              <div class="form-group">
                <label for="formGroupExampleInput2">Owner</label>
                <input type="text" class="form-control" id="formGroupExampleInput2" value="ich">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <!-- Änderungsdatum -->
              <div class="form-group">
                <label for="formGroupExampleInput">Änderungsdatum</label>
                <input type="text" class="form-control" id="formGroupExampleInput" value="2020-05-07">
              </div>
            </div>
            <div class="col">
              <!-- Aufnahmedatum -->
              <div class="form-group">
                <label for="formGroupExampleInput2">Aufnahmedatum</label>
                <input type="text" class="form-control" id="formGroupExampleInput2" value="2019-06-18">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-3">
              <!-- Latitude -->
              <div class="form-group">
                <label for="formGroupExampleInput">Latitude</label>
                <input type="text" class="form-control" id="formGroupExampleInput" value="52.1517515">
              </div>
            </div>
            <div class="col-sm-3">
              <!-- Longitude -->
              <div class="form-group">
                <label for="formGroupExampleInput2">Longitude</label>
                <input type="text" class="form-control" id="formGroupExampleInput2" value="16.5747846">
              </div>
            </div>
            <div class="col-sm-6">
              <!-- is Public & update -->
              <div class="form-group">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                  <label class="form-check-label" for="defaultCheck1">
                    is Public
                  </label>
                </div>
              </div>
              <a href="#" class="btn-sm btn-primary">Update felder</a>
              <a href="#" class="btn-sm btn-danger">Bild löschen</a>
            </div>
          </div>
        </form>
        <!-- Spacer -->
        <hr />
        <!-- Anzeige alles TAGS -->
        <div class="row">
          <div class="col">
            <div class="list-group">
              <li class="list-group-item disabled" aria-disabled="true">Tags</li>
              <a href="" class="list-group-item list-group-item-action">Sonnenuntergang</a>
              <a href="" class="list-group-item list-group-item-action">Meer</a>
              <a href="" class="list-group-item list-group-item-action">Berge</a>
            </div>
          </div>
        </div>
        <!-- Hinzufügen von TAGS -->
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="neuer Tag" aria-label="neuer Tag" aria-describedby="button-addon">
          <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="button" id="searchButton">hinzufügen</button>
          </div>
        </div>
        <!-- Spacer -->
        <hr />
        <!-- Anzeige der Freigaben -->
        <div class="row">
          <div class="col">
            <div class="list-group">
              <li class="list-group-item disabled" aria-disabled="true">Freigaben</li>
              <a href="" class="list-group-item list-group-item-action">user1</a>
              <a href="" class="list-group-item list-group-item-action">user43</a>
              <a href="" class="list-group-item list-group-item-action">bananebrot</a>
            </div>
          </div>
        </div>
        <!-- Hinzufügen von TAGS -->
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="neue Freigabe" aria-label="neuer Tag" aria-describedby="button-addon">
          <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="button" id="searchButton">hinzufügen</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php


 ?>
