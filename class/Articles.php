<?php

//TODO: Méthodes à découper 1 méthode = 1 action
class Articles extends Blog
{

    private $id;
    private $title;
    private $contend;
    private $date;
    private $author;

    public function __construct(/*$title, $contend, $date, $author*/)
    {
//        $this->title = $title;
//        $this->contend = $contend;
//        $this->date = $date;
//        $this->author = $author;
    }

    //Articles

    private function setId($id){
        $this->id = $id;
    }
    private function setTitle($title){
        $this->title = $title;
    }
    private function setContend($contend){
        $this->contend = $contend;
    }
    private function setDate($date){
        $this->date = $date;
    }
    private function setAuthor($author){
        $this->author = $author;
    }

    public function getId(){ return $this->id; }
    public function getTitle(){ return $this->title; }
    public function getContend(){ return $this->contend; }
    public function getDate(){ return $this->date; }
    public function getAuthor(){ return $this->author; }
    /**
     * @param $title string
     * @param $contend string
     */
    private function setArticles($title, $contend){
        $this->title = $title;
        $this->contend = $contend;
        $this->date = time();
        $this->author = $_SESSION['id'];
    }

    /**
     * @return array
     */
    private function searchArticles(){

            $sql = $this->getDB()->prepare(
    "SELECT articles.id AS article_id, title, articles.contend AS article_contend, pseudo 
                FROM articles 
                LEFT JOIN user ON articles.user_id = user.id 
                ORDER BY date DESC"
            );

        $sql->execute();
        $row = $sql->fetchAll();
        $sql->closeCursor();
        return $row;
    }

    /**
     * @param $title string
     * @param $contend string
     */
    public function addArticles($title, $contend){
        $this->setArticles($title, $contend);

        $sql = $this->getDB()->prepare("INSERT INTO articles (title, contend, date, user_id) VALUES (:title, :contend, :date, :user_id)");

        $sql->bindParam(":title", $this->getTitle());
        $sql->bindParam(":contend", $this->getContend());
        $sql->bindParam(":date", $this->getDate());
        $sql->bindParam(":user_id", $this->getAuthor());

        $sql->execute();

        $sql->closeCursor();

        header('location: ../views/sendArticle.php');
    }
    public function updateArticle($title, $contend){
        $this->setTitle($title);
        $this->setContend($contend);
        $this->setId($_POST['id']);

        $sql = $this->getDB()->prepare("UPDATE articles SET title = :title, contend = :contend WHERE id = :id");
        $sql->bindParam(":title", $this->getTitle());
        $sql->bindParam(":contend", $this->getContend());
        $sql->bindParam(":id", $this->getId());
        //$sql = $bdd->prepare("UPDATE commentary SET comment = :comment, last_modified_user = :last_modified_user, modified = :modified WHERE id = :id");
        $sql->execute();
        $sql->closeCursor();
        header('location: ../views/sendArticle.php');
    }
    public function deleteArticle($id){

        $this->setId($id);

        $sql = $this->getDB()->prepare("DELETE FROM articles WHERE id = :id");

//        LEFT JOIN commentary ON articles.id = commentary.articles_id
        $sql->bindParam(":id", $this->getId());

        $sql->execute();
        $sql->closeCursor();

//        $this->deleteComments();
        header('location: ../views/sendArticle.php');

    }

    //TODO: Diviser en une méthode d'affichage
//    private function searchArticle(){
//        $sql = $this->getDB()->prepare(
//"SELECT articles.id AS articles_id, title, contend, user_id, pseudo FROM articles
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
    private function searchArticle(){
        $sql = $this->getDB()->prepare("
            SELECT articles.id AS article_id, title, articles.contend AS article_contend, articles.date, pseudo FROM articles 
            LEFT JOIN user ON articles.user_id = user.id 
            WHERE articles.id = :id");
        $sql->bindParam(':id', $this->id);
        $sql->execute();
        $row = $sql->fetchAll();
        $sql->closeCursor();
        return $row;
    }
        /**
         * @param int|null $i
         */
    public function getAllArticles(){

        $row = $this->searchArticles();
        $i = 0;

        while($i < intval(count($row))):

            $this->setId($row[$i]['article_id']);
            $this->setTitle($row[$i]["title"]);
            $this->setContend($row[$i]["article_contend"]);
            $this->setAuthor($row[$i]['pseudo']);
            ?>
        <div class='articles'>
            <div>
                <div><?= $this->getTitle()?></div>
            </div>
            <div><?= $this->getContend()?></div>
            <div>Ecrit par : <?= $this->getAuthor()?></div>

            <form action="sendCommentary.php" method="get">
                <input type="hidden" name="article_commentary" id="article_commentary" value="<?= $this->getId()?>">
                <input type="submit" value="Ajouter/Voir un commentaire">
            </form>

            <form action="updateArticle.php" method="post">
                <input type="hidden" name="article_title" class="articleUpdate" value="<?= $this->getTitle()?>">
                <input type="hidden" name="article_contend" class="articleUpdate" value="<?= $this->getContend()?>">
                <input type="hidden" name="article_id" class="articleUpdate" value="<?= $this->getId()?>">
                <input type="submit" value="Modifier article">
            </form>

            <form action="../controllers/backend.php" method="post">
                <input type="hidden" name="article_id" class="articleDelete" value="<?= $this->getId()?>">
                <input type="hidden" name="page" value="deleteArticle">
                <input type="submit" value="Supprimer article">
            </form>
        </div>
<?php
            $i++;
    endwhile;
    }
    public function getArticle($id){
        $this->setId($id);
        $row = $this->searchArticle();

        $this->setTitle($row[0]['title']);
        $this->setContend($row[0]['article_contend']);
        $this->setAuthor($row[0]['pseudo']);

        ?>
        <div class='articles'>
        <div>
            <div><?= $this->getTitle() ?></div>
        </div>
        <div><?= $this->getContend()?></div>
        <div>Ecrit par : <?= $this->getAuthor() ?></div>

        <a href="sendArticle.php"> Retourner à la liste des articles</a>
<?php
    }
}