<?php
    require "../../trait/Db.php";
require_once "../../trait/SearchArticle.php";
    require "../../class/Users.php";
    require "../../class/Commentary.php";
require_once "header.php";
    ?>
    <h1>Commentaires :</h1>

    <form action="../../controllers/backend.php" method="post">

        <label for="contend">Votre commentaire :</label>
        <textarea name="contend" id="contend" cols="30" rows="10"></textarea>

        <input type="hidden" name="article_commentary" id="article_commentary" value="<?= $_GET['article_commentary'];?>">
        <input type="hidden" name="page" value="sendCommentary">
        <input type="submit" id="submit" class="button">
    </form>
    <a href="sendArticle.php">Liste articles</a>
    <?php
        $commentary = new Commentary();
        $commentary->getAllCommentary($_GET['article_commentary']);

require_once "footer.php";
