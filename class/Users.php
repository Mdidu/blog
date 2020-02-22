<?php
//require "Blog.php";

    /**
     * Class Users
     */
class Users extends Blog
{
    private $id;
    private $pseudo;
    private $password;
    private $rank;

    /**
     * Users constructor
     * @param $pseudo string
     * @param $password string
     */
    public function __construct($pseudo, $password)
    {
        $this->pseudo = $pseudo;
        $this->password = $password;
        $this->rank = 1;
    }

    private function setId($id){
        $this->id = $id;
    }
    private function setPseudo($pseudo){
        $this->pseudo = $pseudo;
    }
    private function setPassword($password){
        $this->password = $password;
    }
    private function setRank($rank){
        $this->rank = $rank;
    }

    public function getId(){ return $this->id;}
    public function getPseudo(){ return $this->pseudo;}
    public function getPassword(){ return $this->password;}
    public function getRank(){ return $this->rank;}
    //User
    /**
     * @param $pseudo string
     * @return int|null
     */
    private function search_user($pseudo){
        $this->setPseudo($pseudo);
        $sql = $this->getDB()->prepare("SELECT id, pseudo FROM user");

        $sql->execute();

        while($row = $sql->fetch()){
            if($row['pseudo'] === $this->getPseudo()){
                $id = intval($row['id']);
                $sql->closeCursor();

                return $id;
            }
        }
        $sql->closeCursor();
        return NULL;
    }

    public function addUser(){
//        $this->id = $this->search_user($this->pseudo);
        $this->setId($this->search_user($this->getPseudo()));
//        $this->getId();
        //if $id !== NULL && EXIST
        if(!isset($this->id)){
            $sql = $this->getDB()->prepare('INSERT INTO user (pseudo, password, group_id) VALUES (:pseudo, :password, :group_id)');

            $sql->bindParam(':pseudo', $this->getPseudo());
            $sql->bindParam(':password', $this->getPassword());
            $sql->bindParam(':group_id', $this->getRank());

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
        /**
         * @param $pseudo string
         * @param $password string
         */
    public function checkLog($pseudo, $password){

        $this->setPseudo($pseudo);
        $this->setPassword($password);

        $sql = $this->getDB()->prepare("SELECT * FROM user WHERE pseudo = :pseudo");

        $sql->bindParam(":pseudo", $this->getPseudo());
        $sql->execute();

        while($row = $sql->fetch()){
            if ($this->getPseudo() === $row['pseudo'] && password_verify($this->getPassword(), $row['password'])) {

                $_SESSION['id'] = $row['id'];
                $_SESSION['pseudo'] = $this->getPseudo();
                $_SESSION['group_id'] = $row['group_id'];
            }
        }
        $sql->closeCursor();

        if(isset($_SESSION['pseudo'])){
//            header('location: ../controllers/backend.php');
            header('location: ../views/sendArticle.php');
        }
    }
}