<?php



if (isset($_POST['data'])) {
    $data = $_POST['data'];
    $chat = json_decode($data);
    $name = $chat->Name;
    $msg = $chat->Message;

    $file = "chat.txt";
    $fh = fopen($file, 'w') or die("Sorry, could not open the file.");

    if (fwrite($fh, $name + ":" + $msg)) {
        $response = json_encode(array('exists' => true));
    } else {
        $response = json_encode(array('exists' => false));
    }
    fclose($fh);
    echo "<script type='text/javascript'>alert ('" + $name + $msg + "')</script>";
}
