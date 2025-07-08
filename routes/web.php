<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;

Route::get('/auth/signin', [AuthController::class, 'signin'])->name('signin');
Route::post('/auth/verify', [AuthController::class, 'verify']);
Route::get('/auth/signup', [AuthController::class, 'signup']);
Route::post('/auth/signup',  [AuthController::class, 'store']);

Route::get('/chat', [ChatController::class, 'index'])->middleware('auth');
Route::get('/chat/p/{username}', [ChatController::class, 'group'])->middleware('auth');
Route::get('/chat/addfriend', [ChatController::class, 'addFriend'])->middleware('auth');
Route::post('/chat/addfriend', [ChatController::class, 'sendFriendRequest'])->middleware('auth');
Route::get('/chat/friends', [ChatController::class, 'friends'])->middleware('auth');
Route::get('/chat/friends/s', [ChatController::class, 'searchFriend'])->middleware('auth');
Route::get('/chat/conversations', [ChatController::class, 'conversations'])->middleware('auth');
Route::get('/chat/friendrequest', [ChatController::class, 'friendrequest'])->middleware('auth');
Route::post('/chat/friendrequest/{id}/accept', [ChatController::class, 'accept'])->middleware('auth');
Route::post('/chat/friendrequest/{id}/accept/onsearch', [ChatController::class, 'acceptFromSearch'])->middleware('auth');
Route::post('/chat/friendrequest/{id}/decline', [ChatController::class, 'decline'])->middleware('auth');


