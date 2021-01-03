<?php

use App\Http\Controllers\AuthController;
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
