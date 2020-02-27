<?php
    foreach ($rows as $row){
        $this->setId($row['id']);
        $this->setPseudo($row['pseudo']);
        $this->setRank($row['group_id']);
        ?>
        <p><?= $this->getId();?></p>
        <p><?= $this->getPseudo();?></p>
        <p><?= $this->getRank();?></p>
        <form action="" method="post">
            <?php
        $i = 0;
        while($i < 3):
            ?>
            <input type="radio" name="rank" value="<?= $rows[$i]['group_id']?>"><label for="rank"><?= $rows[$i]['group_id']?></label>
        <?php
        $i++;
        endwhile;
        ?>
            <input type="hidden" id="rank" name="rank" value="<?= $this->getRank();?>">
            <input type="submit" value="Changer les droits">
        </form>
        <?php
    }