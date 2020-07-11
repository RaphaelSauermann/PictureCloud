<?php

// Chats are saved in a JSON file, name of the file is id_id.json, where the lower id is placed first
$chat_first = min(filter_input(INPUT_POST, "sender"), filter_input(INPUT_POST, "recipient"));
$chat_second = max(filter_input(INPUT_POST, "sender"), filter_input(INPUT_POST, "recipient"));
$chat_filename = $chat_first . "_" . $chat_second . ".json";

// opens file and decodes JSON entries
$url = "../chats/" . $chat_filename;
$content = file_get_contents($url);
$data = json_decode($content);

// creates an Object to be added to the JSON file
$msgObj->sender = filter_input(INPUT_POST, "sender");
$msgObj->senderName = filter_input(INPUT_POST, "senderName");
$msgObj->recipient = filter_input(INPUT_POST, "recipient");
$msgObj->recipientName = filter_input(INPUT_POST, "recipientName");
$msgObj->message = filter_input(INPUT_POST, "message");
$msgObj->timestamp = filter_input(INPUT_POST, "timestamp");
$msgObj->read = filter_input(INPUT_POST, "read");

// writes to JSON file and saves changes
$data[] = $msgObj;
file_put_contents($url, json_encode($data));
