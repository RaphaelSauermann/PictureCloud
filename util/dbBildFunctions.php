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

/* Get Pictures with parameters of filtering */
function getPictures($freigabeFilterung, $sortBy, $tags)
{
    /* db init */
    $db = connectDB();

    // Checking if user is logged in if not set uid to impossible number
    if (array_key_exists('uid', $_SESSION)) {
        $uidGet = $_SESSION['uid'];
    } else {
        $uidGet = -1;
    }

    /* ##################### **/
    /** Generating SQL-Query **/
    /* ##################### **/
    // WHERE CLAUSES
    $whereClauses = [];
    $values = [];
    if (empty($freigabeFilterung)) {
      return "nothing to Show";
    }
    /* checking the freigabe filterungen */
    if (in_array("own", $freigabeFilterung)) {
        // owner = $uidGet;
        array_push($whereClauses, 'owner = ? ');
        array_push($values, $uidGet);
    }
    // freigegeben
    if (in_array("open", $freigabeFilterung)) {
        // bid IN (SELECT bid FROM freigabe WHERE uid = $uidGet;
        array_push($whereClauses, 'bid IN (SELECT bid FROM freigabe WHERE uid = ?) ');
        array_push($values, $uidGet);
    }
    // public
    if (in_array("public", $freigabeFilterung)) {
        // isPublic = 1
        array_push($whereClauses, 'isPublic = 1 ');
    }

    /* list of tags that get filtered by */
    if (!empty($tags)) {
        $temp = "bid IN (SELECT bid FROM tagonbild WHERE ";
        $i = count($tags);
        foreach ($tags as $key => $value) {
            // bid IN (SELECT bid FROM tagonbild WHERE bezeichnung = $value)
            $temp .= 'bezeichnung = ?';
            array_push($values, $value);
            $last_iteration = !(--$i); //boolean true/false
            if (!$last_iteration) {
                $temp .= " OR ";
            }
        }
        $temp .= ") ";
        array_push($whereClauses, $temp);
    }
    // Generating Query with WHERE Clauses
    $sql = "SELECT * FROM bild ";
    // $sql = "SELECT * FROM bild WHERE bid > ?";
    if (!empty($whereClauses)) {
        $sql .= "WHERE ";
        $i = count($whereClauses);
        foreach ($whereClauses as $key => $value) {
            $sql .= $value;
            $last_iteration = !(--$i); //boolean true/false
            if (!$last_iteration) {
                $sql .= "AND ";
            }
        }
    }



    /* check sort by */
    if (!empty($sortBy)) {
        // ORDER BY $sortBy
        $sql .= " ORDER BY $sortBy";
    }

    echo $sql."<br>";
    var_dump($values);
    // $sql = "";
    $res = prepared_query($db, $sql, $values)->get_result();
    $pictures = [];
    while ($row = $res->fetch_assoc()) {
        $newPic = new Bild($row['bid'], $row['name'], $row['owner'], $row['pfad'], $row['aufnahmeDatum'], $row['isPublic'], $row['longitude'], $row['latitude']);
        array_push($pictures, $newPic);
    }
    return $pictures;
}
