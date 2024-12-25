<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
// use App\Http\Controllers\Auth\LineLoginController;
use App\Http\Controllers\Auth\LineController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// Google 登入的重定向路由
Route::get('login/google', [LoginController::class, 'redirectToGoogle'])->name('login.google');

// Google 登入後的回調路由
Route::get('login/google/callback', [LoginController::class, 'handleGoogleCallback']);


Route::get('login/line', [LineController::class, 'redirectToProvider'])->name('login.line');;
Route::get('login/line/callback', [LineController::class, 'handleProviderCallback']);
require __DIR__.'/auth.php';
