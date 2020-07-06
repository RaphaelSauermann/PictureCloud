<?php
// if error during register, sets the register tab to be active instead of login
$registerLastTab = (null !== (filter_input(INPUT_POST, "registrieren")));
?>

<ul class="nav nav-tabs justify-content-center nav-fill" id="myTab" role="tablist">
    <li class="nav-item">
        <?php
        if ($registerLastTab) {
            echo '<a class="nav-link" id="login-tab" data-toggle="tab" href="#login" role="tab" aria-controls="login" aria-selected="true">Login</a>';
        } else {
            echo '<a class="nav-link active" id="login-tab" data-toggle="tab" href="#login" role="tab" aria-controls="login" aria-selected="true">Login</a>';
        }
        ?>
    </li>
    <li class="nav-item">
        <?php
        if ($registerLastTab) {
            echo '<a class="nav-link active" id="register-tab" data-toggle="tab" href="#register" role="tab" aria-controls="register" aria-selected="false">Register</a>';
        } else {
            echo '<a class="nav-link" id="register-tab" data-toggle="tab" href="#register" role="tab" aria-controls="register" aria-selected="false">Register</a>';
        }
        ?>
    </li>
</ul>
<div class="tab-content" id="myTabContent">
    <?php
    if ($registerLastTab) {
        echo '<div class="tab-pane fade" id="login" role="tabpanel" aria-labelledby="login-tab">';
    } else {
        echo '<div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">';
    }
    ?>

    <h2> Login </h2>
    <form action="index.php?page=account" method="POST">

        <div class="form-group row">
            <label for="username" class="col-sm-4 col-form-label">Username</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="possword" class="col-sm-4 col-form-label">Passwort</label>
            <div class="col-sm-8">
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-4"></div>
            <div class="col-sm-8">
                <button type="submit" name="anmelden" class="btn btn-primary">Anmelden</button>
            </div>
        </div>
    </form>

    <?php
    if ($loginErr) {
        echo "Benutzername und Passwort stimmen nicht überein, überprüfen Sie ihre Eingabe.";
    }

    echo "</div>";


    if ($registerLastTab) {
        echo '<div class="tab-pane show active fade" id="register" role="tabpanel" aria-labelledby="register-tab">';
    } else {
        echo '<div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">';
    }
    ?>

    <h2> Registrieren </h2>
    <form action="index.php?page=account" method="POST">

        <div class="form-group row">
            <label for="username" class="col-sm-4 col-form-label">Username</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="password" class="col-sm-4 col-form-label">Passwort</label>
            <div class="col-sm-8">
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="password2" class="col-sm-4 col-form-label">Passwort bestätigen</label>
            <div class="col-sm-8">
                <input type="password" class="form-control" id="password2" name="password2" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="anrede" class="col-sm-4 col-form-label">Anrede</label>
            <div class="col-sm-8">
                <select class="form-control" id="anrede" name="anrede">
                    <option>Herr</option>
                    <option>Frau</option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="vorname" class="col-sm-4 col-form-label">Vorname</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="vorname" name="vorname" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="nachname" class="col-sm-4 col-form-label">Nachname</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="nachname" name="nachname" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="adresse" class="col-sm-4 col-form-label">Adresse</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="adresse" name="adresse" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="plz" class="col-sm-4 col-form-label">PLZ</label>
            <div class="col-sm-8">
                <input type="number" class="form-control" id="plz" name="plz" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="ort" class="col-sm-4 col-form-label">Ort</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="ort" name="ort" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="email" class="col-sm-4 col-form-label">Email</label>
            <div class="col-sm-8">
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-4"></div>
            <div class="col-sm-8">
                <button type="submit" name="registrieren" class="btn btn-primary">Registrieren</button>
            </div>
        </div>
    </form>

    <?php
    if ($pwRegisterErr) {
        echo "Die eingegebenen Passwörter stimmen nicht überein.";
    }
    if ($userExistsErr) {
        echo "Username '" . filter_input(INPUT_POST, "username") . "' ist bereits vergeben.";
    }
    if ($registerSuccess) {
        echo "User erfolgreich erstellt! Sie können sich nun anmelden.";
    }
    echo "</div>";
    ?>
</div>

