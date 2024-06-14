<?php

// use App\Http\Controllers\Auth\AuthController;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Profile\ProfileController;
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

Route::middleware('auth:sanctum')->get('/me', function($req, $res){
    return $req->user();
});

// log in and register routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);



Route::middleware('auth:sanctum')->group(function (){
    Route::get('/profile', [AuthController::class, 'index']);
    Route::put('/profile/update', [ProfileController::class, 'update']);
    
    Route::post('/logout', [AuthController::class, 'logout']);

});
