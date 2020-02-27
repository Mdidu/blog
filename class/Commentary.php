<?php

class Commentary
{
    use Db;
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
    private $date_timestamp_commentary;
    /**
     * @var string
     */
    private $date_commentary;
    /**
     * @var string
     */
    private $author_commentary;
    /**
     * @var bool
     */
    private $comment;

    public function __construct()
    {
        $this->user_id = $_SESSION['id'];
        $this->comment = false;
    }

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
     * @param $date_timestamp_commentary int
     */
    private function setDateCommentary($date_timestamp_commentary){
        $this->date_commentary = date('d/m/Y à H:i:s' ,$date_timestamp_commentary);
    }
    /**
     * @param $date_commentary int
     */
    private function setTimestampCommentary($date_timestamp_commentary){
        $this->date_timestamp_commentary = $date_timestamp_commentary;
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
     * @return string
     */
    private function getDate(){ return $this->date_commentary; }

    /**
     * @return int
     */
    private function getTimestamp(){ return $this->date_timestamp_commentary; }
    /**
     * @return bool
     */
    private function getComment(){ return $this->comment; }


    /**
     * @return array search one commentary
     */
    private function searchCommentary(){
        $commentaryId = $this->getCommentaryId();
        $sql = $this->getDB()->prepare("
            SELECT commentary.id AS commentary_id, user_id, contend AS commentary_contend, commentary.date AS commentary_date, pseudo
            FROM commentary
            LEFT JOIN user ON commentary.user_id = user.id
            WHERE commentary.id = :id");

        $sql->bindParam(':id', $commentaryId);

        $sql->execute();

        $rows = $sql->fetchAll();
        $sql->closeCursor();
        return $rows;
    }

    /**
     * @return array
     */
    private function searchAllCommentary(){
        $articleId = $this->getId();
        $sql = $this->getDB()->prepare("
            SELECT commentary.id AS commentary_id, commentary.user_id, commentary.contend AS commentary_contend, commentary.date AS commentary_date, pseudo
            FROM commentary
            LEFT JOIN articles ON articles.id = commentary.articles_id
            LEFT JOIN user ON commentary.user_id = user.id
            WHERE articles_id = :articles_id
            ORDER BY commentary.date DESC");

        $sql->bindParam(':articles_id', $articleId);

        $sql->execute();

        $rows = $sql->fetchAll();
        $sql->closeCursor();
        return $rows;
    }

    /**
     * @param $articles_id int
     * @param $contend string
     */
    public function addCommentary($articles_id, $contend){
        $this->setContendCommentary($contend);
        //
        $this->setTimestampCommentary(time());
        $this->setArticlesId($articles_id);

        $sql = $this->getDB()->prepare("INSERT INTO commentary (contend, date, articles_id, user_id) VALUES (:contend, :date, :articles_id, :user_id)");

        $sql->bindParam(":contend", $this->getContend());
        $sql->bindParam(":date", $this->getTimestamp());
        $sql->bindParam(":articles_id", $this->getId());
        $sql->bindParam(":user_id", $this->getUserId());

        $sql->execute();

        $sql->closeCursor();

        header('location: ../public/views/sendCommentary.php?article_commentary='.$this->getId());
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

        header('location: ../public/views/sendCommentary.php?article_commentary='.$this->getId());
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

        header('location: ../public/views/sendCommentary.php?article_commentary='.$this->getId());
    }

    /**
     * @param $commentary_id int
     */
    public function getCommentary($commentary_id){

        $this->setCommentaryId($commentary_id);

        $i = NULL;

        $rows = $this->searchCommentary();
        $this->setContendCommentary($rows[0]['commentary_contend']);
        $this->setAuthorCommentary($rows[0]['pseudo']);

        $this->setComment(true);

        require_once "../views/getCommentary.php";
    }

    /**
     * @param $articles_id int
     */
    public function getAllCommentary($articles_id){
        if(isset($articles_id)){

            $i = 0;
            $this->setArticlesId($articles_id);

            $row_article = $this->search();

            $rows = $this->searchAllCommentary();

            if(!empty($rows)){
                $this->setComment(true);
            }
            require_once "../views/getCommentary.php";
        }
    }
}