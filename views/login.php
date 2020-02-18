<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="../controllers/backend.php" method="post">
        <label for="pseudo"></label>
        <input type="text" name="pseudo" id="pseudo" placeholder="Entrez votre pseudo">

        <label for="password"></label>
        <input type="password" name="password" id="password" placeholder="Entrez votre mot de passe">

        <input type="hidden" name="page" value="login" id="page">

<!--        <button id="submit">Envoyer</button>-->
        <input type="submit" id="submit">
    </form>
    <script src="../public/js/script.js"></script>

</body>
</html>

<?php
require "../models/connect.php";

function addUsers($pseudo, $password){
    global $db;

    $sql = $db->prepare('INSERT INTO user (pseudo, password) VALUES (:pseudo, :password,)');

    $sql->bindParam(':pseudo', $pseudo);
    $sql->bindParam(':password', $password);

    $sql->execute();

    $sql->closeCursor();
}