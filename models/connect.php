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