<?php
    session_start();
    require "connect.php";

    function search_user($pseudo){
        global $db;
        $sql = $db->prepare("SELECT id, pseudo FROM user");

        $sql->execute();

        while($row = $sql->fetch()){
            if($row['pseudo'] == $pseudo){
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
            $sql = $db->prepare('INSERT INTO user (pseudo, password) VALUES (:pseudo, :password)');

            $sql->bindParam(':pseudo', $pseudo);
            $sql->bindParam(':password', $password);

            $sql->execute();

            $sql->closeCursor();
        }

        header('location: ../views/login.php');
    }

    //verify that the password and pseudo exists in the database
    function checkLog($pseudo, $password){
        global $db;

        $sql = $db->prepare("SELECT * FROM user WHERE pseudo = :pseudo");

        $sql->bindParam("pseudo", $pseudo);
        $sql->execute();

        while($row = $sql->fetch()){
            if ($pseudo === $row['pseudo'] && password_verify($password, $row['password'])) {

                $_SESSION['pseudo'] = $pseudo;
                // $_SESSION['group_id'] = $row['group_id'];
            }
        }
        $sql->closeCursor();

        if(isset($_SESSION['pseudo'])){
//            header('location: comment.php');
            header('location: ../controllers/backend.php');
            echo "Bijoul le cauwde of ".$_SESSION['pseudo'];
        }
    }
    //    echo json_encode("test");