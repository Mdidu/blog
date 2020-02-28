<?php
    require_once "../trait/Db.php";
    require_once "../trait/SearchArticle.php";
    require_once "../class/Users.php";
    require_once "../class/Articles.php";
    require_once "../class/Commentary.php";


    if (isset($_POST['page'])) {
        switch ($_POST['page']) {
            case "register":
                if (isset($_POST['pseudo']) && !empty($_POST['pseudo']) && isset($_POST['password']) && !empty($_POST['password']) && isset($_POST['checkPassword']) && !empty($_POST['password'])
                    && ($_POST['password'] === $_POST['checkPassword'])) {

                    $user = new Users($_POST['pseudo']);
                    $user->addUser(password_hash($_POST['password'], PASSWORD_DEFAULT));
                }else {

                    header('refresh: 1;url=../public/views/register.php');
                }
                break;
            case "login":
                if (isset($_POST['pseudo']) && !empty($_POST['pseudo']) && isset($_POST['password']) && !empty($_POST['password']) ) {

                    $user = new Users($_POST['pseudo']);
                    $user->checkLog($_POST['pseudo'], $_POST['password']);
                }else {

                    header('refresh: 1;url=../public/views/login.php');
                }
                break;
            case "sendArticle":
                if (isset($_POST['title']) && isset($_POST['contend']) && !empty($_POST['title']) && !empty($_POST['contend'])) {

                    $article = new Articles();
                    $article->addArticles($_POST['title'], $_POST['contend']);
                }else {

                    header('refresh: 1;url=../public/views/sendArticle.php');
                }
                break;
            case "sendCommentary":
                if (isset($_POST['contend']) && isset($_POST['article_commentary']) && !empty($_POST['contend']) && !empty($_POST['article_commentary'])) {

                    $commentary = new Commentary();
                    $commentary->addCommentary($_POST['article_commentary'], $_POST['contend']);
                }else {

                    header('refresh: 1;url=../public/views/sendCommentary.php?article_commentary='.$_POST['article_commentary']);
                }
                break;
            case "updateArticle":
                if(!empty($_POST['title']) && !empty($_POST['contend'])){
                    $article = new Articles();
                    $article->updateArticle($_POST['title'], $_POST['contend']);
                }else {

                    header('refresh: 1;url=../public/views/sendArticle.php');
                }
                break;
            case "updateCommentary":
                if(!empty($_POST['contend']) && !empty($_POST['article_id'])){
                    $commentary = new Commentary();
                    $commentary->updateCommentary($_POST['contend'], $_POST['article_id']);
                }else {

                    header('refresh: 1;url=../public/views/sendCommentary.php?article_commentary='.$_POST['article_id']);
                }
                break;
            case "deleteArticle":

                $article = new Articles();
                $article->deleteArticle($_POST['article_id']);
                break;
            case "deleteCommentary":

                $commentary = new Commentary();
                $commentary->deleteCommentary($_POST['commentary_id'], $_POST['article_id']);
                break;
        }
    }