<?php

class Commentary extends Blog
{
    private $articles_id;
    private $user_id;
    private $contend_commentary;
    private $date_commentary;
    private $author_commentary;
    private $comment;

    public function __construct()
    {

        $this->user_id = $_SESSION['id'];
        $this->comment = false;
    }
    private function setArticlesId($articles_id){
        $this->articles_id = $articles_id;
    }
    private function setContendCommentary($contend_commentary){
        $this->contend_commentary = $contend_commentary;
    }
    private function setDateCommentary($date_commentary){
        $this->date_commentary = $date_commentary;
    }
    private function setAuthorCommentary($author_commentary){
        $this->author_commentary = $author_commentary;
    }
    private function setComment($comment){
        $this->comment = $comment;
    }
    //Commentary
    private function searchCommentary(/*$articles_id*/){

//        $sql = $this->getDB()->prepare("SELECT * FROM commentary LEFT JOIN articles ON articles.id = commentary.articles_id WHERE articles_id = :articles_id ORDER BY commentary.date DESC");
        $sql = $this->getDB()->prepare("
            SELECT commentary.user_id, commentary.contend AS commentary_contend, pseudo 
            FROM commentary 
            LEFT JOIN articles ON articles.id = commentary.articles_id 
            LEFT JOIN user ON commentary.user_id = user.id 
            WHERE articles_id = :articles_id 
            ORDER BY commentary.date DESC");
//        $sql = $this->getDB()->prepare("SELECT articles.id, title, contend, date, user_id, pseudo FROM articles LEFT JOIN user ON articles.user_id = user.id  WHERE articles.id = :id");

        $sql->bindParam(':articles_id', $this->articles_id);

        $sql->execute();
        $row = $sql->fetchAll();
        $sql->closeCursor();
        return $row;
    }
    public function addCommentary($articles_id, $contend){
        //TODO: Peut-être kick le timestamp
        $this->setContendCommentary($contend);
        $this->setDateCommentary(time());
        $this->setArticlesId($articles_id);

//        $this->contend_commentary = $contend;
//        $this->date_commentary = time();
//        $this->articles_id = $articles;
//TODO: A MODIFIER
        $sql = $this->getDB()->prepare("INSERT INTO commentary (contend, date, articles_id, user_id) VALUES (:contend, :date, :articles_id, :user_id)");

        $sql->bindParam(":contend", $this->contend_commentary);
        $sql->bindParam(":date", $this->date_commentary);
        $sql->bindParam(":articles_id", $this->articles_id);
        $sql->bindParam(":user_id", $this->user_id);

        $sql->execute();

        $sql->closeCursor();
        header('location: ../views/sendCommentary.php?article_commentary='.$this->articles_id);
    }
    public function updateCommentary(){

    }
    public function deleteCommentary(){

    }
    private function searchArticle(/*$articles_id*/){
        $sql = $this->getDB()->prepare("
            SELECT articles.id, title, articles.contend AS article_contend, articles.date, pseudo FROM articles 
            LEFT JOIN user ON articles.user_id = user.id 
            WHERE articles.id = :id");
        $sql->bindParam(':id', $this->articles_id);
        $sql->execute();
        $row = $sql->fetchAll();
        $sql->closeCursor();
        return $row;
    }
    //TODO: A découper en plusieurs méthodes !!
    public function getCommentary($articles_id){
        if(isset($articles_id)){

            $i = 0;
            $j = 0;
            $this->setArticlesId($articles_id);
            $row = $this->searchArticle(/*$this->articles_id*/);

            $row_commentary = $this->searchCommentary(/*$this->articles_id*/);
            if(!empty($row_commentary)){
                $this->setComment(true);
            }

            while($j < intval(count($row)) || $j < intval(count($row_commentary))):

//                $pseudo = $_SESSION['pseudo'];
                //si l'article n'est pas sur la page, on affiche l'article
                if($i === 0):
                    $contend = $row[$i]['article_contend'];
                    $title = $row[$i]['title'];
                    $pseudo = $row[$i]['pseudo'];
                    ?>
                    <div class='articles'>
                        <div><?= $title ?></div>
                        <div><?= $contend ?></div>
                        <div>Ecrit par : <?= $pseudo ?></div>
                    </div>
                    <?php
                    $i++;
                endif;
                if($this->comment === true):

                    $this->setContendCommentary($row_commentary[$j]['commentary_contend']);
                    $this->setAuthorCommentary($row_commentary[$j]['pseudo']);
                    ?>
                    <div class="commentary">
                        <div><?= $this->contend_commentary; ?></div>
                        <div>Ecrit par : <?= $this->author_commentary ?></div>
                    </div>
                <?php
                endif;
                $j++;
            endwhile;
        }
    }
}