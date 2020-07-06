<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.php?page=pics">Picture Cloud</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="index.php?page=pics">Bilder anschauen</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?page=upload">Bild hochladen</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?page=map">Bilderkarte</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php?page=help">Impressum & Hilfe</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="index.php?page=account">Account</a>
            </li>

            <?php
            echo '<li class = "nav-item">';
            if ($_SESSION["loginStatus"]) {
                echo '<a class = "nav-link" href = "index.php?page=logout">Logout</a>';
            } else {
                echo '<a class = "nav-link" href = "index.php?page=account">Login</a>';
            }
            echo '</li>';
            ?>
        </ul>
    </div>
</nav>
