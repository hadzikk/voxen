<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\PusherController;

Route::get('/app/product', [ProductController::class, 'index']);
Route::get('/app/product/create', [ProductController::class, 'create']);
Route::post('/app/product', [ProductController::class, 'store']);

Route::get('/auth/signin', [AuthController::class, 'signin']);
Route::get('/auth/signup', [AuthController::class, 'signup']);
Route::post('/auth/signup', [AuthController::class, 'store']);

Route::get('/chat', [ChatController::class, 'index']);
Route::get('/chat/p/{username}', [ChatController::class, 'personalChat']);

Route::get('/pusher', [PusherController::class, 'index']);
Route::post('/pusher', [PusherController::class, 'index']);
