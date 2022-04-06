<?php

    namespace App\Config;

    class Database{
        public String $driver = "sqlite";
        public String $dbLoc = "./storage/db.sqlite";

        public $conn;

        public function connect()
        {
            $this->conn = null;
            $dsn = "{$this->driver}:{$this->dbLoc}";
            $pdoOpts = [
                \PDO::ATTR_DEFAULT_FETCH_MODE=>\PDO::FETCH_ASSOC,
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
            ];

            try{
                $this->conn = new \PDO($dsn,null,null,$pdoOpts);
                return $this->conn;
            }
            catch(\PDOException $e)
            {
                print_r(json_encode([
                    "message"=>$e->getMessage()
                ]));
            }
        }
    }