<?php
//require "Blog.php";

class Users extends Blog
{
    private $id;
    private $pseudo;
    private $password;
    private $rank;

    public function __construct($pseudo, $password)
    {
        $this->pseudo = $pseudo;
        $this->password = $password;
        $this->rank = 1;
    }

    //User

    /**
     * @param $pseudo
     * @return int|null
     */
    private function search_user($pseudo){
        $sql = $this->getDB()->prepare("SELECT id, pseudo FROM user");

        $sql->execute();

        while($row = $sql->fetch()){
            if($row['pseudo'] === $pseudo){
                $id = intval($row['id']);
                $sql->closeCursor();

                return $id;
            }
        }
        $sql->closeCursor();
        return NULL;
    }

    public function addUser(){
        $this->id = $this->search_user($this->pseudo);
        //if $id !== NULL && EXIST
        if(!isset($this->id)){
            $sql = $this->getDB()->prepare('INSERT INTO user (pseudo, password, group_id) VALUES (:pseudo, :password, :group_id)');

            $sql->bindParam(':pseudo', $this->pseudo);
            $sql->bindParam(':password', $this->password);
            $sql->bindParam(':group_id', $this->rank);

            $sql->execute();

            $sql->closeCursor();
        }

        header('location: ../views/login.php');
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
    public function checkLog($pseudo, $password){

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
//            header('location: ../controllers/backend.php');
            header('location: ../views/sendArticle.php');
//            echo "Bijoul le cauwde of ".$_SESSION['pseudo'];
        }
    }
}