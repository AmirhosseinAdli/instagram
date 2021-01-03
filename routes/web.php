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
//    Route::get('entercode', [AuthController::class])->name('enterCode');
    Route::post('register', [AuthController::class, 'register'])->name('register');
});
