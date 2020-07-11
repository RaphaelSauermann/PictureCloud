<div class="container">
    <h2> Abgemeldet </h2>
</div>

<?php
// destroys session, unsetting all session variables, and redirects to main page
session_destroy();
header("Location: index.php?page=account");
?>