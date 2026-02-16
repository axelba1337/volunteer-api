<?php

use Illuminate\Support\Facades\Route; // tambahkan ini
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EventController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    
    Route::get('/events', [EventController::class, 'index']);
    Route::post('/events', [EventController::class, 'store']); 
    Route::get('/events/{id}', [EventController::class, 'show']);
    Route::post('/events/{id}/join', [EventController::class, 'join']);
});