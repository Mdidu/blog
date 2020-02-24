<?php

//TODO : problème méthode getId idem dans articles.php
class Commentary extends Blog
{
    private $articles_id;
    private $user_id;
    private $commentary_id;
    private $contend_commentary;
    private $date_commentary;
    private $author_commentary;
    private $comment;

    public function __construct()
    {
        $this->user_id = $_SESSION['id'];
        $this->comment = false;
    }
    //SETTER
    private function setArticlesId($articles_id){
        $this->articles_id = $articles_id;
    }
    private function setCommentaryId($commentary_id){
        $this->commentary_id = $commentary_id;
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
    //GETTER
    private function getId(){ return $this->articles_id; }
    private function getUserId(){ return $this->user_id; }
    private function getCommentaryId(){ return $this->commentary_id; }
    private function getContend(){ return $this->contend_commentary; }
    private function getAuthor(){ return $this->author_commentary; }
    private function getDate(){ return $this->date_commentary; }
    private function getComment(){ return $this->comment; }
    //Commentary
    private function searchOneCommentary(){
        $sql = $this->getDB()->prepare("
            SELECT commentary.id AS commentary_id, user_id, contend, pseudo
            FROM commentary
            LEFT JOIN user ON commentary.user_id = user.id
            WHERE commentary.id = :id");

        $sql->bindParam(':id', $this->getCommentaryId());

        $sql->execute();

        $row = $sql->fetchAll();
        $sql->closeCursor();
        return $row;
    }
    private function searchCommentary(){

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
    public function deleteCommentary($id, $article_id){
        $this->setCommentaryId($id);
        $this->setArticlesId($article_id);

        $sql = $this->getDB()->prepare("DELETE FROM commentary WHERE id = :id");

        $sql->bindParam(":id", $this->getCommentaryId());

        $sql->execute();
        $sql->closeCursor();

        header('location: ../views/sendCommentary.php?article_commentary='.$this->getId());
    }
    //TODO: FAIRE UN TRAIT DE CETTE METHODE !! qui est en X2
    private function searchArticle(){
        $sql = $this->getDB()->prepare("
            SELECT articles.id AS article_id, title, articles.contend AS article_contend, articles.date, pseudo FROM articles 
            LEFT JOIN user ON articles.user_id = user.id 
            WHERE articles.id = :id");

        $sql->bindParam(':id', $this->getId());

        $sql->execute();
        $row = $sql->fetchAll();
        $sql->closeCursor();
        return $row;
    }
    public function getCommentary2($commentary_id){

        $this->setCommentaryId($commentary_id);

        $row = $this->searchOneCommentary();
        $this->setContendCommentary($row[0]['contend']);
        $this->setAuthorCommentary($row[0]['pseudo']);

        ?>
        <div class="commentary">
            <div><?= $this->getContend(); ?></div>
            <div>Ecrit par : <?= $this->getAuthor() ?></div>
        </div>
        <?php
    }
    //TODO: A découper en plusieurs méthodes !!
    public function getAllCommentary($articles_id){
        if(isset($articles_id)){

            $i = 0;
            $j = 0;
            $this->setArticlesId($articles_id);
            $row = $this->searchArticle();

            $row_commentary = $this->searchCommentary();
            if(!empty($row_commentary)){
                $this->setComment(true);
            }

            while($j < intval(count($row)) || $j < intval(count($row_commentary))):

//                $pseudo = $_SESSION['pseudo'];
                //si l'article n'est pas sur la page, on affiche l'article
                if($i === 0):
                    //TODO: ADD propriété + setter/getter pour les 3?
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
                if($this->getComment() === true):

                    $this->setCommentaryId($row_commentary[$j]['commentary_id']);
                    $this->setContendCommentary($row_commentary[$j]['commentary_contend']);
                    $this->setAuthorCommentary($row_commentary[$j]['pseudo']);
                    ?>
                    <div class="commentary">
                        <div><?= $this->getContend(); ?></div>
                        <div>Ecrit par : <?= $this->getAuthor() ?></div>
                    </div>

                    <form action="updateCommentary.php" method="post">
                        <input type="hidden" name="commentary_contend" class="commentaryUpdate" value="<?= $this->getContend()?>">
                        <input type="hidden" name="commentary_id" class="commentaryUpdate" value="<?= $this->getCommentaryId()?>">
                        <input type="hidden" name="article_id" class="commentaryUpdate" value="<?= $this->getId()?>">
                        <input type="submit" value="Modifier le commentaire">
                    </form>

                    <form action="../controllers/backend.php" method="post">
                        <input type="hidden" name="commentary_id" class="commentaryDelete" value="<?= $this->getCommentaryId()?>">
                        <input type="hidden" name="article_id" class="commentaryDelete" value="<?= $this->getId()?>">
                        <input type="hidden" name="page" value="deleteCommentary">
                        <input type="submit" value="Supprimer commentaire">
                    </form>
                <?php
                endif;
                $j++;
            endwhile;
        }
    }
}