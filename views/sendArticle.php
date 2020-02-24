<?php
//    require "../models/backend.php";
//    require "../controllers/backend.php";
    require "../class/Blog.php";
    require "../class/Users.php";
    require "../class/Articles.php";
//    $blog = new Blog();
    ?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Articles</title>
</head>
<body>
    <div id="main">
        <h1>Liste des articles</h1>
        <?php
            if(isset($_SESSION['pseudo'])):
                ?>
                <div><a href="../models/logout.php">Déconnexion</a></div>
                <div><?= "Bienvenue, ".$_SESSION['pseudo'];?></div>
            <?php
            endif;
        ?>
        <div id="contend">
<!-- utilité???-->
        </div>
        <form action="../controllers/backend.php" method="post">
            <?php
            if(isset($_POST['article_title']) && isset($_POST['article_contend'])):
            ?>
            <label for="title"></label>
            <input type="text" name="title" id="title" placeholder="Entrez le titre de votre article !" value="<?= $_POST['article_title']; ?>">

            <label for="contend"></label>
            <textarea name="contend" id="contend" placeholder="Entrez le contenu de votre article !" cols="30" rows="10"><?= $_POST['article_contend']; ?></textarea>
            <input type="hidden" name="id" value="<?= $_POST['article_id'];?>">
            <input type="hidden" name="page" value="updateArticle">
            <input type="submit" id="submit">
        <?php
        else:
            ?>
            <label for="title"></label>
            <input type="text" name="title" id="title" placeholder="Entrez le titre de votre article !">

            <label for="contend"></label>
            <textarea name="contend" id="contend" placeholder="Entrez le contenu de votre article !" cols="30" rows="10"></textarea>
            <input type="hidden" name="page" value="sendArticle">
            <?php endif; ?>
        </form>
        <?php
            $article = new Articles();
            $article->getAllArticles();
        ?>
    </div>
</body>
</html>