<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JournalController;

Route::get('/welcome', function () {
    return view('welcome'); // or whatever view you want to return
})->name('welcome');

// Root route: Redirects to login if not authenticated, otherwise goes to welcome
Route::get('/', function () {
    return Auth::check() ? redirect('/welcome') : redirect()->route('login');
});

// Show the login form
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Handle the login process
Route::post('/login', [AuthController::class, 'login']);

// Show the registration form
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');

// Handle the registration process
Route::post('/register', [AuthController::class, 'register']);

// Handle the logout process
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected route for welcome page, requires authentication
Route::get('/welcome', function () {
    return view('welcome');
})->middleware('auth');

// Show the profile edit form
Route::get('/profile/edit', function () {
    return view('auth.edit'); // Ensure you have a view named 'auth.edit'
})->middleware('auth')->name('profile.edit');

// Handle the profile update process
Route::put('/profile/update', [AuthController::class, 'update'])->middleware('auth')->name('profile.update');

// Journal routes (protected by authentication)
Route::get('/journal/index', [JournalController::class, 'index'])->middleware('auth')->name('journal.index');
Route::get('/journal/create', [JournalController::class, 'create'])->middleware('auth')->name('journal.create');
Route::post('/journal/store', [JournalController::class, 'store'])->middleware('auth')->name('journal.store');
Route::get('/journal/{id}', [JournalController::class, 'show'])->name('journal.show');
Route::delete('/journal/{id}', [JournalController::class, 'destroy'])->name('journal.destroy');

