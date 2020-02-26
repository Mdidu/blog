<?php

    require_once "../trait/SearchArticle.php";
//TODO : problème méthode getId idem dans articles.php
class Commentary extends Blog
{

    use SearchArticle;

    /**
     * @var int
     */
    private $articles_id;
    /**
     * @var int
     */
    private $user_id;
    /**
     * @var int
     */
    private $commentary_id;
    /**
     * @var string
     */
    private $contend_commentary;
    /**
     * @var int
     */
    private $date_commentary;
    /**
     * @var string
     */
    private $author_commentary;
    /**
     * @var string
     */
    private $comment;

    public function __construct()
    {
        $this->user_id = $_SESSION['id'];
        $this->comment = false;
    }
    //SETTER

    /**
     * @param $articles_id int
     */
    private function setArticlesId($articles_id){
        $this->articles_id = $articles_id;
    }

    /**
     * @param $commentary_id int
     */
    private function setCommentaryId($commentary_id){
        $this->commentary_id = $commentary_id;
    }

    /**
     * @param $contend_commentary string
     */
    private function setContendCommentary($contend_commentary){
        $this->contend_commentary = $contend_commentary;
    }

    /**
     * @param $date_commentary int
     */
    private function setDateCommentary($date_commentary){
        $this->date_commentary = $date_commentary;
    }

    /**
     * @param $author_commentary string
     */
    private function setAuthorCommentary($author_commentary){
        $this->author_commentary = $author_commentary;
    }

    /**
     * @param $comment bool
     */
    private function setComment($comment){
        $this->comment = $comment;
    }
    //GETTER

    /**
     * @return int
     */
    private function getId(){ return $this->articles_id; }

    /**
     * @return int
     */
    private function getUserId(){ return $this->user_id; }

    /**
     * @return int
     */
    private function getCommentaryId(){ return $this->commentary_id; }

    /**
     * @return string
     */
    private function getContend(){ return $this->contend_commentary; }

    /**
     * @return string
     */
    private function getAuthor(){ return $this->author_commentary; }

    /**
     * @return int
     */
    private function getDate(){ return $this->date_commentary; }

    /**
     * @return bool
     */
    private function getComment(){ return $this->comment; }


    /**
     * @return array search one commentary
     */
    private function searchCommentary(){
        $sql = $this->getDB()->prepare("
            SELECT commentary.id AS commentary_id, user_id, contend AS commentary_contend, pseudo
            FROM commentary
            LEFT JOIN user ON commentary.user_id = user.id
            WHERE commentary.id = :id");

        $sql->bindParam(':id', $this->getCommentaryId());

        $sql->execute();

        $row = $sql->fetchAll();
        $sql->closeCursor();
        return $row;
    }

    /**
     * @return array
     */
    private function searchAllCommentary(){

        $sql = $this->getDB()->prepare("
            SELECT commentary.id AS commentary_id, commentary.user_id, commentary.contend AS commentary_contend, pseudo
            FROM commentary
            LEFT JOIN articles ON articles.id = commentary.articles_id
            LEFT JOIN user ON commentary.user_id = user.id
            WHERE articles_id = :articles_id
            ORDER BY commentary.date DESC");

        $sql->bindParam(':articles_id', $this->getId());

        $sql->execute();

        $row = $sql->fetchAll();
        $sql->closeCursor();
        return $row;
    }
    //EN FAIRE UN TRAIT

    /**
     * @return array search one article
     */
//    private function searchArticle(){
//        $sql = $this->getDB()->prepare("
//            SELECT articles.id AS article_id, title, articles.contend AS article_contend, articles.date, pseudo FROM articles
//            LEFT JOIN user ON articles.user_id = user.id
//            WHERE articles.id = :id");
//
//        $sql->bindParam(':id', $this->getId());
//
//        $sql->execute();
//        $row = $sql->fetchAll();
//        $sql->closeCursor();
//        return $row;
//    }

    /**
     * @param $articles_id int
     * @param $contend string
     */
    public function addCommentary($articles_id, $contend){
        //TODO: Peut-être kick le timestamp
        $this->setContendCommentary($contend);
        $this->setDateCommentary(time());
        $this->setArticlesId($articles_id);

        $sql = $this->getDB()->prepare("INSERT INTO commentary (contend, date, articles_id, user_id) VALUES (:contend, :date, :articles_id, :user_id)");

        $sql->bindParam(":contend", $this->getContend());
        $sql->bindParam(":date", $this->getDate());
        $sql->bindParam(":articles_id", $this->getId());
        $sql->bindParam(":user_id", $this->getUserId());

        $sql->execute();

        $sql->closeCursor();
        header('location: ../views/sendCommentary.php?article_commentary='.$this->getId());
    }

    /**
     * @param $contend string
     * @param $article_id int
     */
    public function updateCommentary($contend, $article_id){
        $this->setContendCommentary($contend);
        $this->setCommentaryId($_POST['id']);
        $this->setArticlesId($article_id);

        $sql = $this->getDB()->prepare("UPDATE commentary SET contend = :contend WHERE id = :id");

        $sql->bindParam(":contend", $this->getContend());
        $sql->bindParam(":id", $this->getCommentaryId());

        $sql->execute();
        $sql->closeCursor();
        header('location: ../views/sendCommentary.php?article_commentary='.$this->getId());
    }

    /**
     * @param $id int
     * @param $article_id int
     */
    public function deleteCommentary($id, $article_id){
        $this->setCommentaryId($id);
        $this->setArticlesId($article_id);

        $sql = $this->getDB()->prepare("DELETE FROM commentary WHERE id = :id");

        $sql->bindParam(":id", $this->getCommentaryId());

        $sql->execute();
        $sql->closeCursor();

        header('location: ../views/sendCommentary.php?article_commentary='.$this->getId());
    }

    /**
     * @param $commentary_id int
     */
    public function getCommentary($commentary_id){

        $this->setCommentaryId($commentary_id);

        $j= NULL;
        $i= 0;
        $row = $this->searchCommentary();
        $this->setContendCommentary($row[$i]['contend']);
        $this->setAuthorCommentary($row[$i]['pseudo']);

        $this->setComment(true);

        require_once "../views/display_Commentary.php";
    }

    //TODO: A découper en plusieurs méthodes !!

    /**
     * @param $articles_id int
     */
    public function getAllCommentary($articles_id){
        if(isset($articles_id)){

            $i = 0;
            $j = 0;
            $this->setArticlesId($articles_id);

            $row_article = $this->search();

            $row = $this->searchAllCommentary();

            if(!empty($row)){
                $this->setComment(true);
            }
            require_once "../views/display_Commentary.php";
        }
    }
}