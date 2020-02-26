<?php //var_dump($row);
    foreach ($row as $test){
//        var_dump($row);
//        echo $test['article_id'];
//        var_dump($test);
        $this->setId($row[$i]['article_id']);
        $this->setTitle($row[$i]["title"]);
        $this->setContend($row[$i]["article_contend"]);
        $this->setAuthor($row[$i]['pseudo']);

?>
<div class='articles'>
    <div>
        <div><?= $this->getTitle() ?></div>
    </div>
    <div><?= $this->getContend()?></div>
    <div>Ecrit par : <?= $this->getAuthor() ?></div>
</div>

<form action="sendCommentary.php" method="get">
    <input type="hidden" name="article_commentary" id="article_commentary" value="<?= $this->getId()?>">
    <input type="submit" value="Ajouter/Voir un commentaire">
</form>

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
        $i++;
    }