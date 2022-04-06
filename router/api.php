<?php
    
    use App\Route;
    use App\Controllers\ToDoController;

   
   
    Route::get("/api",[ToDoController::class,"index"]);
    Route::get("/api/:id",[ToDoController::class,"show"]);
    Route::post("/api",[ToDoController::class,"create"]);
    Route::destroy("/api/:id",[ToDoController::class,"delete"]);
    Route::update("/api/:id",[ToDoController::class,"edit"]);
    Route::post("/api_truncate",[ToDoController::class,"truncate"]);
