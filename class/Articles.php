<?php
require 'Blog.php';
//TODO: Méthodes à découper 1 méthode = 1 action
class Articles extends Blog
{

//    private $id;
    private $title;
    private $contend;
    private $date;
    private $author;
//    private $commentary;

    public function __construct($title, $contend, $date, $author)
    {
        $this->title = $title;
        $this->contend = $contend;
        $this->date = $date;
        $this->author = $author;
    }

    //Articles
    public function addArticles(){
        $sql = $this->getDB()->prepare("INSERT INTO articles (title, contend, date, user_id) VALUES (:title, :contend, :date, :user_id)");

        $sql->bindParam(":title", $this->title);
        $sql->bindParam(":contend", $this->contend);
        $sql->bindParam(":date", $this->date);
        $sql->bindParam(":user_id", $this->author);

        $sql->execute();

        $sql->closeCursor();

//        header('location: ../views/sendArticle.php');
    }
    public function updateArticles(){

    }
    public function deleteArticles(){

    }
    //TODO: Diviser en une méthode d'affichage et une méthode de recherche dans le database
    public function getArticles(){
        $sql = $this->getDB()->prepare("SELECT * FROM articles");

        $sql->execute();

        while($row = $sql->fetch()){
            $id = $row['id'];
            $title = $row["title"];
            $contend = $row["contend"];
            $pseudo = $_SESSION['pseudo'];

            echo <<<HTML
        <div class='articles'>
            <div>
                <div>$title</div>
            </div>
            <div>$contend</div>
            <div>Ecrit par : $pseudo</div>
            <form action="sendCommentary.php" method="get">
                <input type="hidden" name="article_commentary" id="article_commentary" value="$id">
                <input type="submit" value="Ajouter/Voir un commentaire">
            </form>
        </div>
HTML;
        }

        $sql->closeCursor();
    }
}

//Crée une instance de blog
$blog = new Blog();
//Crée un nouvel article !!
$data = new Articles($_POST['title'], $_POST['contend'], time(), 1);
$data->addArticles();
