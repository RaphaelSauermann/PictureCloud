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

function addFreigabe($bid, $uid)
{
    $params[0] = $bid;
    $params[1] = $uid;
    return addNewEntry("INSERT INTO freigabe(bid, uid) VALUES (?,?)", $params, $types = "dd");
}

function deleteFreigabe($bid, $tagBez)
{
    $params[0] = $bid;
    $params[1] = $tagBez;
    return addNewEntry("DELETE FROM freigabe WHERE bid = ? AND uid = ?", $params, $types = "dd");
}
