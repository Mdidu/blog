<?php
    require_once "../trait/Db.php";
    require_once "../trait/SearchArticle.php";
    require_once "../class/Users.php";
    require_once "../class/Articles.php";
    require_once "../class/Commentary.php";

    if (isset($_POST['page'])) {
        switch ($_POST['page']) {
            case "register":
                if (isset($_POST['pseudo']) && isset($_POST['password']) && isset($_POST['checkPassword']) && ($_POST['password'] === $_POST['checkPassword'])) {

                    $user = new Users($_POST['pseudo']);
                    $user->addUser(password_hash($_POST['password'], PASSWORD_DEFAULT));
                }
                break;
            case "login":
                if (isset($_POST['pseudo']) && isset($_POST['password'])) {

                    $user = new Users($_POST['pseudo']);
                    $user->checkLog($_POST['pseudo'], $_POST['password']);
                }
                break;
            case "sendArticle":
                if (isset($_POST['title']) && isset($_POST['contend'])) {

                    $article = new Articles();
                    $article->addArticles($_POST['title'], $_POST['contend']);
                }
                break;
            case "sendCommentary":
                if (isset($_POST['contend']) && isset($_POST['article_commentary'])) {

                    $commentary = new Commentary();
                    $commentary->addCommentary($_POST['article_commentary'], $_POST['contend']);
                }
                break;
            case "updateArticle":

                $article = new Articles();
                $article->updateArticle($_POST['title'], $_POST['contend']);
                break;
            case "updateCommentary":

                $commentary = new Commentary();
                $commentary->updateCommentary($_POST['contend'], $_POST['article_id']);
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