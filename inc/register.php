<h2> Registrieren </h2>
<form action="index.php?page=account" method="POST">

    <div class="form-group row">
        <label for="username" class="col-sm-4 col-form-label">Username</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="username" name="username" >
        </div>
    </div>

    <div class="form-group row">
        <label for="possword" class="col-sm-4 col-form-label">Passwort</label>
        <div class="col-sm-8">
            <input type="password" class="form-control" id="password" name="password" >
        </div>
    </div>

    <div class="form-group row">
        <label for="possword2" class="col-sm-4 col-form-label">Passwort bestätigen</label>
        <div class="col-sm-8">
            <input type="password" class="form-control" id="password2" name="password2" >
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
            <input type="text" class="form-control" id="vorname" name="vorname" >
        </div>
    </div>

    <div class="form-group row">
        <label for="nachname" class="col-sm-4 col-form-label">Nachname</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="nachname" name="nachname" >
        </div>
    </div>

    <div class="form-group row">
        <label for="adresse" class="col-sm-4 col-form-label">Adresse</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="adresse" name="adresse" >
        </div>
    </div>

    <div class="form-group row">
        <label for="plz" class="col-sm-4 col-form-label">PLZ</label>
        <div class="col-sm-8">
            <input type="number" class="form-control" id="plz" name="plz" >
        </div>
    </div>

    <div class="form-group row">
        <label for="ort" class="col-sm-4 col-form-label">Ort</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="ort" name="ort" >
        </div>
    </div>

    <div class="form-group row">
        <label for="email" class="col-sm-4 col-form-label">Email</label>
        <div class="col-sm-8">
            <input type="email" class="form-control" id="email" name="email" >
        </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-4"></div>
        <div class="col-sm-8">
            <button type="submit" name="registrieren" class="btn btn-primary">Registrieren</button>
        </div>
    </div>
</form>