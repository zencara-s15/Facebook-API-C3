<?php

use App\Http\Controllers\accept\AcceptFriendController;
use App\Http\Controllers\friend\FriendController;
use App\Models\Friend;
// use App\Http\Controllers\Auth\AuthController;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\reject\RejectFriendController;
use App\Http\Resources\accept\AcceptFriendResource;
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
Route::get('/me', [AuthController::class, 'index'])->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/friend/{userId}', 'FriendController@showByUserId');

//request
Route::get('/friend', [FriendController::class, 'index']);
Route::post('/friend/create', [FriendController::class, 'store']);
Route::get('/friend/{userId}', [FriendController::class, 'showByUserId']);


//accept
Route::get('/friends/list', [AcceptFriendController::class, 'index']);
Route::post('/friends/create', [AcceptFriendController::class, 'store']);
Route::get('/friends/{userId}', [AcceptFriendController::class, 'showByUserId']);

//reject
Route::get('/fri/list', [RejectFriendController::class, 'index']);
Route::post('/fri/create', [RejectFriendController::class, 'store']);
