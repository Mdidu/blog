<?php
require_once "../trait/SearchArticle.php";
//TODO: Méthodes à découper 1 méthode = 1 action
class Articles extends Blog
{

    use SearchArticle;
    /**
    * @var int
     */
    private $id;
    /**
    * @var string Title of articles
     */
    private $title;
    /**
    * @var string contend of articles
     */
    private $contend;
    /**
     * @var string
     */
    private $date;
    /**
     * @var int pulishing date
     */
    private $timestamp;
    /**
    * @var string author of articles
     */
    private $author;

    public function __construct(/*$title, $contend, $date, $author*/)
    {
//        $this->title = $title;
//        $this->contend = $contend;
//        $this->date = $date;
//        $this->author = $author;
    }

    //Articles

    /**
    * @param $id int
     */
    private function setId($id){
        $this->id = $id;
    }
    /**
    * @param $title string
     */
    private function setTitle($title){
        $this->title = $title;
    }
    /**
    * @param $contend string
     */
    private function setContend($contend){
        $this->contend = $contend;
    }
    /**
    * @param $date int
     */
    private function setDate($date){
        $this->date = date('d/m/Y à H:i:s', $date);
    }
//    /**
//     * @param $date int
//     */
    private function setTimestamp($timestamp){
        $this->timestamp = $timestamp;
    }
    /**
    * @param $author string
     */
    private function setAuthor($author){
        $this->author = $author;
    }
    /**
    * @return int
     */
    public function getId(){ return $this->id; }
    /**
    * @return string
     */
    public function getTitle(){ return $this->title; }
    /**
    * @return string
     */
    public function getContend(){ return $this->contend; }
    /**
    * @return int
     */
    public function getDate(){ return $this->date; }
    /**
     * @return int
     */
    public function getTimestamp(){ return $this->timestamp; }
    /**
    * @return string
     */
    public function getAuthor(){ return $this->author; }
    /**
     * @param $title string
     * @param $contend string
     */
    private function setArticles($title, $contend){
        $this->title = $title;
        $this->contend = $contend;
        $this->timestamp = time();
        $this->author = $_SESSION['id'];
    }


    /**
    * @return array
     */
    private function searchAllArticles(){

            $sql = $this->getDB()->prepare(
    "SELECT articles.id AS article_id, title, articles.contend AS article_contend, articles.date AS article_date, pseudo
                FROM articles 
                LEFT JOIN user ON articles.user_id = user.id 
                ORDER BY date DESC"
            );

        $sql->execute();
        $rows = $sql->fetchAll();
        $sql->closeCursor();
        return $rows;
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
        $sql->bindParam(":date", $this->getTimestamp());
        $sql->bindParam(":user_id", $this->getAuthor());

        $sql->execute();

        $sql->closeCursor();

        header('location: ../views/sendArticle.php');
    }
    /**
    * @param $title string
    * @param $contend string
     */
    public function updateArticle($title, $contend){
        $this->setTitle($title);
        $this->setContend($contend);
        $this->setId($_POST['id']);

        $sql = $this->getDB()->prepare("UPDATE articles SET title = :title, contend = :contend WHERE id = :id");
        $sql->bindParam(":title", $this->getTitle());
        $sql->bindParam(":contend", $this->getContend());
        $sql->bindParam(":id", $this->getId());

        $sql->execute();
        $sql->closeCursor();
        header('location: ../views/sendArticle.php');
    }
    /**
    * @param $id int
     */
    public function deleteArticle($id){

        $this->setId($id);

        $sql = $this->getDB()->prepare("DELETE FROM articles WHERE id = :id");

        $sql->bindParam(":id", $this->getId());

        $sql->execute();
        $sql->closeCursor();

        header('location: ../views/sendArticle.php');

    }

    /**
    * @param $id int
     */
    public function getArticle($id){
        $this->setId($id);
        $rows = $this->search();

        $this->setTitle($rows[0]['title']);
        $this->setContend($rows[0]['article_contend']);
        $this->setTimestamp($rows[0]['article_date']);
        $this->setAuthor($rows[0]['pseudo']);

        require_once "../views/display_Articles.php";
       ?>
        <a href="sendArticle.php"> Retourner à la liste des articles</a>
<?php
    }

    public function getAllArticles(){

        $rows = $this->searchAllArticles();
//        $i = 0;

//            $this->setId($rows[$i]['article_id']);
//            $this->setTitle($rows[$i]["title"]);
//            $this->setContend($rows[$i]["article_contend"]);
//            $this->setAuthor($rows[$i]['pseudo']);

            require_once "../views/display_Articles.php";
    }
}