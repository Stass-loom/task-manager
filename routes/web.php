<?php

use App\Http\Controllers\Api\TaskController;
use Illuminate\Support\Facades\Route;

// API маршруты (временно через web.php)
Route::get('/api/tasks', [TaskController::class, 'index']);
Route::get('/api/tasks/{id}', [TaskController::class, 'show']);
Route::post('/api/tasks', [TaskController::class, 'store']);
Route::put('/api/tasks/{id}', [TaskController::class, 'update']);
Route::delete('/api/tasks/{id}', [TaskController::class, 'destroy']);

// Стандартный маршрут для фронтенда (если нужен)
Route::get('/', function () {
    return view('welcome');
});