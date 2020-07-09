<?php
/* standard values when page is newly opened up */
if (!isset($_SESSION["showPicturesData"])) {
    echo "Muss neue Session initalisieren!";
    $filterData["freigabeFilterung"] = ["own","open","public"];
    $filterData["sortBy"] = "name";
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
}
/* get search input */
// TODO:

/* Delete Tag if it is clicked */
if (isset($_GET["deleteSearchTag"])) {
    if (($key = array_search($_GET["deleteSearchTag"], $_SESSION["showPicturesData"]["tags"])) !== false) {
        unset($_SESSION["showPicturesData"]["tags"][$key]);
    }
}

/* set list for the active parts of filter */
$activeParts = [];

/* Setting for freigabefilterung */
$listOfFilters = ["own","open","public"];
foreach ($listOfFilters as $key => $value) {
    if (in_array($value, $_SESSION["showPicturesData"]["freigabeFilterung"], true)) {
        $activeParts[$value] = "active";
    } else {
        $activeParts[$value] = "";
    }
}

/* Setting for sortierung */
$listOfSorters = ["name","owner","uploadDatum","aufnahmeDatum","latitude","longitude"];
foreach ($listOfSorters as $key => $value) {
    if ($value == $_SESSION["showPicturesData"]["sortBy"]) {
        $activeParts[$value] = "active";
    } else {
        $activeParts[$value] = "";
    }
}

// $pictures = getPictures();
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
          <a class="dropdown-item <?php echo $activeParts["own"]; ?>" href="index.php?page=pics&clearence=own">nur eigene </a>
          <a class="dropdown-item <?php echo $activeParts["open"]; ?>" href="index.php?page=pics&clearence=open">für mich freigegeben</a>
          <a class="dropdown-item <?php echo $activeParts["public"]; ?>" href="index.php?page=pics&clearence=public">alle Public</a>
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
          <a class="dropdown-item <?php echo $activeParts["name"]; ?>" href="index.php?page=pics&sortBy=name">Bildname </a>
          <a class="dropdown-item <?php echo $activeParts["owner"]; ?>" href="index.php?page=pics&sortBy=owner">Owner</a>
          <a class="dropdown-item <?php echo $activeParts["uploadDatum"]; ?>" href="index.php?page=pics&sortBy=uploadDatum">Änderungsdatum</a>
          <a class="dropdown-item <?php echo $activeParts["aufnahmeDatum"]; ?>" href="index.php?page=pics&sortBy=aufnahmeDatum">Aufnahmedatum</a>
          <a class="dropdown-item <?php echo $activeParts["latitude"]; ?>" href="index.php?page=pics&sortBy=latitude">Latitude</a>
          <a class="dropdown-item <?php echo $activeParts["longitude"]; ?>" href="index.php?page=pics&sortBy=longitude">Longitude</a>
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
            <input type="submit" class="btn btn-outline-secondary" value="nach tag suchen" />
          </div>

          <div class="input-group-append">
            <button class="btn btn-outline-secondary dropdown-toggle" id="searchTagsDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">tags</button>
            <div class="dropdown-menu">
              <?php
                foreach ($_SESSION["showPicturesData"]["tags"] as $key => $value) {
                    print "<a class=\"dropdown-item\" href=\"index.php?page=pics&deleteSearchTag=".$value."\">".$value."</a>";
                }
               ?>
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
/* Print all the pictures in the order they got delivered from the db */


/* checking the freigabe filterungen */
/* check eigene */
/* check for you freigegeben */
/* check public */

/* check sort by */

/* list of tags that get filtered by */

$pictures = getPictures($_SESSION["showPicturesData"]["freigabeFilterung"], $_SESSION["showPicturesData"]["sortBy"], $_SESSION["showPicturesData"]["tags"]);
foreach ($pictures as $key => $value) {
  $value->getHTML("fine");
  // echo "<br>";
}

 ?>
