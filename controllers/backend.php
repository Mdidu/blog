<?php
    require "../class/Blog.php";
    require "../class/Users.php";
    require "../class/Articles.php";
    require "../class/Commentary.php";

    /*TODO=
     * MIEUX DECOUPTER LES METHODES 1 METHODE = 1 ACTION ! OK
     * faire de search article un trait OK
     * AFFICHER DATE DU POST/MODIFICATION? OK
     * DONNER DES DROITS ADMIN/MODO A UN USER, VIA UNE PAGE AVEC TOUS LES USERS?
     * une fois les droits fait faire en sorte que les update/delete apparaissent que si un admin/modo ou l'auteur visionne l'élément
     * DESIGN DU SITE
     * AFFICHER UN MESSAGE SELON CE QU'Il SAIT PASSE ET SI CA A FONCTIONNE
     * AMELIORER LE CONTROLLER
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