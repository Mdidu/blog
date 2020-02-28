<?php

require_once "header.php";
?>
<h1>Inscription</h1>
<form action="../../controllers/backend.php" method="post" id="register">

        <label for="pseudo">Pseudo : </label>
        <input type="text" name="pseudo" id="pseudo" placeholder="Entrez votre pseudo">

        <label for="password">Mot de passe : </label>
        <input type="password" name="password" id="password" placeholder="Entrez votre mot de passe">

        <label for="checkPassword">Confirmation du mot de passe : </label>
        <input type="password" name="checkPassword" id="checkPassword" placeholder="Entrez de nouveau votre mot de passe">

        <input type="hidden" name="page" value="register" id="page">
    <input type="submit" id="submit" class="button">

</form>
<?php
require_once "footer.php";