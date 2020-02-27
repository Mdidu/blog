<?php
    foreach ($rows as $row){

        //si l'article n'est pas sur la page, on affiche l'article
        if($i === 0):
        //TODO: ADD propriété + setter/getter pour les 3?
        $contend = $row_article[$i]['article_contend'];
        $title = $row_article[$i]['title'];
        $date = date('d/m/Y à H:i:s', $row_article[$i]['article_date']);
        $pseudo = $row_article[$i]['pseudo'];
        ?>
        <div class='articles'>
            <div><?= $title ?></div>
            <div><?= $contend ?></div>
            <div>De <?= $pseudo ?> , Le <?= $date?></div>
        </div>
        <?php
        $i++;
    endif;
        if($this->getComment() === true):

            $this->setCommentaryId($row['commentary_id']);
            $this->setContendCommentary($row['commentary_contend']);
            $this->setDateCommentary($row['commentary_date']);
            $this->setAuthorCommentary($row['pseudo']);
            ?>
            <div class="commentary">
                <div><?= $this->getAuthor() ?>: <?= $this->getContend(); ?></div>
                <div>Le <?= $this->getDate()?></div>
            </div>

            <?php if($i === 1 && ($_SESSION['group_id'] == 2 || $_SESSION['group_id'] == 3)):?>
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
    }
