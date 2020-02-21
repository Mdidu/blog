<?php
//require "Blog.php";

class Commentary extends Blog
{
    private $articles_id;
    private $contend;
    private $date;
    private $author;

    public function __construct()
    {

    }

    //Commentary
    private function searchCommentary(){
        $sql = $this->getDB()->prepare("SELECT * FROM commentary LEFT JOIN user ON commentary.articles_id = articles.id");

        $sql->execute();
        $row = $sql->fetchAll();
        $sql->closeCursor();
        return $row;
    }
    public function addCommentary($articles, $contend){
        //TODO: Peut-être kick le timestamp
        $timestamp = time();

        $sql = $this->getDB()->prepare("INSERT INTO commentary (contend, date, articles_id) VALUES (:contend, :date, :articles_id)");

        $sql->bindParam(":contend", $contend);
        $sql->bindParam(":date", $timestamp);
        $sql->bindParam(":articles_id", $articles);

        $sql->execute();

        $sql->closeCursor();
        header('location: ../views/sendCommentary.php?article_commentary='.$articles);
    }
    public function updateCommentary(){

    }
    public function deleteCommentary(){

    }
    //TODO: A découper en plusieurs méthodes !!
    public function getCommentary($articles_id){
//        $row = $this->searchCommentary();
        if(isset($articles_id)){
            $sql = $this->getDB()->prepare("SELECT * FROM commentary LEFT JOIN articles ON articles.id = commentary.articles_id WHERE articles_id = :articles_id");

            $sql->bindParam(':articles_id', $articles_id);
            $sql->execute();

            $i = 0;
//        $data = $sql->fetchAll();
            while($row = $sql->fetch()):
//            var_dump($row);
                $contend = $row['contend'];
                $title = $row['title'];
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
                ?>
                <div class="commentary">
                    <div><?= $row[1]; ?></div>
                </div>
            <?php
            endwhile;
            $sql->closeCursor();
        }
    }
}