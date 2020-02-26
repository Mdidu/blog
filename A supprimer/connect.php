<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blog";

try
{
    $db = new PDO('mysql:host='.$servername.';dbname='.$dbname.';charset=utf8', $username, $password);
}
catch (Exception $e)
{
    die('Erreur : '. $e->getMessage());
}

//    $sql = $db->prepare("SELECT * FROM articles LEFT JOIN user ON  user.id = articles.user_id");
//
//    $sql->execute();
//
////    $sql = $db->prepare("SELECT * FROM articles");
////
////    $sql->execute();
//    $row = $sql->fetchAll();
//    var_dump($row);