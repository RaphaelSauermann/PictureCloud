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

    if (array_key_exists('isAdmin', $_SESSION)) {
        $picAdmin = $_SESSION['isAdmin'];
    } else {
        $picAdmin = 0;
    }

    /* ##################### **/
    /** Generating SQL-Query **/
    /* ##################### **/
    // WHERE CLAUSES
    $whereClauses = [];
    $values = [];
    if (empty($freigabeFilterung)) {
        return -1;
    }
    /* checking the freigabe filterungen */
    if (in_array("own", $freigabeFilterung)) {
        // owner = $uidGet;
        array_push($whereClauses, 'owner = ? ');
        array_push($values, $uidGet);
    }
    // freigegeben
    if (in_array("open", $freigabeFilterung)) {
        /* if is admin, all pictures should be shown with this option */
        if ($picAdmin) {
            // code...
            array_push($whereClauses, 'owner IN (SELECT uid FROM user WHERE 1 = ?) ');
            array_push($values, 1);
        } else {
            // bid IN (SELECT bid FROM freigabe WHERE uid = $uidGet;
            array_push($whereClauses, 'bid IN (SELECT bid FROM freigabe WHERE uid = ?) ');
            array_push($values, $uidGet);
        }
    }
    // public
    if (in_array("public", $freigabeFilterung)) {
        // isPublic = 1
        array_push($whereClauses, 'isPublic = ? ');
        array_push($values, 1);
    }

    /* list of tags that get filtered by */
    if (!empty($tags)) {
        $tagQueryPart = "bid IN (SELECT bid FROM tagonbild WHERE ";
        $i = count($tags);
        foreach ($tags as $key => $value) {
            // bid IN (SELECT bid FROM tagonbild WHERE bezeichnung = $value)
            $tagQueryPart .= 'bezeichnung = ?';
            array_push($values, $value);
            $last_iteration = !(--$i); //boolean true/false
            if (!$last_iteration) {
                $tagQueryPart .= " OR ";
            }
        }
        $tagQueryPart .= ") ";
        // array_push($whereClauses, $temp);
    }
    // Generating Query with WHERE Clauses
    $sql = "SELECT * FROM bild ";
    // $sql = "SELECT * FROM bild WHERE bid > ?";
    if (!empty($whereClauses)) {
        $sql .= "WHERE ";
        $sql .= " ( ";
        $i = count($whereClauses);
        foreach ($whereClauses as $key => $value) {
            $sql .= $value;
            $last_iteration = !(--$i); //boolean true/false
            if (!$last_iteration) {
                $sql .= "OR ";
            }
        }
        $sql .= " ) ";
    }
    if (!empty($tagQueryPart)) {
        $sql .= "AND ".$tagQueryPart;
    }



    /* check sort by */
    if (!empty($sortBy)) {
        // ORDER BY $sortBy
        $sql .= " ORDER BY $sortBy";
    }

    // echo $sql."<br>";
    // var_dump($values);
    // $sql = "";
    $res = prepared_query($db, $sql, $values)->get_result();
    $pictures = [];
    $count = 0;
    while ($row = $res->fetch_assoc()) {
        $newPic = new Bild($row['bid'], $row['name'], $row['owner'], $row['pfad'], $row['aufnahmeDatum'], $row['isPublic'], $row['longitude'], $row['latitude']);
        // array_push($pictures, $newPic);
        $pictures[$newPic->getBid()] = $newPic;
        $count++;
    }
    /* Closing Connection */
    $db->close();

    if ($count) {
        return $pictures;
    } else {
        return "whoi";
    }
}

/* returns additonal information for bild:
owner
UpdateDatum
Tags
Freigaben
*/
function getBildAdditonalInformation($bild)
{
    $db = connectDB();
    /* status */


    // if ($_SESSION["isAdmin"]) {
    //     $werte["status"] = "admin";
    // } else {
        if ($bild->getOwner()==$_SESSION["uid"]) {
            $werte["status"]="owner";
        } else {
            $werte["status"]="guest";
        }
    // }


    /* name */
    // $werte["ownerName"] = "Testname";
    $sql = "SELECT username FROM user WHERE uid=?";
    $res = prepared_query($db, $sql, [$bild->getOwner()])->get_result();
    while ($row = $res->fetch_assoc()) {
        $werte["ownerName"]=$row["username"];
    }

    /* updateDatum */
    // $werte["uploadDatum"] = "2020-05-05";
    $sql = "SELECT uploadDatum FROM bild WHERE bid=?";
    $res = prepared_query($db, $sql, [$bild->getBid()])->get_result();
    while ($row = $res->fetch_assoc()) {
        $werte["uploadDatum"]=$row["uploadDatum"];
    }


    /* tags */
    $sql = "SELECT bezeichnung FROM tagonbild WHERE bid=?";
    $res = prepared_query($db, $sql, [$bild->getBid()])->get_result();
    $temp = [];
    while ($row = $res->fetch_assoc()) {
        array_push($temp, $row["bezeichnung"]);
    }
    $werte["tags"]=$temp;

    /* freigaben */
    $sql = "SELECT username, uid FROM user WHERE uid IN (SELECT uid FROM freigabe WHERE bid = ?)";
    $res = prepared_query($db, $sql, [$bild->getBid()])->get_result();
    $temp2 = [];
    $temp3 = [];
    while ($row = $res->fetch_assoc()) {
        array_push($temp2, $row["username"]);
        array_push($temp3, $row["uid"]);
    }
    $werte["freigabenNames"] = $temp2;
    $werte["freigabenUids"] = $temp3;

    /* Closing Connection */
    $db->close();
    return $werte;
}


function updatePicture($updateWerte)
{
    $db = connectDB();
    // echo "update:";
    // foreach ($updateWerte as $key => $value) {
    //     echo $key.": ".$value."<br>";
    // }
    $uid = getUid($updateWerte["owner"]);
    if (isset($uid)) {
        $sql = "UPDATE bild SET name = ?, owner  = ?, aufnahmeDatum = ?, isPublic = ?, longitude = ?, latitude = ? WHERE bid  = ?;";
        $res = prepared_query($db, $sql, [$updateWerte["name"],$uid,$updateWerte["aufnahmeDatum"],$updateWerte["isPublic"],$updateWerte["longitude"],$updateWerte["latitude"],$updateWerte["bid"]]);
    }
    $db->close();
}

function deletePicture($bid)
{
    /* check if user exists */
    $db = connectDB();
    $sql = "SELECT pfad FROM bild WHERE bid = ?";
    $res = prepared_query($db, $sql, [$bid])->get_result();
    while ($row = $res->fetch_assoc()) {
        // echo "habe uid gefunden!".$row["uid"];
        $path =  $row["pfad"];
    }

    if (isset($path)) {
        unlink($path);
        $sql = "DELETE FROM bild WHERE bid = ?";
        $res = prepared_query($db, $sql, [$bid]);
    }
    $db->close();
}
