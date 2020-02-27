<?php

/**
 * Trait SearchArticle
 */
    trait SearchArticle
    {
        /**
         * @return array
         */
        public function search(){
            $id = $this->getId();
            $sql = $this->getDB()->prepare("
            SELECT articles.id AS article_id, title, articles.contend AS article_contend, articles.date AS article_date, pseudo, group_id 
            FROM articles 
            LEFT JOIN user ON articles.user_id = user.id 
            WHERE articles.id = :id");

            $sql->bindParam(':id', $id);

            $sql->execute();
            $row = $sql->fetchAll();
            $sql->closeCursor();
            return $row;
        }
    }