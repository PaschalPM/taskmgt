<?php
    
    use App\Route;
    use App\Controllers\TaskController;
    use App\Config\Database;
    use App\Schema\Task as TaskSchema;
    $taskSchema = new TaskSchema(new Database());
   
    Route::get("/api",[TaskController::class,"index"]);
    Route::get("/api/:id",[TaskController::class,"show"]);
    Route::post("/api",[TaskController::class,"create"]);
    Route::destroy("/api/:id",[TaskController::class,"delete"]);
    Route::update("/api/:id",[TaskController::class,"edit"]);
    Route::post("/api_truncate",[TaskController::class,"truncate"]);
    Route::post("/api_rollback",function() use ($taskSchema){
        $taskSchema->rollback();
    });
