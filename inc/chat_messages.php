
<?php
echo '<label for="msg"><b>Message User <i>"' . filter_input(INPUT_GET, "theirUsername") . '"</i></b></label>';
echo '<hr>';
/*
  echo filter_input(INPUT_GET, "myId");
  echo filter_input(INPUT_GET, "theirId");
  echo filter_input(INPUT_GET, "myUsername");
  echo filter_input(INPUT_GET, "theirUsername");
 */


/* Message History */

// Chats werden in JSON files gespeichert, der name des files ist immer id_id.json, wobei die niedrigere ID immer zuerst kommt
$chat_first = min(filter_input(INPUT_GET, "myId"), filter_input(INPUT_GET, "theirId"));
$chat_second = max(filter_input(INPUT_GET, "myId"), filter_input(INPUT_GET, "theirId"));
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





// Input field
?>


<input type="text" name="msg" id="msg" required>
<button type = "button" class = "btn btn-success" id="sendMsg">Send</button>


<?php
?>

<script type="text/javascript">
    $(document).ready(function () {
        $("#sendMsg").click(function () {
            var msg = $("#msg").val();
            if (msg.length === 0)
            {
                alert("Enter a message first!");
                return;
            }
            //var name = $("#name-input").val();
            //var chat = $(".chat-box").html();
            //$(".chat-box").html(chat + "<br /><div class='bubble'>" + msg + "</div>");

            var data = {
                //Name : name,
                Message: msg
            };
            $.ajax({
                type: "POST",
                url: "inc/chat_send.php",

                success: function (result) {
                    $("#chatHistory").html(result);
                }
            });
        });
    });
</script>
