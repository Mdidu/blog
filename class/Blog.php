<?php

class Blog{
    private $pdo;

    public function __construct(Db $db)
    {
        $this->pdo = $db->dbObj;

    }

    public function getArticles(){
        $res = $this->pdo->prepare();
//        $result = $this->pdo->query("SELECT nom FROM blog WHERE 1");
//        $res = $result->fetch();
//        return $res;
    }

    public function getCommentary(){

    }
}