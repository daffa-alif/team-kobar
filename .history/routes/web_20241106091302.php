<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use app\http\j
use App\Models\User;

// Root route: Redirects to login if not authenticated, otherwise goes to welcome
Route::get('/', function () {
    return Auth::check() ? redirect('/welcome') : redirect()->route('login');
});



Route::get('/profile/edit', [AuthController::class, 'edit'])->middleware('auth')->name('profile.edit');

// Handle the profile update process
Route::put('/profile/update', [AuthController::class, 'update'])->middleware('auth')->name('profile.update');

// Show the login form
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Handle the login process
Route::post('/login', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($request->only('email', 'password'))) {
        return redirect()->intended('/welcome');
    }

    throw ValidationException::withMessages([
        'email' => ['The provided credentials are incorrect.'],
    ]);
});

// Show the registration form
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// Handle the registration process
Route::post('/register', function (Request $request) {
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
        'profile_picture' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        'description' => 'nullable|string|max:500',
    ]);

    // Prepare user data
    $userData = $request->only('name', 'email', 'description');
    $userData['password'] = Hash::make($request->password);

    // Handle profile picture upload if available
    if ($request->hasFile('profile_picture')) {
        $userData['profile_picture'] = $request->file('profile_picture')->store('profile_pictures', 'public');
    }

    // Create and log in the user
    $user = User::create($userData);
    Auth::login($user);

    return redirect('/welcome');
});

// Handle the logout process
Route::post('/logout', function (Request $request) {
    Auth::logout();
    return redirect('/login');
})->name('logout');

// Protected route for welcome page, requires authentication
Route::get('/welcome', function () {
    return view('welcome');
})->middleware('auth');

// Show the profile edit form
Route::get('/profile/edit', function () {
    return view('auth.edit'); // Ensure you have a view named 'auth.edit'
})->middleware('auth')->name('profile.edit');

// Handle the profile update process
Route::put('/profile/update', function (Request $request) {
    $request->validate([
        'profile_picture' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        'description' => 'nullable|string|max:500',
    ]);

    $user = Auth::user();

    // Update the profile picture if provided
    if ($request->hasFile('profile_picture')) {
        $user->profile_picture = $request->file('profile_picture')->store('profile_pictures', 'public');
    }

    // Update description
    $user->description = $request->description;
    $user->save();

    return redirect('/welcome')->with('success', 'Profile updated successfully!');
})->middleware('auth')->name('profile.update');
<<<<<<< HEAD
=======


Route::get('/journal/index', [JournalController::class, 'index'])->middleware('auth')->name('journal.index');
Route::get('/journal/create', [JournalController::class, 'create'])->middleware('auth')->name('journal.create');
Route::post('/journal/store', [JournalController::class, 'store'])->middleware('auth')->name('journal.store');
Route::get('/journal/{id}', [JournalController::class, 'show'])->name('journal.show');
Route::delete('/journal/{id}', [JournalController::class, 'destroy'])->name('journal.destroy');



>>>>>>> 8fbd0a7dd7aa87067fcfc7a7ecdbae44dfb3ca40
