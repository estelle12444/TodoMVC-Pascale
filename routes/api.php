<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TodoCommandController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\TodoQueryController;
use App\Http\Controllers\UserController;

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


    Route::get('/user', [UserController::class, 'getCurrentUser']);


    //  lecture
    Route::get('todos', [TodoQueryController::class, 'index']);
    Route::get('todos/{id}', [TodoQueryController::class, 'show']);

    // Ecriture
    Route::post('todos', [TodoCommandController::class, 'store']);
    Route::put('todos/{todo}', [TodoCommandController::class, 'update']);
    Route::delete('todos/{todo}', [TodoCommandController::class, 'destroy']);





Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');


// Route::apiResource('todos', TodoController::class);


