<?php

namespace App\Schema;

class Task{
    public \PDO $conn;
    public function __construct($db)
    {
        $parts = explode("\\",__CLASS__);
        $this->table_name = strtolower(end($parts))."s";
        $this->conn = $db->connect();
    }
    public function create_table()
    {
        $sql = "CREATE TABLE {$this->table_name}(
            id INTEGER PRIMARY KEY,
            task VARCHAR(50) NOT NULL,
            day_n_time VARCHAR(50) NOT NULL,
            reminder INTEGER DEFAULT 0 NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";

        try{
            $this->conn->query($sql);
            
            json([
                "success_message"=>$this->table_name." created"
            ]);
            
        }
        catch(\PDOException $e){
            json([
                "error_message"=>$e->getMessage()
            ]);
        }
    }

    public function drop_table()
    {
        $sql = "DROP TABLE IF EXISTS {$this->table_name}";

        try{
            $this->conn->query($sql);
            json([
                "success_message"=>$this->table_name." dropped"
            ]);
            
        }
        catch(\PDOException $e){
            json([
                "error_message"=>$e->getMessage()
            ]);
        }
    }

    public function rollback(){
        $this->drop_table();
        $this->create_table();
    }
}