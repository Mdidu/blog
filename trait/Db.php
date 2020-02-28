<?php
    if (!isset($_SESSION)) {
        session_start();
    }

    trait Db
    {

        private $db; //instance de pdo

        /**
         * @var string
         */
        private $servername = "localhost";
        /**
         * @var string
         */
        private $username = "root";
        /**
         * @var string
         */
        private $passwordDB = "";
        /**
         * @var string
         */
        private $dbname = "blog";


        /**
         * @return PDO
         */
        public function getDB()
        {
            $db = new PDO('mysql:host=' . $this->servername . ';dbname=' . $this->dbname . ';charset=utf8', $this->username, $this->passwordDB);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            $this->db = $db;
            return $db;
        }
    }