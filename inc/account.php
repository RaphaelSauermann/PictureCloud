<div class="container">
    <?php
    $loginErr = FALSE;
    $userExistsErr = FALSE;
    $pwRegisterErr = FALSE;

    // check credentials for login
    if (null !== (filter_input(INPUT_POST, "anmelden"))) {
        // Calls SELECT on users to check password
        if (!userLogin(filter_input(INPUT_POST, "username"), filter_input(INPUT_POST, "password"))) {
            $loginErr = TRUE;
        }
    }

    // register user if not already exists
    if (null !== (filter_input(INPUT_POST, "registrieren"))) {
        if (filter_input(INPUT_POST, "password") !== filter_input(INPUT_POST, "password2")) {
            $pwRegisterErr = TRUE;
        } elseif (userExists(filter_input(INPUT_POST, "username"))) {
            $userExistsErr = TRUE;
        } else {
            userRegister();
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


        include 'inc/register.php';

        if ($pwRegisterErr) {
            echo "Die eingegebenen Passwörter stimmen nicht überein.";
        }
        if ($userExistsErr) {
            echo "Username '" . filter_input(INPUT_POST, "username") . "' ist bereits vergeben.";
        }
    }
    ?>
</div>