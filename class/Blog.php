<?php

class Blog{
    protected $db; //instance de pdo

    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "blog";

    public function __construct()
//    public function __construct($db)
    {
//        $this->setDb($db);

    }
    //Database
//    public function setDb(PDO $db){
//        $this->db = $db;
//    }
    public function getDB(){
        $db = new PDO('mysql:host='.$this->servername.';dbname='.$this->dbname.';charset=utf8', $this->username, $this->password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $this->db = $db;
        return $db;
    }
}























//class Blog{
//    private $pdo;
//
//    public function __construct(Db $db)
//    {
//        $this->pdo = $db->dbObj;
//
//    }
//
//    public function getArticles(){
//        $res = $this->pdo->prepare();
////        $result = $this->pdo->query("SELECT nom FROM blog WHERE 1");
////        $res = $result->fetch();
////        return $res;
//    }
//
//    public function getCommentary(){
//
//    }
//}