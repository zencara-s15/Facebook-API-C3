<?php

use App\Http\Controllers\Auth\AuthController;
// use App\Http\Controllers\AuthController;
use App\Http\Controllers\Comment\CommentController;
use App\Http\Controllers\Like\LikeController;
use App\Http\Controllers\Post\PostController as PostPostController;
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

use App\Http\Controllers\PostController;
use PhpParser\Node\Expr\PostDec;



Route::post('/login', [AuthController::class, 'login']);
Route::get('/me', [AuthController::class, 'index'])->middleware('auth:sanctum');

Route::get('/post/list', [PostPostController::class, 'index'])->name('post.list');
Route::post('/post/create', [PostPostController::class, 'store'])->name('post.create');
Route::get('/post/show/{postId}', [PostPostController::class, 'showByPostId']);
// Route::put('/post/update/{id}', [PostPostController::class, 'update']);
Route::put('/post/update/{id}', [PostPostController::class, 'update'])->name('post.update');
// Route::post('/put/update/{id}', [PostController::class, 'update'])->name('post.update');
// Route::post('/post/delete/{id}', [PostController::class, 'delete'])->name('post.delete');

Route::get('/comment/list', [CommentController::class, 'index'])->name('comment.list');
Route::post('/comment/create', [CommentController::class, 'store'])->name( 'comment.create' );
Route::get('/comment/show/{userId}', [CommentController::class, 'showByUserId']);
Route::delete('/comment/{id}', [CommentController::class, 'destroy']);


// like
Route::get('/like/list', [LikeController::class, 'index'])->name('comment.list');
Route::post('/like/create', [LikeController::class, 'store']);
