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
    public function updateArticles(){

    }
    public function deleteArticles(){

    }

    //TODO: Diviser en une méthode d'affichage

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
        </div>
<?php
            $i++;
    endwhile;
    }
}