<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StoryController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group([
    'prefix' => 'auth',
    'as' => 'auth.',
],function () {
    Route::get('register', [AuthController::class, 'showRegister'])->name('showRegister');
    Route::post('sendcode', [AuthController::class, 'sendCode'])->name('sendCode');
    Route::post('register', [AuthController::class, 'register'])->name('register');
    Route::get('login', [AuthController::class, 'showLogin'])->name('showLogin');
    Route::post('login', [AuthController::class, 'Login'])->name('login');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware('auth')->get('/{user:username}',[ProfileController::class,'profile'])->name('profile');

Route::middleware('auth')->resource('posts',PostController::class);
Route::middleware('auth')->resource('stories',StoryController::class);
