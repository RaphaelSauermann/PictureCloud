<?php

$chat_first = min(filter_input(INPUT_POST, "sender"), filter_input(INPUT_POST, "recipient"));
$chat_second = max(filter_input(INPUT_POST, "sender"), filter_input(INPUT_POST, "recipient"));
$chat_filename = $chat_first . "_" . $chat_second . ".json";

$url = "../chats/" . $chat_filename;
$content = file_get_contents($url);
$data = json_decode($content);

$msgObj->sender = filter_input(INPUT_POST, "sender");
$msgObj->senderName = filter_input(INPUT_POST, "senderName");
$msgObj->recipient = filter_input(INPUT_POST, "recipient");
$msgObj->recipientName = filter_input(INPUT_POST, "recipientName");
$msgObj->message = filter_input(INPUT_POST, "message");
$msgObj->timestamp = filter_input(INPUT_POST, "timestamp");
$msgObj->read = filter_input(INPUT_POST, "read");


$data[] = $msgObj;
file_put_contents($url, json_encode($data));
