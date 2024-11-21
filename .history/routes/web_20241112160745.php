<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Default Home Route
Route::get('/', function () {
    return view('journal/index'); // Laravel's default welcome page
})->name('home');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Profile Welcome Route
Route::get('/profile/welcome', function () {
    return view('profile.welcome'); // Make sure this Blade view exists
})->name('profile.welcome');

// Profile Update Route
Route::post('/profile/update', [AuthController::class, 'update'])->name('profile.update');
