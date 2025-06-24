<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;

Route::get('/auth/signin', [AuthController::class, 'signin']);
Route::post('/auth/verify', [AuthController::class, 'verify']);
Route::get('/auth/signup', [AuthController::class, 'signup']);
Route::post('/auth/signup',  [AuthController::class, 'store']);

Route::get('/chat', [ChatController::class, 'index']);
Route::get('/chat/p/{username}', [ChatController::class, 'group']);
