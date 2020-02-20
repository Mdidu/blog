<?php
require "Blog.php";

class Users extends Blog
{
    private $id;
    private $pseudo;
    private $password;
    private $rank;

    public function __construct()
    {

    }

    //User
    private function search_user($pseudo){
        $sql = $this->getDB()->prepare("SELECT id, pseudo FROM user");

        $sql->execute();

        while($row = $sql->fetch()){
            if($row['pseudo'] === $pseudo){
                $id = $row['id'];
                $sql->closeCursor();

                return $id;
            }
        }
        $sql->closeCursor();
        return NULL;
    }

    public function addUser(){
        $id = $this->search_user($this->pseudo);
        //if $id !== NULL && EXIST
        if(!isset($id)){
            //rank members : 1 = User
            $rank = 1;
            $sql = $this->getDB()->prepare('INSERT INTO user (pseudo, password, group_id) VALUES (:pseudo, :password, :group_id)');

            $sql->bindParam(':pseudo', $pseudo);
            $sql->bindParam(':password', $password);
            $sql->bindParam(':group_id', $rank);

            $sql->execute();

            $sql->closeCursor();
        }

//        header('location: ../views/login.php');
    }
    public function updateUser(){

    }
    public function deleteUser(){

    }
//    public function getUser(){
//        $sql = $this->db->prepare("SELECT * FROM user");
//
//        $sql->execute();
//        while($row = $sql->fetch()){
//            $id = $row['id'];
//            $sql->closeCursor();
//            echo $row['pseudo'];
//        }
//    }
//TODO: peut-être à couper en 2 méthodes !!
    private function checkLog($pseudo, $password){

        $sql = $this->getDB()->prepare("SELECT * FROM user WHERE pseudo = :pseudo");

        $sql->bindParam(":pseudo", $pseudo);
        $sql->execute();

        while($row = $sql->fetch()){
            if ($pseudo === $row['pseudo'] && password_verify($password, $row['password'])) {

                $_SESSION['id'] = $row['id'];
                $_SESSION['pseudo'] = $pseudo;
                $_SESSION['group_id'] = $row['group_id'];
            }
        }
        $sql->closeCursor();

        if(isset($_SESSION['pseudo'])){
//            header('location: comment.php');
//            header('location: ../controllers/backend.php');
            header('location: ../views/sendArticle.php');
//            echo "Bijoul le cauwde of ".$_SESSION['pseudo'];
        }
    }

}