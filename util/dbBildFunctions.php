<?php
function prepared_query($mysqli, $sql, $params, $types = "")
{
    $types = $types ?: str_repeat("s", count($params));
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param($types, ...$params);
    $stmt->execute();
    return $stmt;
}

function prepared_select($mysqli, $sql, $params = [], $types = "")
{
    return prepared_query($mysqli, $sql, $params, $types)->get_result();
}



function addPicture($name, $owner, $pfad, $aufnahmeDatum, $isPublic, $longitude, $latitude)
{
    $db = connectDB();

    if (!$stmt = $db->prepare("INSERT INTO bild (name, owner, pfad, aufnahmeDatum, isPublic, longitude, latitude) VALUES (?,?,?,?,?,?,?)")) {
        echo "konnte statement nicht preparen";
    }
    if ($stmt->bind_param("sissidd", $name, $owner, $pfad, $aufnahmeDatum, $isPublic, $longitude, $latitude)) {
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

    if ($stmt->execute()) {
        $success = 1;
    } else {
        $success = 0;
    }
    $stmt->close();
    $db->close();
    return $success;
}

function addTag($tagName)
{
    $db = connectDB();
    $params[0] = $tagName;
    /* insert into DB */
    $stmt = prepared_query($db, "INSERT INTO tag(name) VALUES (?)", $params, $types = "s");
    /* get id for Tag by Name */
    $tagID = prepared_select($db, "SELECT * FROM tag WHERE name = ?", $params, $types)->fetch_assoc();
    $stmt->close();
    $db->close();
    return $tagID['tid'];
}
