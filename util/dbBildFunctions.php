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
    /* db init */
    $db = connectDB();
    /* setting params */
    $params[0] = $name;
    $params[1] = $owner;
    $params[2] = $pfad;
    $params[3] = $aufnahmeDatum;
    $params[4] = $isPublic;
    $params[5] = $longitude;
    $params[6] = $latitude;
    /* insert into DB */
    echo "bin da!)";
    $stmt = prepared_query($db, "INSERT INTO bild(name,owner,pfad,aufnahmeDatum,isPublic,longitude,latitude) VALUES (?,?,?,?,?,?,?)", $params, $types = "sissidd");
    echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    /* get id for Tag by Name */
    // $tagID = prepared_select($db, "SELECT * FROM bild WHERE name = ?", $params, $types)->fetch_assoc();
    $id = $stmt->insert_id;

    $stmt->close();
    $db->close();
    return $id;
}

function addTag($tagName)
{
    /* db init */
    $db = connectDB();
    /* setting params */
    $params[0] = $tagName;
    /* insert into DB */
    $stmt = prepared_query($db, "INSERT INTO tag(name) VALUES (?)", $params, $types = "s");
    /* get id for Tag by Name */
    // $tagID = prepared_select($db, "SELECT * FROM tag WHERE name = ?", $params, $types)->fetch_assoc();
    $id = $stmt->insert_id;
    $stmt->close();
    $db->close();
    return $id;
}
