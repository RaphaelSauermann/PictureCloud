<?php
function addTagOnBild($bid, $tagBez)
{
    $params[0] = $bid;
    $params[1] = $tagBez;
    return addNewEntry("INSERT INTO tagonbild(bid, bezeichnung) VALUES (?,?)", $params, $types = "ds");
}

function deleteTagOnBild($bid, $tagBez)
{
    $params[0] = $bid;
    $params[1] = $tagBez;
    return addNewEntry("DELETE FROM tagonbild WHERE bid = ? AND bezeichnung = ?", $params, $types = "ds");
}

function getUid($username)
{
    /* check if user exists */
    $db = connectDB();
    $sql = "SELECT uid FROM user WHERE username = ?";
    $res = prepared_query($db, $sql, [$username])->get_result();
    while ($row = $res->fetch_assoc()) {
        // echo "habe uid gefunden!".$row["uid"];
        $db->close();
        return $row["uid"];
    }
}

function addFreigabe($bid, $username)
{
    $uid = getUid($username);
    if (isset($uid)) {
        $params[0] = $bid;
        $params[1] = $uid;
        return addNewEntry("INSERT INTO freigabe(bid, uid) VALUES (?,?)", $params, $types = "dd");
    }
}

function deleteFreigabe($bid, $uid)
{
    if (isset($uid)) {
        $params[0] = $bid;
        $params[1] = $uid;
        return addNewEntry("DELETE FROM freigabe WHERE bid = ? AND uid = ?", $params, $types = "dd");
    }
}
