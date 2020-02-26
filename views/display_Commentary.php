<?php
    foreach ($row as $test){

        //si l'article n'est pas sur la page, on affiche l'article
        if($j === 0):
        //TODO: ADD propriété + setter/getter pour les 3?
        $contend = $row_article[$j]['article_contend'];
        $title = $row_article[$j]['title'];
        $pseudo = $row_article[$j]['pseudo'];
        ?>
        <div class='articles'>
            <div><?= $title ?></div>
            <div><?= $contend ?></div>
            <div>Ecrit par : <?= $pseudo ?></div>
        </div>
        <?php
        $j++;
    endif;
        if($this->getComment() === true):

            $this->setCommentaryId($test['commentary_id']);
            $this->setContendCommentary($test['commentary_contend']);
            $this->setAuthorCommentary($test['pseudo']);
            ?>
            <div class="commentary">
                <div><?= $this->getContend(); ?></div>
                <div>Ecrit par : <?= $this->getAuthor() ?></div>
            </div>

            <?php if($j === 1):?>
            <form action="updateCommentary.php" method="post">
                <input type="hidden" name="commentary_contend" class="commentaryUpdate" value="<?= $this->getContend()?>">
                <input type="hidden" name="commentary_id" class="commentaryUpdate" value="<?= $this->getCommentaryId()?>">
                <input type="hidden" name="article_id" class="commentaryUpdate" value="<?= $this->getId()?>">
                <input type="submit" value="Modifier le commentaire">
            </form>

            <form action="../controllers/backend.php" method="post">
                <input type="hidden" name="commentary_id" class="commentaryDelete" value="<?= $this->getCommentaryId()?>">
                <input type="hidden" name="article_id" class="commentaryDelete" value="<?= $this->getId()?>">
                <input type="hidden" name="page" value="deleteCommentary">
                <input type="submit" value="Supprimer commentaire">
            </form>
        <?php
            endif;
        endif;
        $i++;
    }