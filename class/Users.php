<?php

    /**
     * Class Users
     */
class Users
{
    use Db;
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $pseudo;
    /**
     * @var string
     */
    private $password;
    /**
     * @var int
     */
    private $rank;

    /**
     * Users constructor
     * @param $pseudo string
     */
    public function __construct($pseudo)
    {
        $this->pseudo = $pseudo;
        $this->rank = 1;
    }

    /**
     * @param $id int
     */
    private function setId($id){
        $this->id = $id;
    }

    /**
     * @param $pseudo string
     */
    private function setPseudo($pseudo){
        $this->pseudo = $pseudo;
    }

    /**
     * @param $password string
     */
    private function setPassword($password){
        $this->password = $password;
    }

    /**
     * @param $rank int
     */
    private function setRank($rank){
        $this->rank = $rank;
    }

    /**
     * @return int
     */
    public function getId(){ return $this->id;}

    /**
     * @return string
     */
    public function getPseudo(){ return $this->pseudo;}

    /**
     * @return string
     */
    public function getPassword(){ return $this->password;}

    /**
     * @return int
     */
    public function getRank(){ return $this->rank;}

    /**
     * @param $pseudo string
     * @return int|null
     */
    private function searchUserId($pseudo){
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

    /**
     * @param $password string
     */
    public function addUser($password){
        $this->setId($this->searchUserId($this->getPseudo()));
        $this->setPassword($password);

        if(!isset($this->id)){
            $sql = $this->getDB()->prepare('INSERT INTO user (pseudo, password, group_id) VALUES (:pseudo, :password, :group_id)');

            $sql->bindParam(':pseudo', $this->getPseudo());
            $sql->bindParam(':password', $this->getPassword());
            $sql->bindParam(':group_id', $this->getRank());

            $sql->execute();

            $sql->closeCursor();
        }

        header('location: ../public/views/login.php');
    }

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
            header('location: ../public/views/sendArticle.php');
        }
    }
}