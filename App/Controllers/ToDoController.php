<?php

namespace App\Controllers;
use App\Config\Database as DB;
use App\Models\Todo;

class ToDoController{
    static public function index(){
        setHeader([
            "Content-Type"=>"application/json"
        ]);
        $db = new DB();
        $todoModel = new Todo($db);

        json($todoModel->read_all());
    }
    static public function create(){
        setHeader([
            "Content-Type"=>"application/json"
        ]);

        $db = new DB();
        $todoModel = new Todo($db);

        $todoModel->create([
            "task"=>request()->task,
            "day_n_time"=>request()->day_n_time,
            "reminder"=>request()->reminder
        ]);
    }
    static public function show($id){
        setHeader([
            "Content-Type"=>"application/json"
        ]);

        $db = new DB();
        $todoModel = new Todo($db);
        json($todoModel->read($id));
    }
    static public function delete($id){
        
        $db = new DB();
        $todoModel = new Todo($db);
        if($todoModel->delete($id))
        {
            json(["message"=>"record deleted"]);
        }
    }
    static public function edit($id){
        
        $db = new DB();
        $todoModel = new Todo($db);
        $todoModel->task = request()->task;      
        $todoModel->day_n_time =request()->day_n_time;
        $todoModel->reminder = request()->reminder;
        if($todoModel->update($id))
        {
            json(["message"=>"record edited"]);
        }
    }

    static public function truncate(){
        setHeader([
            "Content-Type"=>"application/json"
        ]);

        $db = new DB();
        $todoModel = new Todo($db);
        $todoModel->truncate();

    }
}