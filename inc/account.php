<div class="container">
    <?php
    // these variables help to display messages at certain points for error handling
    $loginErr = FALSE;
    $userInactiveErr = FALSE;
    $userExistsErr = FALSE;
    $pwRegisterErr = FALSE;
    $registerSuccess = FALSE;

    // LOGIN: check credentials for login
    if (null !== (filter_input(INPUT_POST, "anmelden"))) {
        // Calls SELECT on users to check password 
        // 0 - false password
        // 1 - successful login
        // 2 - user inaktive, login not permitted
        switch (userLogin(filter_input(INPUT_POST, "username"), filter_input(INPUT_POST, "password"))) {
            case 0:
                $loginErr = TRUE;
                break;
            case 1:
                //reload page to have session set to TRUE
                header("Location: index.php?page=pics");
                break;
            case 2:
                $userInactiveErr = TRUE;
                break;
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