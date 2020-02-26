<?php
//    require "../models/backend.php";
    require "../class/Blog.php";
    require "../class/Users.php";
    require "../class/Commentary.php";
    require_once "header.php";
    ?>
<div id="main">
    <h1>Commentaires :</h1>
    <?php
    if(isset($_SESSION['pseudo'])):
        ?>
        <div><a href="../models/logout.php">Déconnexion</a></div>
        <div><?= "Bienvenue, ".$_SESSION['pseudo'];?></div>
    <?php
    endif;
    ?>
    <div id="contend">

    </div>
    <form action="../controllers/backend.php" method="post">

        <label for="contend"></label>
        <textarea name="contend" id="contend" placeholder="Entrez le contenu de votre commentaire !" cols="30" rows="10"></textarea>

        <!--        <input type="text" name="contend" id="contend" placeholder="Entrez le contenu de votre commentaire !">-->

        <input type="hidden" name="article_commentary" id="article_commentary" value="<?= $_GET['article_commentary'];?>">
        <input type="hidden" name="page" value="sendCommentary">
        <input type="submit" id="submit">
    </form>
    <?php
        $commentary = new Commentary();
        $commentary->getAllCommentary($_GET['article_commentary']);
    ?>
    <a href="sendArticle.php">Liste articles</a>
</div>
<?php
require_once "footer.php";
