<?php

include_once "header.php";
    ?>
<h1>Connexion</h1>
<form action="../../controllers/backend.php" method="post" id="login">
    <label for="pseudo">Pseudo : </label>
    <input type="text" name="pseudo" id="pseudo" placeholder="Entrez votre pseudo">

    <label for="password">Mot de passe :</label>
    <input type="password" name="password" id="password" placeholder="Entrez votre mot de passe">

    <input type="hidden" name="page" value="login" id="page">

    <input type="submit" id="submit" class="button">
</form>
<?php
include_once "footer.php";