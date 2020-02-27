<?php //var_dump($row);
    foreach ($rows as $row){

        $this->setId($row['article_id']);
        $this->setTitle($row["title"]);
        $this->setContend($row["article_contend"]);
        $this->setDate($row["article_date"]);
        $this->setAuthor($row['pseudo']);

?>
<div class='articles'>
    <div>
        <div><?= $this->getTitle() ?></div>
    </div>
    <div><?= $this->getContend()?></div>
    <div>De <?= $this->getAuthor() ?> , Le <?= $this->getDate();?></div>
</div>

<form action="sendCommentary.php" method="get">
    <input type="hidden" name="article_commentary" id="article_commentary" value="<?= $this->getId()?>">
    <input type="submit" value="Ajouter/Voir un commentaire">
</form>
<?php if($_SESSION['group_id'] == 2 || $_SESSION['group_id'] == 3):?>
<form action="updateArticle.php" method="post">
    <input type="hidden" name="article_title" class="articleUpdate" value="<?= $this->getTitle()?>">
    <input type="hidden" name="article_contend" class="articleUpdate" value="<?= $this->getContend()?>">
    <input type="hidden" name="article_id" class="articleUpdate" value="<?= $this->getId()?>">
    <input type="submit" value="Modifier article">
</form>

<form action="../controllers/backend.php" method="post">
    <input type="hidden" name="article_id" class="articleDelete" value="<?= $this->getId()?>">
    <input type="hidden" name="page" value="deleteArticle">
    <input type="submit" value="Supprimer article">
</form>
<?php
    endif;
?>
    <?php
    }
    ?>

<a href="updateDroit.php">user</a>
