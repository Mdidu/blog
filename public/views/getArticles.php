<?php
    foreach ($rows as $row):

        $this->setId($row['article_id']);
        $this->setTitle($row["title"]);
        $this->setContend($row["article_contend"]);
        $this->setDate($row["article_date"]);
        $this->setAuthor($row['pseudo']);
        ?>
        <div class='articles'>
            <div class="title"><?= $this->getTitle() ?></div>
            <div class="authorArticle">Publié par <span class="user"><?= $this->getAuthor() ?></span></div>
            <div class="date">Le <?= $this->getDate(); ?></div>
            <div class="contend"><?= $this->getContend() ?></div>
        </div>
        <?php
        //If the number of article stored in the variable rows is different from 1
        if (intval(count($rows)) != 1):
            ?>
            <div id="buttons">
            <?php 
                if(isset($_SESSION['pseudo'])):
            ?>
                <form action="sendCommentary.php" method="get">
            <?php else:?>
                <form action="public/views/sendCommentary.php" method="get">
            <?php endif;?>
                    <input type="hidden" name="article_commentary" id="article_commentary"
                           value="<?= $this->getId() ?>">
                    <input type="submit" value="Ajouter/Voir un commentaire" class="button">
                </form>
                <?php if ($_SESSION['group_id'] == 2 || $_SESSION['group_id'] == 3  || $_SESSION['pseudo'] == $this->getAuthor()): ?>
                    <form action="updateArticle.php" method="post">
                        <input type="hidden" name="article_title" class="articleUpdate"
                               value="<?= $this->getTitle() ?>">
                        <input type="hidden" name="article_contend" class="articleUpdate"
                               value="<?= $this->getContend() ?>">
                        <input type="hidden" name="article_id" class="articleUpdate" value="<?= $this->getId() ?>">
                        <input type="submit" value="Modifier article" class="button">
                    </form>

                    <form action="../../controllers/backend.php" method="post">
                        <input type="hidden" name="article_id" class="articleDelete" value="<?= $this->getId() ?>">
                        <input type="hidden" name="page" value="deleteArticle">
                        <input type="submit" value="Supprimer article" class="button">
                    </form>

                <?php
                endif;
                ?>
            </div>
        <?php
        endif;
    endforeach;