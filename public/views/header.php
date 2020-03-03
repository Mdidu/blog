<?php

if(!isset($_SESSION)){
    session_start();
}
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php if($_SESSION['page'] === "index"):?>
        <link rel="stylesheet" href="public/css/style.css">
    <?php
    else:
    ?>
        <link rel="stylesheet" href="../css/style.css">
    <?php endif;?>
    <title>Blog</title>
</head>
<body>
<div id="main">
    <?php
    if(isset($_SESSION['pseudo'])):
        ?>
        <a href="../../models/logout.php">Déconnexion</a>
        <div>Bienvenue, <span class="user"><?= $_SESSION['pseudo'];?></span></div>
    <?php
    else:
        ?>
        <div id="log">
            <a href="public/views/register.php" id="register">Inscription</a>
            <a href="public/views/login.php" id="login">Login</a>
        </div>
    <?php
    endif;