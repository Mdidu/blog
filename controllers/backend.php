<?php
//    session_start();
    require "../class/Blog.php";
    require "../class/Users.php";
    require "../class/Articles.php";
//    require "../models/backend.php";

    /*TODO= Création utilisateur OK
     * Connexion OK
     * Ajout article OK
     * Affichage article OK
     * Ajout commentaire A FAIRE
     * affichage commentaire A FAIRE
    */
    $blog = new Blog();

//    echo $_POST['page'];
    if (isset($_POST['page'])) {
        switch ($_POST['page']) {
            case "inscription":
                if (isset($_POST['pseudo']) && isset($_POST['password']) && isset($_POST['checkPassword']) && ($_POST['password'] === $_POST['checkPassword'])) {
//                    addUsers($_POST['pseudo'], password_hash($_POST['password'], PASSWORD_DEFAULT));
                    $user = new Users($_POST['pseudo'], password_hash($_POST['password'], PASSWORD_DEFAULT));
                    $user->addUser();
                }
                break;
            case "login":
                if (isset($_POST['pseudo']) && isset($_POST['password'])) {
                    //checkLog($_POST['pseudo'], $_POST['password']);
                    $user = new Users($_POST['pseudo'], password_hash($_POST['password'], PASSWORD_DEFAULT));
                    $user->checkLog($_POST['pseudo'], $_POST['password']);

                }
                break;
            case "sendArticle":
                if (isset($_POST['title']) && isset($_POST['contend'])) {
//                    addArticles($_POST['title'], $_POST['contend']);
//                    $article = new Articles($_POST['title'], $_POST['contend'], time(), $_SESSION['id']);
                    $article = new Articles();

                    $article->addArticles($_POST['title'], $_POST['contend']);
                }
                break;
            case "sendCommentary":
                if (isset($_POST['contend']) && isset($_POST['article_commentary'])) {
                    addCommentary($_POST['contend'], $_POST['article_commentary']);
                }
                break;
            default:
                break;
        }
    }






////    session_start();
//    require "../models/backend.php";
//
////    echo $_POST['page'];
//    if(isset($_POST['page'])) {
//        switch ($_POST['page']) {
//            case "inscription":
//                if (isset($_POST['pseudo']) && isset($_POST['password']) && isset($_POST['checkPassword']) && ($_POST['password'] === $_POST['checkPassword'])) {
//                    addUsers($_POST['pseudo'], password_hash($_POST['password'], PASSWORD_DEFAULT));
//                }
//                break;
//            case "login":
//                if (isset($_POST['pseudo']) && isset($_POST['password'])) {
//                    checkLog($_POST['pseudo'], $_POST['password']);
//                }
//                break;
//            case "sendArticle":
//                if (isset($_POST['title']) && isset($_POST['contend'])) {
//                    addArticles($_POST['title'], $_POST['contend']);
//                }
//                break;
//            case "sendCommentary":
//                if (isset($_POST['contend']) && isset($_POST['article_commentary'])) {
//                    addCommentary($_POST['contend'], $_POST['article_commentary']);
//                }
//                break;
//            default:
//                break;
//        }
//    }