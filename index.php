<!DOCTYPE html>
<?php
session_start();
if (!isset($_SESSION["loginStatus"])) {
    $_SESSION["loginStatus"] = false;
}
if (!isset($_SESSION["uid"])) {
    $_SESSION["uid"] = -1;
}
if (!isset($_SESSION["isAdmin"])) {
    $_SESSION["isAdmin"] = 0;
}
?>

<html lang="de" dir="ltr">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

        <!-- Custom CSS -->
        <link rel="stylesheet" href="res/css/custom.css">
        <link rel="stylesheet" type="text/css" href="res/css/chat.css">

        <!-- JS, Popper.js, and jQuery -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>


        <!-- FancyApps -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
        <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>

        <!-- JS -->
        <script type="text/javascript" src="res/js/pictureCloud.js"></script>
        <script type="text/javascript" src="res/js/chat.js"></script>

        <!-- PAWLIK ADDITIONAL SOURCES - JQuery Slim build does not include ajax functions, full build is needed -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Lighbox -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.1/css/lightbox.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.1/js/lightbox.js"></script>

    <!-- Leaflet  -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin="" />
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>



        <title>Picture Cloud</title>

    <!-- <title>PictureCloud</title> -->
    </head>

    <body>
        <?php
        /* Model and functional includes */
        // include 'config/fileLocations.php';
        include 'util/include.php';


  <body>
    <?php
      /* Model and functional includes */
      include 'util/include.php';

      /* includes for html page itself (html elements) */
      include 'inc/buildHTML.php';


        if ($_SESSION["loginStatus"]) {
            include 'inc/chat.php';
        }
        ?>
    </body>


</html>
