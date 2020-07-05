<form method="post" action="">
  <table class="table table-sm table-striped" style="width:50%;">
    <thead>
      <tr>
        <th scope="col">Beschreibung</th>
        <th scope="col">Eingabe</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><label for="tagName">Tag:</label></td>
        <td><input type="text" name="tagName" id="tagName" value="" placeholder="Sonnenuntergang" required></td>
      </tr>
      <tr>
        <td><input type="reset" value="Abbrechen"></td>
        <td><input type="submit" value="Tag hinzufügen" /></td>
      </tr>
    </tbody>
  </table>
</form>

<?php
if (isset($_POST["tagName"])) {
    if ($_POST["tagName"]!=null) {
        $newTag = new Tag($_POST["tagName"]);
    }
}
 ?>
