<?php
    require_once "../../trait/Db.php";
    require_once "../../trait/SearchArticle.php";
    require_once "../../class/Users.php";
    require_once "../../class/Commentary.php";
    include_once "header.php";
?>
    <h1>Commentaires :</h1>

    <form action="../../controllers/backend.php" method="post">

        <label for="contend">Votre commentaire :</label>
        <textarea name="contend" id="contend" cols="30" rows="10"></textarea>

        <input type="hidden" name="article_commentary" id="article_commentary"
               value="<?= $_GET['article_commentary']; ?>">
        <input type="hidden" name="page" value="sendCommentary">
        <input type="submit" id="submit" class="button">
    </form>
    <a href="sendArticle.php">Liste articles</a>
<?php
    $commentary = new Commentary();
    $commentary->getAllCommentary($_GET['article_commentary']);

    include_once "footer.php";
