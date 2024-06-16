<?php

use App\Http\Controllers\accept\AcceptFriendController;
use App\Http\Controllers\friend\FriendController;
use App\Models\Friend;
// use App\Http\Controllers\Auth\AuthController;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Profile\ProfileController;
// use App\Http\Controllers\AuthController;
use App\Http\Controllers\Post\PostController;
use App\Http\Controllers\Comment\CommentController;
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


// Route::get('/me', [AuthController::class, 'index'])->middleware('auth:sanctum');

// log in and register routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'index']);

    Route::prefix('profile')->group(function () {
        Route::get('/get', [ProfileController::class, 'getProfilePicture']);
        Route::post('/upload', [ProfileController::class, 'uploadProfile']);
        Route::delete('/delete', [ProfileController::class, 'deleteProfilePicture']);
        Route::put('/update_info', [ProfileController::class, 'updateProfileInfo']);
    });

    Route::prefix('post')->group(function () {
        Route::get('/list', [PostController::class, 'index']);
        Route::post('/create', [PostController::class, 'store']);
        Route::get('/show/{postId}', [PostController::class, 'showByPostId']);
        Route::post('/update/{id}', [PostController::class, 'update']);
    });


    Route::prefix('comment')->group(function () {
        Route::get('/list/{postId}', [CommentController::class, 'index']);
        Route::post('/create', [CommentController::class, 'store']);
        Route::get('/show/{userId}', [CommentController::class, 'showByUserId']);
        Route::delete('/{id}', [CommentController::class, 'destroy']);
    });

    Route::prefix('friend')->group(function () {
        
        // Route::get('/friend/{userId}', 'FriendController@showByUserId');
        Route::get('/list', [FriendController::class, 'friendList']);

        //request
        Route::post('/request', [FriendController::class, 'sendFriendRequest']); // to send friend request
        Route::get('/get_friend_request', [FriendController::class, 'getFriendRequest']); //to see who send you request for friend

        //accept
        Route::put('/accept/{friendRequestId}', [FriendController::class, 'acceptFriendRequest']);

        //reject
        Route::put('/reject/{friendRequestId}', [FriendController::class, 'rejectFriendRequest']);
    });
});
