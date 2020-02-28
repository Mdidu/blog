<?php
    require_once "../../trait/Db.php";
    require_once "../../trait/SearchArticle.php";
    require_once "../../class/Users.php";
    require_once "../../class/Commentary.php";
    require_once "header.php";
    $commentary = new Commentary();
?>
    <h1>Commentaires modifiable :</h1>

    <form action="../../controllers/backend.php" method="post">
        <?php
            if(isset($_POST['commentary_contend'])):
                ?>

                <label for="contend">Commentaire :</label>
                <textarea name="contend" id="contend" cols="30" rows="10"><?= $_POST['commentary_contend']; ?></textarea>
                <input type="hidden" name="id" value="<?= $_POST['commentary_id'];?>">
                <input type="hidden" name="article_id" value="<?= $_POST['article_id'];?>">
                <input type="hidden" name="page" value="updateCommentary">
                <input type="submit" id="submit" class="button">
            <?php endif; ?>
    </form>
    <?php

        $commentary->getCommentary($_POST['commentary_id']);
    ?>
    <a href="sendCommentary.php?article_commentary=<?= $_POST['article_id']; ?>">Retour à la liste des commentaire</a>
<?php
include_once "footer.php";