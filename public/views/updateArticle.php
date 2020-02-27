<?php
require "../../trait/Db.php";
require_once "../../trait/SearchArticle.php";
require "../../class/Users.php";
require "../../class/Articles.php";
require_once "header.php";
?>
    <h1>Article modifiable</h1>

<form action="../../controllers/backend.php" method="post">
    <?php
    if(isset($_POST['article_title']) && isset($_POST['article_contend'])):
        ?>
        <label for="title">Titre :</label>
        <input type="text" name="title" id="title" value="<?= $_POST['article_title']; ?>">

        <label for="contend">Contenu :</label>
        <textarea name="contend" id="contend" cols="30" rows="10"><?= $_POST['article_contend']; ?></textarea>
        <input type="hidden" name="id" value="<?= $_POST['article_id'];?>">
        <input type="hidden" name="page" value="updateArticle">
        <input type="submit" id="submit" class="button">
    <?php endif; ?>
</form>
    <a href="sendArticle.php"> Retourner à la liste des articles</a>
<?php
    $article = new Articles();
    $article->getArticle($_POST['article_id']);

require_once "footer.php";
