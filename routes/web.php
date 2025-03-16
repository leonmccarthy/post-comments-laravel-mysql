<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{post}', [PostController::class, 'showPost'])->name('showPost');


Route::middleware('auth')->group(function(){
    Route::get('/post/create/', [PostController::class, 'createPostView'])->name('createPostView');
    Route::post('/posts/comment/create/{post}', [CommentController::class, 'createComment'])->name('createComment');
    Route::post('/posts/comment/delete/{post}/{comment}', [CommentController::class, 'deleteComment'])->name('deleteComment');
    Route::post('/post/createAction', [PostController::class, 'createPostAction'])->name('createPostAction');
    Route::post('/post/delete/{post}', [PostController::class, 'deletePost'])->name('deletePost');
});
