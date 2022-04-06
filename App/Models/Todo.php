<?php

namespace App\Models;
use \App\Schema\Todo as TodoSchema;

class Todo{
    public Int $id;
    public String $task;
    public String $day_n_time;
    public Bool $reminder;
    public \PDO $conn;
    public function __construct($db)
    {
        $parts = explode("\\",__CLASS__);
        $this->table_name = strtolower(end($parts))."s";
        $this->conn = $db->connect();
        $this->todoSchema = new TodoSchema($db);
    }
    public function truncate()
    {
        $sql = "DELETE FROM {$this->table_name}";

        try{
            $stmt = $this->conn->prepare($sql);

            $stmt->execute();

            return true;
        }
        catch(\PDOException $e){
            print_r(json_encode([
                "error_message"=>$e->getMessage()
            ]));
        }
    }
    public function create($args)
    {
        $sql = "INSERT INTO {$this->table_name}(task, day_n_time,reminder) VALUES(:task,:day_n_time,:reminder)";

        try{
            $stmt = $this->conn->prepare($sql);

            $stmt->execute($args);

            return true;
            
        }
        catch(\PDOException $e){
            print_r(json_encode([
                "error_message"=>$e->getMessage()
            ]));
        }
    }

    public function read_all()
    {
        $sql = "SELECT * FROM {$this->table_name}";

        try{
            $res = $this->conn->query($sql);
            return $res->fetchAll();
            
        }
        catch(\PDOException $e){
            print_r(json_encode([
                "error_message"=>$e->getMessage()
            ]));
        }
    }
    public function read($id)
    {
        $sql = "SELECT * FROM {$this->table_name} WHERE id = {$id}";

        try{
            $res = $this->conn->query($sql);
            return $res->fetch();            
        }
        catch(\PDOException $e){
            print_r(json_encode([
                "error_message"=>$e->getMessage()
            ]));
        }
    }
    public function update($id)
    {
        $sql = "UPDATE {$this->table_name} SET task = '{$this->task}', day_n_time = '{$this->day_n_time}', reminder = '{$this->reminder}' WHERE id = {$id}";

        try{
            $this->conn->query($sql);

            return true;
            
        }
        catch(\PDOException $e){
            print_r(json_encode([
                "error_message"=>$e->getMessage()
            ]));
        }
    }
    public function delete($id)
    {
        $sql = "DELETE FROM {$this->table_name} WHERE id = {$id}";

        try{
            $this->conn->query($sql);

            print_r(json_encode([
                "success_message"=>"record deleted"
            ]));
            
        }
        catch(\PDOException $e){
            print_r(json_encode([
                "error_message"=>$e->getMessage()
            ]));
        }
    }



}