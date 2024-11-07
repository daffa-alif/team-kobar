<?php

// app/Http/Controllers/AuthController.php// app/Http/Controllers/AuthController.php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        return view('auth.login'); // Return the login view
    }

    /**
     * Handle the login process.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to log the user in with the provided credentials
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->intended('welcome');  // Redirect to the welcome page if login is successful
        }

        // If authentication fails, throw a validation error
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    /**
     * Show the registration form.
     */
    public function showRegistrationForm()
    {
        return view('auth.register'); // Return the registration view
    }

    /**
     * Handle the registration process.
     */
    public function register(Request $request)
    {
        // Validate user registration input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
    
        // Prepare user data for creation
        $userData = $request->only('name', 'email');
        $userData['password'] = Hash::make($request->password);
    
        // If a profile picture is uploaded, store it and set its path in the user data
        if ($request->hasFile('profile_picture')) {
            $userData['profile_picture'] = $request->file('profile_picture')->store('profile_pictures', 'public');
        }
    
        // Create the user
        User::create($userData);
    
        // Redirect to login page after registration
        return redirect()->route('login')->with('success', 'Account created successfully! Please log in.');
    }

    /**
     * Handle the logout process.
     */
    public function logout(Request $request)
    {
        Auth::logout();  // Log out the user
        return redirect()->route('login');  // Redirect to the login page after logout
    }

    w
}
