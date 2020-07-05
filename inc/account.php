<div class="container">
    <?php
    $loginErr = FALSE;

    // check for correct credentials
    if (null !== (filter_input(INPUT_POST, "anmelden"))) {
        // Calls SELECT on users to check password
        if (userLogin(filter_input(INPUT_POST, "username"), filter_input(INPUT_POST, "password"))) {
            $_SESSION["loginStatus"] = TRUE;
        } else {
            $loginErr = TRUE;
        }
    }


    if ($_SESSION["loginStatus"] === TRUE) {
        echo "<h3> angemeldet </h3>";
        // include user page
    } else {
        include 'inc/login.php';
        if ($loginErr) {
            echo "Benutzername und Passwort stimmen nicht überein, überprüfen Sie ihre Eingabe.";
        }
    }
    ?>
</div>