<h2>Bilder anschauen</h2>
<!-- Suche und Filterungsteil -->
<div class="container">
  <div class="row">
    <div class="col-sm-2">
      <!-- Freigabe filterung -->
      <div class="dropdown">
        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="freigabeAuswahl" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Freigabe Filterung
        </a>

        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
          <a class="dropdown-item" href="#">nur eigene </a>
          <a class="dropdown-item" href="#">für mich freigegeben</a>
          <a class="dropdown-item" href="#">alle Public</a>
        </div>
      </div>
    </div>
    <div class="col-sm-2">
      <!-- Sortieren nach -->
      <div class="dropdown">
        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="freigabeAuswahl" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Sortieren nach
        </a>

        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
          <a class="dropdown-item" href="#">owner </a>
          <a class="dropdown-item" href="#">position</a>
          <a class="dropdown-item" href="#">...</a>
        </div>
      </div>
    </div>
    <div class="col-sm-4">
      <!-- Filtern nach Tags -->
      <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="tag suchen" aria-label="tag suchen" aria-describedby="button-addon2">
        <div class="input-group-append">
          <button class="btn btn-outline-secondary" type="button" id="addTagButton">adden</button>
        </div>
        <div class="input-group-append">
          <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">tags</button>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <a class="dropdown-item" href="#">Something else here</a>
            <div role="separator" class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Separated link</a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-4">
      <!-- Suchfeld -->
      <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="meta-suche" aria-label="meta-suche" aria-describedby="button-addon">
        <div class="input-group-append">
          <button class="btn btn-outline-secondary" type="button" id="searchButton">suchen</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- hauptteil wo bilder sind -->
<div class="container" id="pics">
  <div class="card" style="width: 40rem;">
    <!-- thumbnail -->
    <img src="pics/misc/tab.png" class="card-img-top" alt="...">
    <div class="card-body">
      <div class="container">
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
            </div>
          </div>
        </form>
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
      </div>
    </div>
  </div>
</div>

<?php


 ?>
