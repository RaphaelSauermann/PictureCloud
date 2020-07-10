<div class="container">
    <h2> Abgemeldet </h2>
</div>

<?php
session_destroy();
header("Location: index.php?page=account");
?>