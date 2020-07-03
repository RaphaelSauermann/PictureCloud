<?php
function addPicture($name, $owner, $pfad, $aufnahmeDatum, $isPublic, $longitude, $latitude)
{
    $db = connectDB();

    if(!$stmt = $db->prepare("INSERT INTO bild (name, owner, pfad, aufnahmeDatum, isPublic, longitude, latitude) VALUES (?,?,?,?,?,?,?)")){
      echo "konnte statement nicht preparen";
    }
    if($stmt->bind_param("sissidd", $name, $owner, $pfad, $aufnahmeDatum, $isPublic, $longitude, $latitude)){
      echo "hab binden";
    }
    // $stmt->bind_param("sissidd", "Name", 1, "pics/irgendwas", "2020-05-20", 1, 123, 421);
    // $name = filter_input(INPUT_POST, "name");
    // $owner = filter_input(INPUT_POST, "owner");
    // $pfad = filter_input(INPUT_POST, "pfad");
    // $aufnahmeDatum = filter_input(INPUT_POST, "aufnahmeDatum");
    // // $uploadDatum; done by Database
    // $isPublic = filter_input(INPUT_POST, "isPublic");
    // $longitute = filter_input(INPUT_POST, "longitute");
    // $latitude = filter_input(INPUT_POST, "latitude");

    if($stmt->execute()){
      $success = 1;
    }else {
      $success = 0;
    }
    $stmt->close();
    $db->close();
    return $success;
}
