<?php

//class Db
//{
//    public $db;
//
//    public function __construct()
//    {
//        $this->db = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '');
//        return $this->db;
//    }
//  }


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blog";

$db = new PDO('mysql:host='.$servername.';dbname='.$dbname.';charset=utf8', $username, $password);
$blog = new Blog($db);
$blog->getUser();

//$data = new Articles([
//    'title' => $_POST['title'],
//    "contend" => $_POST['contend'],
//    "date" => time(),
//    "author" => $_POST['author'],
//]);