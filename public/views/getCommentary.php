<?php
    foreach ($rows as $row) {

        //if the article is not on the page, we display the article
        if ($i === 0):

            $contend = $row_article[$i]['article_contend'];
            $title = $row_article[$i]['title'];
            $date = date('d/m/Y à H:i:s', $row_article[$i]['article_date']);
            $pseudo = $row_article[$i]['pseudo'];
            ?>
            <div class='articles'>
                <div class="title"><?= $title ?></div>
                <div class="authorArticle">Publié par <span class="user"><?= $pseudo ?></span></div>
                <div class="date">Le <?= $date ?></div>
                <div class="contend"><?= $contend ?></div>
            </div>
            <?php
            $i++;
        endif;
        //If there is at least one comment
        if ($this->getComment() === true):

            $this->setCommentaryId($row['commentary_id']);
            $this->setContendCommentary($row['commentary_contend']);
            $this->setDateCommentary($row['commentary_date']);
            $this->setAuthorCommentary($row['pseudo']);
            ?>
            <div class="commentary">
                <div>
                    <span class="user"><?= $this->getAuthor() ?></span> :
                    <span class="contend"><?= $this->getContend(); ?></span>
                </div>
                <div class="date">Le <?= $this->getDate() ?></div>
            </div>

            <?php if ($i === 1 && ($_SESSION['group_id'] == 2 || $_SESSION['group_id'] == 3 || $_SESSION['pseudo'] == $this->getAuthor())): ?>
            <div id="buttons">
                <form action="updateCommentary.php" method="post">
                    <input type="hidden" name="commentary_contend" class="commentaryUpdate"
                           value="<?= $this->getContend() ?>">
                    <input type="hidden" name="commentary_id" class="commentaryUpdate"
                           value="<?= $this->getCommentaryId() ?>">
                    <input type="hidden" name="article_id" class="commentaryUpdate" value="<?= $this->getId() ?>">
                    <input type="submit" value="Modifier le commentaire" class="button">
                </form>

                <form action="../../controllers/backend.php" method="post">
                    <input type="hidden" name="commentary_id" class="commentaryDelete"
                           value="<?= $this->getCommentaryId() ?>">
                    <input type="hidden" name="article_id" class="commentaryDelete" value="<?= $this->getId() ?>">
                    <input type="hidden" name="page" value="deleteCommentary">
                    <input type="submit" value="Supprimer commentaire" class="button">
                </form>
            </div>
        <?php
        endif;
        endif;
    }