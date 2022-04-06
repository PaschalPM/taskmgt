<?php

namespace App\Controllers;
use App\Config\Database as DB;
use App\Models\Task;

class TaskController{
    static public function index(){
        $db = new DB();
        $taskModel = new Task($db);

        json($taskModel->read_all());
    }
    static public function create(){
        $db = new DB();
        $taskModel = new Task($db);

        if($taskModel->create([
            "task"=>request()->task,
            "day_n_time"=>request()->day_n_time,
            "reminder"=>request()->reminder
        ]))
        {
            json(["success message"=>"record created"]);
        };
    }
    static public function show($id){
        
        $db = new DB();
        $taskModel = new Task($db);
        json($taskModel->read($id));
    }
    static public function delete($id){

        $db = new DB();
        $taskModel = new Task($db);
        if($taskModel->delete($id))
        {
            json(["message"=>"record deleted"]);
        }
    }
    static public function edit($id){

        $db = new DB();
        $taskModel = new Task($db);
        $taskModel->task = request()->task;      
        $taskModel->day_n_time =request()->day_n_time;
        $taskModel->reminder = request()->reminder;
        if($taskModel->update($id))
        {
            json(["success message"=>"record edited"]);
        }
    }

    static public function truncate(){
    
        $db = new DB();
        $taskModel = new Task($db);
        if($taskModel->truncate())
        {
            json(["success message"=>"tasks table truncated"]);
        }
    }
}