
<?php

/*
  echo filter_input(INPUT_GET, "myId");
  echo filter_input(INPUT_GET, "theirId");
  echo filter_input(INPUT_GET, "myUsername");
  echo filter_input(INPUT_GET, "theirUsername");
 */


/* Message History */

// Chats werden in JSON files gespeichert, der name des files ist immer id_id.json, wobei die niedrigere ID immer zuerst kommt
$chat_first = min(filter_input(INPUT_POST, "myId"), filter_input(INPUT_POST, "theirId"));
$chat_second = max(filter_input(INPUT_POST, "myId"), filter_input(INPUT_POST, "theirId"));
$chat_filename = $chat_first . "_" . $chat_second . ".json";

$url = "../chats/" . $chat_filename;
$content = file_get_contents($url);
$werte = json_decode($content);

$lines = "";
foreach ($werte as $item) {
    $lines .= "<b>" . $item->senderName . "</b> ";
    $lines .= "<i>" . $item->timestamp . "</i>: <br>";
    $lines .= $item->message . "<br>";
}

echo '<div disabled id="chatHistory">';
echo $lines;
echo '</div>';


