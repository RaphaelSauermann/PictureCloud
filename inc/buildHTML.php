<?php
include 'inc/menue.php';

if (isset($_GET['page'])) {
    //Check if Page is valid
    switch ($_GET['page']) {
              case "pics":
                include 'inc/pics.php';
                // $buttonId = "buttonHome";
                break;
              case "upload":
                include 'inc/uploadPicture.php';
                // $buttonId = "buttonHome";
                break;
              case "map":
                include 'inc/map.php';
                // $buttonId = "buttonHome";
                break;
              case "help":
                include 'inc/help.php';
                // $buttonId = "buttonHome";
                break;
              case "account":
                include 'inc/uploadPicture.php';
                // $buttonId = "buttonHome";
                break;
              case "logout":
                include 'inc/uploadPicture.php';
                // $buttonId = "buttonHome";
                break;
              default:
                header("Location: index.php?page=home");
                die();
              }
} else {
    header("Location: index.php?page=pics");
    die();
}
        // echo '<script type="text/javascript">',
        //       'document.getElementById("'.$buttonId.'").checked = true;',
        //       '</script>'
        //       ;
