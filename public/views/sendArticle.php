<?php
    require_once "../../trait/Db.php";
    require_once "../../trait/SearchArticle.php";
    require_once "../../class/Users.php";
    require_once "../../class/Articles.php";

    include_once "header.php";
?>
    <h1>Liste des articles</h1>

    <form action="../../controllers/backend.php" method="post">
        <?php
            if (isset($_POST['article_title']) && isset($_POST['article_contend'])):
                ?>
                <label for="title">Titre :</label>
                <input type="text" name="title" id="title" value="<?= $_POST['article_title']; ?>">

                <label for="contend">Contenu :</label>
                <textarea name="contend" id="contend" cols="30" rows="10"><?= $_POST['article_contend']; ?></textarea>
                <input type="hidden" name="id" value="<?= $_POST['article_id']; ?>">
                <input type="hidden" name="page" value="updateArticle">
                <input type="submit" id="submit" class="button">
            <?php
            else:
                ?>
                <label for="title">Titre :</label>
                <input type="text" name="title" id="title">

                <label for="contend">Contenu :</label>
                <textarea name="contend" id="contend" cols="30" rows="10"></textarea>
                <input type="hidden" name="page" value="sendArticle">
                <input type="submit" id="submit" class="button">
            <?php
            endif;
        ?>
    </form>
<?php
    $article = new Articles();
    $article->getAllArticles();

    include_once "footer.php";