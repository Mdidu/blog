<?php

    session_start();
    $_SESSION['page'] = "index";
    $_SESSION['group_id'] = NULL;
    $_SESSION['pseudo'] = NULL;
    require_once "trait/Db.php";
    require_once "trait/SearchArticle.php";
    require_once "class/Articles.php";

    include_once "public/views/header.php";

?>
    <h1>Blog</h1>

<?php
    $article = new Articles();
    $article->getAllArticles();

    include_once "public/views/footer.php";