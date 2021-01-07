<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RelationController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\StoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group([
    'prefix' => 'auth',
    'as' => 'auth.',
], function () {
    Route::get('register', [AuthController::class, 'showRegister'])->name('showRegister');
    Route::post('sendcode', [AuthController::class, 'sendCode'])->name('sendCode');
    Route::post('register', [AuthController::class, 'register'])->name('register');
    Route::get('login', [AuthController::class, 'showLogin'])->name('showLogin');
    Route::post('login', [AuthController::class, 'Login'])->name('login');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});


Route::group([
    'middleware' => 'auth'
],function (){
    Route::get('/{user:username}', [ProfileController::class, 'profile'])->name('profile');
    Route::resource('posts', PostController::class);
    Route::resource('stories', StoryController::class);
    Route::resource('comments', CommentController::class);
    Route::get('followers/{user:username}',[RelationController::class,'followers'])->name('followers');
    Route::get('following/{user:username}',[RelationController::class,'following'])->name('following');
    Route::post('follow/{user}',[RelationController::class,'follow'])->name('follow');
    Route::post('unfollow/{user}',[RelationController::class,'unfollow'])->name('unfollow');
    Route::post('settings',[SettingController::class,'show'])->name('settings');
});
