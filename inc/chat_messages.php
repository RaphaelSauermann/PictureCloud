
<?php

/*
  echo filter_input(INPUT_GET, "myId");
  echo filter_input(INPUT_GET, "theirId");
  echo filter_input(INPUT_GET, "myUsername");
  echo filter_input(INPUT_GET, "theirUsername");
 */


/* Überschrift, "Message User "_username_" */
$messageTitle = '<label><b>Message User <i>"' . filter_input(INPUT_POST, "theirUsername") . '"</i></b></label>';
$messageTitle .= '<hr>';
echo $messageTitle;

/* Message History */

// Chats werden in JSON files gespeichert, der name des files ist immer id_id.json, wobei die niedrigere ID immer zuerst kommt
$chat_first = min(filter_input(INPUT_POST, "myId"), filter_input(INPUT_POST, "theirId"));
$chat_second = max(filter_input(INPUT_POST, "myId"), filter_input(INPUT_POST, "theirId"));
$chat_filename = $chat_first . "_" . $chat_second . ".json";
$url = "../chats/" . $chat_filename;

// check if file exists
if (!file_exists($url)) {
    return;
}

// gets and decodes JSON contents 
$content = file_get_contents($url);
$werte = json_decode($content);

// reads JSON Entries and prints them
$lines = "";
foreach ($werte as $item) {
    if ($item->sender === filter_input(INPUT_POST, "myId")) {
        $lines .= '<div style= "text-align:right;">';
    } else {
        $lines .= '<div>';
    }
    $lines .= "<b>" . $item->senderName . "</b> ";
    $lines .= "<i>" . $item->timestamp . "</i> ";
    if ($item->sender === filter_input(INPUT_POST, "myId")) {
        if ($item->read) {
            $lines .= '<sub style="color:DodgerBlue;">read</sub>';
        } else {
            $lines .= '<sub>unread</sub>';
        }
    }

    $lines .= "<br>" . $item->message . "<br>";
    $lines .= '</div>';
}

echo '<div disabled id="chatHistory">';
echo $lines;
echo '<hr>';
echo '</div>';


/* update 'read' status */
foreach ($werte as $item) {
    if ($item->sender !== filter_input(INPUT_POST, "myId") && $item->read === "0") {
        $item->read = "1";
    }
}
file_put_contents($url, json_encode($werte));

