<?php
//    session_start();
    require "../class/Blog.php";
    require "../class/Users.php";
    require "../class/Articles.php";
//    $blog = new Blog();
    require_once "header.php";
    $user = new Users($_SESSION['pseudo']);

    $user->getUser();

    require_once "footer.php";