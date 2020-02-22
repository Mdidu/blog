<?php
//    session_start();
//require 'Blog.php';
//TODO: Méthodes à découper 1 méthode = 1 action
class Articles extends Blog
{

    private $id;
    private $title;
    private $contend;
    private $date;
    private $author;
//    private $commentary;

    public function __construct(/*$title, $contend, $date, $author*/)
    {
//        $this->title = $title;
//        $this->contend = $contend;
//        $this->date = $date;
//        $this->author = $author;
    }

    //Articles

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
        public function searchArticles(){

            $sql = $this->getDB()->prepare("SELECT * FROM articles LEFT JOIN user ON articles.user_id = user.id ORDER BY date DESC");

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
    public function getArticles(/*$i = NULL*/){
//        $sql = $this->getDB()->prepare("SELECT * FROM articles");
//
//        $sql->execute();

        $row = $this->searchArticles();
$i = 0;
//        var_dump($row);
//        if($i >= 0):
        while($i < intval(count($row))):
            //id de l'article
            $this->id = $row[$i][0];
//        var_dump($row);
            $this->title = $row[$i]["title"];
            $this->contend = $row[$i]["contend"];
//            if($row[$i]['user_id'] == $row[$i]['id']){
            $this->author = $row[$i]['pseudo'];
//            }

//            var_dump($row[$i]['user_id']);
//            var_dump($row);
//            ?>
        <div class='articles'>
            <div>
                <div><?= $this->title ?></div>
            </div>
            <div><?= $this->contend ?></div>
            <div>Ecrit par : <?= $this->author ?></div>
<!--            <div>Ecrit par : --><?//= $row[$i]['user_id'];?><!--</div>-->
            <form action="sendCommentary.php" method="get">
                <input type="hidden" name="article_commentary" id="article_commentary" value="<?= $this->id?>">
                <input type="submit" value="Ajouter/Voir un commentaire">
            </form>
        </div>
<?php
            $i++;
    endwhile;
//    endif;
//        }

//        $sql->closeCursor();
    }
}

//Crée une instance de blog
//$blog = new Blog();

//Crée un nouvel article !!
//$data = new Articles($_POST['title'], $_POST['contend'], time(), $_SESSION['id']);
//$data->getArticles(0);
//$data->addArticles();

//$data->getArticles(0);