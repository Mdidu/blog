<?php
require_once "header.php";
?>
<form action="../controllers/backend.php" method="post">

        <label for="pseudo"></label>
        <input type="text" name="pseudo" id="pseudo" placeholder="Entrez votre pseudo">

        <label for="password"></label>
        <input type="password" name="password" id="password" placeholder="Entrez votre mot de passe">

        <label for="checkPassword"></label>
        <input type="password" name="checkPassword" id="checkPassword" placeholder="Entrez de nouveau votre mot de passe">

        <input type="hidden" name="page" value="inscription" id="page">
    <input type="submit" id="submit">

</form>
<?php
require_once "footer.php";
