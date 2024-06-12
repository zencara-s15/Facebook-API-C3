<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\friend\FriendController;
use App\Models\Friend;
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

Route::post('/login', [AuthController::class, 'login']);
Route::get('/me', [AuthController::class, 'index'])->middleware('auth:sanctum');

Route::get('/friend', [FriendController::class, 'index']);
Route::post('/friend/create', [FriendController::class, 'store']);