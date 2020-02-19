<?php
    session_start();
    require "connect.php";

    function search_user($pseudo){
        global $db;
        $sql = $db->prepare("SELECT id, pseudo FROM user");

        $sql->execute();

        while($row = $sql->fetch()){
            if($row['pseudo'] === $pseudo){
                $id = $row['id'];
                $sql->closeCursor();

                return $id;
            }
        }
        $sql->closeCursor();
        return NULL;
    }

    function addUsers($pseudo, $password){
        global $db;

        $id = search_user($pseudo);
        //if $id !== NULL && EXIST
        if(!isset($id)){
            //rank members : 1 = User
            $rank = 1;
            $sql = $db->prepare('INSERT INTO user (pseudo, password, group_id) VALUES (:pseudo, :password, :group_id)');

            $sql->bindParam(':pseudo', $pseudo);
            $sql->bindParam(':password', $password);
            $sql->bindParam(':group_id', $rank);

            $sql->execute();

            $sql->closeCursor();
        }

        header('location: ../views/login.php');
    }

    //verify that the password and pseudo exists in the database
    function checkLog($pseudo, $password){
        global $db;

        $sql = $db->prepare("SELECT * FROM user WHERE pseudo = :pseudo");

        $sql->bindParam(":pseudo", $pseudo);
        $sql->execute();

        while($row = $sql->fetch()){
            if ($pseudo === $row['pseudo'] && password_verify($password, $row['password'])) {

                $_SESSION['id'] = $row['id'];
                $_SESSION['pseudo'] = $pseudo;
                 $_SESSION['group_id'] = $row['group_id'];
            }
        }
        $sql->closeCursor();

        if(isset($_SESSION['pseudo'])){
//            header('location: comment.php');
//            header('location: ../controllers/backend.php');
            header('location: ../views/sendArticle.php');
//            echo "Bijoul le cauwde of ".$_SESSION['pseudo'];
        }
    }
    //    echo json_encode("test");

function addArticles($title, $contend){
    global $db;

    $timestamp = time();

    $sql = $db->prepare("INSERT INTO articles (title, contend, date, user_id) VALUES (:title, :contend, :date, :user_id)");

    $sql->bindParam(":title", $title);
    $sql->bindParam(":contend", $contend);
    $sql->bindParam(":date", $timestamp);
    $sql->bindParam(":user_id", $_SESSION['id']);

    $sql->execute();

    $sql->closeCursor();
}

function addCommentary($contend){
    global $db;

    $timestamp = time();
    $sql = $db->prepare("INSERT INTO commentary (contend, date, articles_id) VALUES (:contend, :date, :articles_id)");

    $sql->bindParam(":contend", $contend);
    $sql->bindParam(":date", $timestamp);
    $sql->bindParam(":articles_id", $articles);

    $sql->execute();

    $sql->closeCursor();
}

function getArticles(){
        global $db;

        $sql = $db->prepare("SELECT * FROM articles");

        $sql->execute();

        while($row = $sql->fetch()){
            echo "<div><div>".$row['title'].'</div><div>'.$row['contend']."</div></div>";
        }

        $sql->closeCursor();
}

function getCommentary($articles_id){
    global $db;

    $sql = $db->prepare("SELECT * FROM commentary WHERE articles_id = :articles_id");

    $sql->execute(":articles_id", $articles_id);

    $data = $sql->fetchAll();

    $sql->closeCursor();
}