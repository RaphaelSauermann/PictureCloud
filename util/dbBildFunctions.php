<?php
function addPicture($name, $owner, $pfad, $aufnahmeDatum, $isPublic, $longitute, $latitude)
{
    $db = connectDB();

    $stmt = $db->prepare("INSERT INTO bild (name, owner, pfad, aufnahmeDatum, isPublic, longitute, latitude) VALUES (?,?,?,?,?,?,?)");
    $stmt->bind_param("sissidd", $name, $owner, $pfad, $aufnahmeDatum, $isPublic, $longitute, $latitude);

    // $name = filter_input(INPUT_POST, "name");
    // $owner = filter_input(INPUT_POST, "owner");
    // $pfad = filter_input(INPUT_POST, "pfad");
    // $aufnahmeDatum = filter_input(INPUT_POST, "aufnahmeDatum");
    // // $uploadDatum; done by Database
    // $isPublic = filter_input(INPUT_POST, "isPublic");
    // $longitute = filter_input(INPUT_POST, "longitute");
    // $latitude = filter_input(INPUT_POST, "latitude");

    $success = $stmt->execute();
    $stmt->close();
    $db->close();
    return $success;
}
