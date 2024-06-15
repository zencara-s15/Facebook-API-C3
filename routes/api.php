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


Route::middleware('auth:sanctum')->group(function (){

    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'index']);

    Route::get('/profile/get', [ProfileController::class, 'getProfilePicture']);
    Route::post('/profile/upload', [ProfileController::class, 'uploadProfile']);
    Route::delete('/profile/delete', [ProfileController::class, 'deleteProfilePicture']);
    Route::put('/profile/update_info', [ProfileController::class, 'updateProfileInfo']);
    
});

Route::get('/post/list', [PostController::class, 'index'])->name('post.list');
Route::post('/post/create', [PostController::class, 'store'])->name('post.create');
Route::get('/post/show/{postId}', [PostController::class, 'showByPostId']);
// Route::put('/post/update/{id}', [PostController::class, 'update']);
Route::put('/post/update/{id}', [PostController::class, 'update'])->name('post.update');
// Route::post('/put/update/{id}', [PostController::class, 'update'])->name('post.update');
// Route::post('/post/delete/{id}', [PostController::class, 'delete'])->name('post.delete');

Route::get('/comment/list', [CommentController::class, 'index'])->name('comment.list');
Route::post('/comment/create', [CommentController::class, 'store'])->name( 'comment.create' );
Route::get('/comment/show/{userId}', [CommentController::class, 'showByUserId']);
Route::delete('/comment/{id}', [CommentController::class, 'destroy']);
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
