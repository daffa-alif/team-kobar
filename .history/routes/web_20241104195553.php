<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Default route redirects to login page
Route::get('/', function () {
    return redirect()->route('login');
});

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected route for welcome page, requires authentication
Route::get('/welcome', function () {
    return view('welcome');
})->middleware('auth');
