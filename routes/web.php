<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TweetController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;

Route::get('/', function () {
    return view('index');
})->name('index');

// Login and Register routes
Route::get('/login', [UserController::class, 'loginForm'])->name('login')->middleware('guest');
Route::post('/login', [UserController::class, 'login'])->name('login')->middleware('guest');
Route::get('/register', [UserController::class, 'registerForm'])->name('register')->middleware('guest');
Route::post('/register', [UserController::class, 'register'])->name('register')->middleware('guest');

Route::middleware(['auth'])->group(function () {

    Route::get('/tweets', [TweetController::class, 'index'])->name('tweets.index');
    Route::get('/tweets/create', [TweetController::class, 'create'])->name('tweets.create');
    Route::post('/tweets/create', [TweetController::class, 'store'])->name('tweets.store');
    Route::get('/tweets/{tweet}', [TweetController::class, 'show'])->name('tweets.show');
    Route::get('/tweets/{tweet}/edit', [TweetController::class, 'edit'])->name('tweets.edit');
    Route::put('/tweets/{tweet}', [TweetController::class, 'update'])->name('tweets.update');
    Route::delete('/tweets/{tweet}', [TweetController::class, 'destroy'])->name('tweets.destroy');

    Route::post('/tweets/{tweet}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/tweets/{tweet}/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

    Route::get('/users/{username}', [UserController::class, 'users'])->name('users.profile');
    Route::get('/users/{username}/edit', [UserController::class, 'editUsersForm'])->name('users.edit');
    Route::put('/users/{username}/edit', [UserController::class, 'editUsers'])->name('users.update');
    Route::delete('/users/{username}/delete', [UserController::class, 'deleteUsers'])->name('users.delete');

    Route::get('/users/{username}/edit/password', [UserController::class, 'editPasswordForm'])->name('users.edit.password');
    Route::put('/users/{username}/edit/password', [UserController::class, 'updatePassword'])->name('users.update.password');


    Route::post('/users/logout', [UserController::class, 'logout'])->name('users.logout');
});
