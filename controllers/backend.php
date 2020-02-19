<?php
//    session_start();
    require "../models/backend.php";

//    echo $_POST['page'];
    if(isset($_POST['page'])) {
        switch ($_POST['page']) {
            case "inscription":
                if (isset($_POST['pseudo']) && isset($_POST['password']) && isset($_POST['checkPassword']) && ($_POST['password'] === $_POST['checkPassword'])) {
                    addUsers($_POST['pseudo'], password_hash($_POST['password'], PASSWORD_DEFAULT));
                }
                break;
            case "login":
                if (isset($_POST['pseudo']) && isset($_POST['password'])) {
//                    checkLog($_POST['pseudo'], $_POST['password']);
                    getArticles();
                }
                break;
            case "sendArticle":
                if (isset($_POST['title']) && isset($_POST['contend'])) {
                    addArticles($_POST['title'], $_POST['contend']);
                }
                break;
            default:
                break;
        }
    }