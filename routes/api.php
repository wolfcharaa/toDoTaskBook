<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskListController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('task_list',                 [TaskListController::class, 'create']);
Route::get( 'task_list/{id}/delete',     [TaskListController::class, 'delete']);
Route::post('task',                      [TaskController::class, 'create']);
Route::get( 'task',                      [TaskController::class, 'index']);
Route::get( 'task/{id}/delete',          [TaskController::class, 'delete']);
Route::get( 'task/delete_completed',     [TaskController::class, 'deleteCompleted']);
Route::put( 'task/{id}',                 [TaskController::class, 'update']);
Route::get( 'task/{id}/change_status',   [TaskController::class, 'changeStatus']);
