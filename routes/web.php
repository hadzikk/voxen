<?php

use App\Http\Controllers\FriendController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\GroupController;

Route::get('/signin', [AuthController::class, 'signin'])->name('signin');
Route::post('/signin', [AuthController::class, 'verifyCredentials'])->name('signin.submit');
Route::get('/signup', [AuthController::class, 'signup'])->name('signup');
Route::post('/signup', [AuthController::class, 'store'])->name('signup.submit');

Route::get('/chat', [ChatController::class, 'index'])->middleware('auth')->name('chat.index');

Route::get('/friends', [FriendController::class, 'friendsList'])->middleware('auth')->name('friends.list');

Route::get('/friends/search', [FriendController::class, 'searchFriend'])->middleware('auth')->name('friends.search');
Route::get('/friends/add', [FriendController::class, 'addFriend'])->middleware('auth')->name('friends.add');

Route::post('/friends/add', [FriendController::class, 'sendFriendRequest'])->middleware('auth')->name('friends.request.send');
Route::get('/friends/requests', [FriendController::class, 'friendsRequestsList'])->middleware('auth')->name('friends.requests.list');
Route::post('/friends/requests/{id}/accept', [FriendController::class, 'acceptFriendRequest'])->middleware('auth')->name('friends.requests.accept');
Route::post('/friends/requests/{id}/accept/search', [FriendController::class, 'acceptFromSearch'])->middleware('auth')->name('friends.requests.accept.search');
Route::post('/friends/requests/{id}/decline', [FriendController::class, 'declineFriendRequest'])->middleware('auth')->name('friends.requests.decline');

Route::get('/groups', [GroupController::class, 'index'])->middleware('auth')->name('groups.index');
Route::post('/groups', [GroupController::class, 'store'])->name('groups.store');
Route::get('/groups/{slug}', [GroupController::class, 'groupRoomChat'])->middleware('auth')->name('groups.chat');
