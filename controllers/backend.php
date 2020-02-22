<?php
//    session_start();
    require "../class/Blog.php";
    require "../class/Users.php";
    require "../class/Articles.php";
    require "../class/Commentary.php";
//    require "../models/backend.php";

    /*TODO= Création utilisateur OK
     * Connexion OK
     * Ajout article OK
     * Affichage article OK
     * Ajout commentaire OK
     * affichage commentaire OK
     * Retourner à la liste des articles depuis les commentaires OK
     * Afficher bouton logOUT sur toutes les pages OK
     * MODIFIER REQUETE AFFICHAGE FILTRER PAR DATE OK
     * UTILISER LA METHODE SEARCHCOMMENTARY OK
     * AFFICHER PSEUDO QUI A POSTE LE COMMENTAIRE OK
     * REVOIR LES REQUETES POUR AVOIR DES APPELS EXPLICITE OK
     * FAIRE LES UPDATE / DELETE
     * AFFICHER DATE DU POST/MODIFICATION?
     * DONNER DES DROITS ADMIN/MODO A UN USER, VIA UNE PAGE AVEC TOUS LES USERS?
     * DESIGN DU SITE
     * AMELIORER LE CONTROLLER
     * MIEUX DECOUPTER LES METHODES 1 METHODE = 1 ACTION !
     * RENDRE SINGLE PAGE SI TEMPS SUFFISANT
    */
    $blog = new Blog();

    /*if(isset($_POST['pseudo']) && isset($_POST['password']) && isset($_POST['page'])){
        $user = new Users($_POST['pseudo'], password_hash($_POST['password'], PASSWORD_DEFAULT));
        switch ($_POST['page']) {
            case "inscription":
                if(isset($_POST['checkPassword']) && ($_POST['password'] === $_POST['checkPassword'])){
                    $user->addUser();
                }
                break;
            case "login":
                    $user->checkLog($_POST['pseudo'], $_POST['password']);
                break;
        }
    }elseif(isset($_POST['contend']) && isset($_POST['page'])){
        switch ($_POST['page']){
            case "sendArticle":
                if (isset($_POST['title'])) {
                    $article = new Articles();

                    $article->addArticles($_POST['title'], $_POST['contend']);
                }
                break;
            case "sendCommentary":
                if (isset($_POST['article_commentary'])) {
                    $commentary = new Commentary();

                    $commentary->addCommentary($_POST['article_commentary'],$_POST['contend']);
                }
                break;
        }
    }*/

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
                    //addCommentary($_POST['contend'], $_POST['article_commentary']);
                    $commentary = new Commentary();

                    $commentary->addCommentary($_POST['article_commentary'],$_POST['contend']);
                }
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