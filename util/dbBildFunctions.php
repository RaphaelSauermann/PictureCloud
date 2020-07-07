<?php
// https://phpdelusions.net/mysqli/simple
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

/* Generic insert sql function which return the id of the inserted row */
function addNewEntry($sql, $params, $types = "")
{
    /* db init */
    $db = connectDB();

    /* insert into DB */
    $stmt = prepared_query($db, $sql, $params, $types);

    // echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;

    /* get id for Tag by Name */
    $id = $stmt->insert_id;

    /* Closing Connection */
    $stmt->close();
    $db->close();
    return $id;
}

/* adds a new Picture to DB and returns the generated ID from that picture */
function addNewPicture($name, $owner, $pfad, $aufnahmeDatum, $isPublic, $longitude, $latitude)
{
    $params[0] = $name;
    $params[1] = $owner;
    $params[2] = $pfad;
    $params[3] = $aufnahmeDatum;
    $params[4] = $isPublic;
    $params[5] = $longitude;
    $params[6] = $latitude;
    return addNewEntry("INSERT INTO bild(name,owner,pfad,aufnahmeDatum,isPublic,longitude,latitude) VALUES (?,?,?,?,?,?,?)", $params, $types = "sissidd");
}

/* Get Pictures*/
function getPictures()
{
    /* db init */
    $db = connectDB();
    $sql = "SELECT * FROM bild WHERE bid > ?";
    $res = prepared_query($db, $sql, [1])->get_result();
    $pictures = [];
    while ($row = $res->fetch_assoc()) {
        $newPic = new Bild($row['bid'], $row['name'], $row['owner'], $row['pfad'], $row['aufnahmeDatum'], $row['isPublic'], $row['longitude'], $row['latitude']);
        array_push($pictures, $newPic);
    }
    return $pictures;
}
