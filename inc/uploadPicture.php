<h2>Bilderupload</h2>
<?php
if (!$_SESSION["loginStatus"]) {
    header("Location: index.php?page=pics");
}
 ?>
<form enctype="multipart/form-data" method="post" action="">


  <table class="table table-sm table-striped" style="width:50%;">
    <thead>
      <tr>
        <th scope="col">Beschreibung</th>
        <th scope="col">Eingabe</th>
      </tr>
    </thead>
    <tbody>
      <!-- <tr>
      <td>Bild zum hochladen auswählen*</td>
      <td><input type="file" name="fileToUpload" accept="image/*" required /></td>
    </tr> -->
      <tr>
        <td><label class="button" for="fileElem">Bild zum hochladen auswählen*</label></td>
        <td><input type="file" name="fileToUpload" id="fileElem" accept="image/*" required /></td>
      </tr>
      <tr>
        <td><label for="picPublic">Bild ist public (optional):</label></td>
        <td><input type="checkbox" name="picPublic" id="picPublic" value="isPublic"></td>
      </tr>
      <tr>
        <td><label for="picName">Bildname (optional):</label></td>
        <td><input type="text" name="picName" id="picName" value="" placeholder="Sonnenuntergang"></td>
      </tr>
      <tr>
        <td><label for="picTaken">Aufnahmedatum (optional):</label></td>
        <td><input type="date" name="picTaken" id="picTaken" value=""></td>
      </tr>
      <tr>
        <td><label for="picLat">Latitude (optional):</label></td>
        <td><input type="text" name="picLat" id="picLat" placeholder="48.136767"></td>
      </tr>
      <tr>
        <td><label for="picLong">longitude (optional):</label></td>
        <td><input type="text" name="picLong" id="picLong" placeholder="16.323815"></td>
      </tr>
      <tr>
        <td><input type="reset" value="Abbrechen"></td>
        <td><input type="submit" value="Bild hochladen" /></td>
      </tr>
    </tbody>
  </table>
</form>

<?php
$target_dir = $pathToPics."/".$_SESSION["uid"];
if (isset($_FILES["fileToUpload"])) {
    // TODO
    /* filter so server only uploads pictures */
    $target_file = $target_dir."/".$_FILES["fileToUpload"]["name"];
    if (!is_dir($target_dir)) {
        mkdir($target_dir);
    }
    if (!file_exists($target_file)) {
        echo "$target_file";
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "Datei wurde erfolgreich hochgeladen!";
            // Upload war erfolgreich!

            /* Auswertung der Input-Felder */
            if (isset($_POST)) {
                $picName = $_POST["picName"];
                //TODO SESSION User id to owners
                $picOwner = $_SESSION["uid"];
                $picPfad = $target_file;
                $picAufnahmeDatum = $_POST["picTaken"];
                if (isset($_POST["picPublic"]) && $_POST["picPublic"] == "isPublic") {
                    $picIsPublic = 1;
                } else {
                    $picIsPublic = 0;
                }
                $picLongitude = $_POST["picLong"];
                $picLatitude = $_POST["picLat"];
                if (($_POST["picName"] == null)) {
                    //check if name is set if not set it to filename
                    $picName = $_FILES["fileToUpload"]["name"];
                }
                $picId = addNewPicture($picName, $picOwner, $picPfad, $picAufnahmeDatum, $picIsPublic, $picLongitude, $picLatitude);
                // $addedToDB = addPicture($picName, $picOwner, $picPfad, $picAufnahmeDatum, $picIsPublic, $piclongitude, $picLatitude);
                // echo "<br> bildId:".$pic->getBid();
                // $pic = new Bild($picId, $picName, $picOwner, $picPfad, $picAufnahmeDatum, $picIsPublic, $picLongitude, $picLatitude);
                // var_dump($pic);
            }
        } else {
            echo "Fehler beim Upload!<br>";
            //Fehlerausgabe
        }
    } else {
        echo "file already exists<br>";
        //Fehlerausgabe
    }
    unset($_FILES["fileToUpload"]);
}
 ?>
