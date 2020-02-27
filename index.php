<?php

session_start();
$_SESSION['page'] = "index";

require_once "public/views/header.php";

?>
    <h1>Blog</h1>

    <a href="public/views/inscription.php" id="inscription">Inscription</a>
    <a href="public/views/login.php" id="login">Login</a>

<?php
require_once "public/views/footer.php";