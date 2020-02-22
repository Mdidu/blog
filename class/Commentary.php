<?php

class Commentary extends Blog
{
    private $articles_id;
    private $contend_commentary;
    private $date_commentary;
//    private $author_commentary;
    private $comment;

    public function __construct()
    {
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

        $sql = $this->getDB()->prepare("SELECT * FROM commentary LEFT JOIN articles ON articles.id = commentary.articles_id WHERE articles_id = :articles_id ORDER BY commentary.date DESC");

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

        $sql = $this->getDB()->prepare("INSERT INTO commentary (contend, date, articles_id) VALUES (:contend, :date, :articles_id)");

        $sql->bindParam(":contend", $this->contend_commentary);
        $sql->bindParam(":date", $this->date_commentary);
        $sql->bindParam(":articles_id", $this->articles_id);

        $sql->execute();

        $sql->closeCursor();
        header('location: ../views/sendCommentary.php?article_commentary='.$this->articles_id);
    }
    public function updateCommentary(){

    }
    public function deleteCommentary(){

    }
    private function searchArticle(/*$articles_id*/){
        $sql = $this->getDB()->prepare("SELECT * FROM articles WHERE id = :id");
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

            $row = $this->searchCommentary(/*$this->articles_id*/);
            if(!empty($row)){
                $this->setComment(true);
//                $this->comment = true;
            }else {
                $row = $this->searchArticle(/*$this->articles_id*/);
            }

            while($j < intval(count($row))):

                $contend = $row[$j]['contend'];
                $title = $row[$j]['title'];
//                $pseudo = $_SESSION['pseudo'];
                //si l'article n'est pas sur la page, on affiche l'article
                if($i === 0):
                    ?>
                    <div class='articles'>
                        <div><?= $title ?></div>
                        <div><?= $contend ?></div>
<!--                        <div>Ecrit par : --><?//= $pseudo ?><!--</div>-->
                    </div>
                    <?php
                    $i++;
                endif;
                if($this->comment === true):
                ?>
                <div class="commentary">
                    <div><?= $row[$j][1]; ?></div>
                </div>
            <?php
                endif;
            $j++;
            endwhile;
        }
    }
}