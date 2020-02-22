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

    public function getId(){
        return $this->id;
    }
    public function getTitle(){
        return $this->title;
    }
    public function getContend(){
        return $this->contend;
    }
    public function getDate(){
        return $this->date;
    }
    public function getAuthor(){
        return $this->author;
    }
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
    "SELECT articles.id AS articles_id, title, contend, pseudo 
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

        $sql->bindParam(":title", $this->title);
        $sql->bindParam(":contend", $this->contend);
        $sql->bindParam(":date", $this->date);
        $sql->bindParam(":user_id", $this->author);

        $sql->execute();

        $sql->closeCursor();

        header('location: ../views/sendArticle.php');
    }
    public function updateArticle($title, $contend){
        $this->setTitle($title);
        $this->setContend($contend);
        $this->setId($_POST['id']);

        $sql = $this->getDB()->prepare("UPDATE articles SET title = :title, contend = :contend WHERE id = :id");
        $sql->bindParam(":title", $this->title);
        $sql->bindParam(":contend", $this->contend);
        $sql->bindParam(":id", $this->id);
        //$sql = $bdd->prepare("UPDATE commentary SET comment = :comment, last_modified_user = :last_modified_user, modified = :modified WHERE id = :id");
        $sql->execute();
        $sql->closeCursor();
        header('location: ../views/sendArticle.php');
    }
    public function deleteArticles(){

    }

    //TODO: Diviser en une méthode d'affichage
    private function searchArticle(){
        $this->setId($this->id);
        $sql = $this->getDB()->prepare(
"SELECT articles.id AS articles_id, title, contend, user_id, pseudo FROM articles 
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
    public function getArticles(){

        $row = $this->searchArticles();
        $i = 0;

        while($i < intval(count($row))):

            $this->setId($row[$i]['articles_id']);
            $this->setTitle($row[$i]["title"]);
            $this->setContend($row[$i]["contend"]);
            $this->setAuthor($row[$i]['pseudo']);
            ?>
        <div class='articles'>
            <div>
                <div><?= $this->title ?></div>
            </div>
            <div><?= $this->contend ?></div>
            <div>Ecrit par : <?= $this->author ?></div>
            <form action="sendCommentary.php" method="get">
                <input type="hidden" name="article_commentary" id="article_commentary" value="<?= $this->id?>">
                <input type="submit" value="Ajouter/Voir un commentaire">
            </form>

            <form action="updateArticle.php" method="post">
                <input type="hidden" name="article_title" class="articleUpdate" value="<?= $this->title?>">
                <input type="hidden" name="article_contend" class="articleUpdate" value="<?= $this->contend?>">
                <input type="hidden" name="article_id" class="articleUpdate" value="<?= $this->id?>">
                <input type="submit" value="Modifier article">
            </form>

            <form action="deleteArticle.php" method="get">
                <input type="hidden" name="articleD" id="articleDelete" value="<?= $this->id?>">
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
        $this->setContend($row[0]['contend']);
        $this->setAuthor($row[0]['pseudo']);

        ?>
        <div class='articles'>
        <div>
            <div><?= $this->title ?></div>
        </div>
        <div><?= $this->contend ?></div>
        <div>Ecrit par : <?= $this->author ?></div>
        <a href="sendArticle.php"> Retourner à la liste des articles</a>
<?php
    }
}