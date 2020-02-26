<?php
    require "../class/Blog.php";
    require "../class/Users.php";
    require "../class/Articles.php";
    require "../class/Commentary.php";
    require_once "header.php";
    $commentary = new Commentary();
?>
<div id="main">
    <h1>Commentaires modifiable :</h1>
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
        <?php
            if(isset($_POST['commentary_contend'])):
                ?>

                <label for="contend"></label>
                <textarea name="contend" id="contend" placeholder="Entrez le contenu de votre commentaire !" cols="30" rows="10"><?= $_POST['commentary_contend']; ?></textarea>
                <input type="hidden" name="id" value="<?= $_POST['commentary_id'];?>">
                <input type="hidden" name="article_id" value="<?= $_POST['article_id'];?>">
                <input type="hidden" name="page" value="updateCommentary">
                <input type="submit" id="submit">
            <?php endif; ?>
    </form>
    <?php

        //modifier la normal en allcommentary
        $commentary->getCommentary($_POST['commentary_id']);
    ?>
</div>
<?php
require_once "footer.php";
