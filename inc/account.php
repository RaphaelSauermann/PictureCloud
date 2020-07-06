<div class="container">
    <?php
    // these variables help to display messages at certain points
    $loginErr = FALSE;
    $userExistsErr = FALSE;
    $pwRegisterErr = FALSE;
    $registerSuccess = FALSE;

    // LOGIN: check credentials for login
    if (null !== (filter_input(INPUT_POST, "anmelden"))) {
        // Calls SELECT on users to check password
        if (userLogin(filter_input(INPUT_POST, "username"), filter_input(INPUT_POST, "password"))) {
            //reload page to have session set to TRUE
            header("Location: index.php?page=account");
        } else {
            $loginErr = TRUE;
        }
    }

    // REGISTER: check if passwords match and username already exists
    if (null !== (filter_input(INPUT_POST, "registrieren"))) {
        if (filter_input(INPUT_POST, "password") !== filter_input(INPUT_POST, "password2")) {
            $pwRegisterErr = TRUE;
        } elseif (userExists(filter_input(INPUT_POST, "username"))) {
            $userExistsErr = TRUE;
        } else {
            $registerSuccess = userRegister();
        }
    }

    if ($_SESSION["loginStatus"] === TRUE) {
        include "inc/userpage.php";
    } else {
        include "inc/login_register.php";
    }
    ?>
</div>