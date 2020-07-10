
<div class="row">
    <div class="col-sm-4">
        Username
    </div>
    <div class="col-sm-4">
        <?php echo $userObject->getUsername() ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        Email
    </div>
    <div class="col-sm-4">
        <?php echo $userObject->getEmail() ?>
    </div>
</div>
<div class="row">
    <div class="col-sm-4">
        Berechtigungen
    </div>
    <div class="col-sm-4">
        <?php
        if ($userObject->getIsAdmin() === 0) {
            echo "Standard";
        } else {
            echo "Admin";
        }
        ?>
    </div>
</div>
<hr>


<div class="accordion" id="profilverwaltung">
    <div class="card">
        <div class="card-header" id="editUserdataLabel">
            <h5 class="mb-0">
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#editUserdata" aria-expanded="true" aria-controls="collapseOne">
                    Profil bearbeiten
                </button>
            </h5>
        </div>
        <div id="editUserdata" class="collapse" aria-labelledby="headingOne" data-parent="#profilverwaltung">
            <div class="card-body">

                <form action="" method="POST">
                    <div class="form-group row">
                        <label for="benutzername" class="col-sm-4 col-form-label">Benutzername</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="benutzername" name="benutzername" value="<?php echo $userObject->getUsername() ?>" disabled>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="anrede" class="col-sm-4 col-form-label">Anrede</label>
                        <div class="col-sm-8">
                            <select class="form-control" id="anrede" name="anrede">
                                <option>Herr</option>
                                <?php
                                if ($userObject->getAnrede() === "Frau") {
                                    echo "<option selected>Frau</option>";
                                } else
                                    echo "<option>Frau</option>";
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="vorname" class="col-sm-4 col-form-label">Vorname</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="vorname" name="vorname" value="<?php echo $userObject->getVorname() ?>" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="nachname" class="col-sm-4 col-form-label">Nachname</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="nachname" name="nachname" value="<?php echo $userObject->getNachname() ?>" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="adresse" class="col-sm-4 col-form-label">Adresse</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="adresse" name="adresse" value="<?php echo $userObject->getAdresse() ?>" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="plz" class="col-sm-4 col-form-label">PLZ</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="plz" name="plz" value='<?php echo $userObject->getPlz() ?>' required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="ort" class="col-sm-4 col-form-label">Ort</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="ort" name="ort" value="<?php echo $userObject->getOrt() ?>" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-sm-4 col-form-label">Email</label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $userObject->getEmail() ?>" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-4"></div>
                        <div class="col-sm-8">
                            <button type="submit" name="updateUserData" class="btn btn-primary">Änderungen bestätigen</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>


    <div class="card">
        <div class="card-header" id="editPasswordLabel">
            <h5 class="mb-0">
                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#editPassword" aria-expanded="false" aria-controls="collapseTwo">
                    Passwort ändern
                </button>
            </h5>
        </div>
        <div id="editPassword" class="collapse" aria-labelledby="headingTwo" data-parent="#profilverwaltung">
            <div class="card-body">

                <form action="" method="POST">
                    <div class="form-group row">
                        <label for="old_password" class="col-sm-4 col-form-label">altes Passwort</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="old_password" name="old_password" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="new_password" class="col-sm-4 col-form-label">neues Passwort</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="new_password" name="new_password" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="new_password2" class="col-sm-4 col-form-label">neues Passwort bestätigen</label>
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="new_password2" name="new_password2" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-4"></div>
                        <div class="col-sm-8">
                            <button type="submit" name="changePassword" class="btn btn-primary">Passwort ändern</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<?php
if (null !== (filter_input(INPUT_POST, "changePassword"))) {
    if (filter_input(INPUT_POST, "new_password") !== filter_input(INPUT_POST, "new_password2")) {
        echo "Die eingegebenen neuen Passwörter stimmen nicht überein.";
    } elseif ($userObject->changeUserPassword(filter_input(INPUT_POST, "old_password"), filter_input(INPUT_POST, "new_password"))) {
        echo "Passwort wurde erfolgreich geändert";
    } else {
        echo "Das eingegebene aktuelle Passwort ist nicht korrekt.";
    }
}

if (null !== (filter_input(INPUT_POST, "updateUserData"))) {
    $uid = $userObject->getUid();
    $username = $userObject->getUsername();
    $passwort = $userObject->getPasswort();
    $anrede = filter_input(INPUT_POST, "anrede");
    $vorname = filter_input(INPUT_POST, "vorname");
    $nachname = filter_input(INPUT_POST, "nachname");
    $adresse = filter_input(INPUT_POST, "adresse");
    $plz = filter_input(INPUT_POST, "plz");
    $ort = filter_input(INPUT_POST, "ort");
    $email = filter_input(INPUT_POST, "email");
    $isAdmin = $userObject->getIsAdmin();
    $isActive = $userObject->getIsActive();
    $updatedUser = new User($uid, $username, $passwort, $anrede, $vorname, $nachname, $adresse, $plz, $ort, $email, $isAdmin, $isActive);
    if ($updatedUser->updateUserData()) {
        echo "Userdaten aktualisiert";
    } else {
        echo "Fehler bei der Aktualisierung der Userdaten";
    }
}


