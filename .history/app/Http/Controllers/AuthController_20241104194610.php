<?php

// app/Http/Controllers/AuthController.php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // Show the login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle the login process
    public function login(Request $request)
    {
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
    }

    // Show the registration form
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Handle the registration process
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'profile_picture' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'description' => 'nullable|string|max:500',
        ]);

        $userData = $request->only('name', 'email', 'description');
        $userData['password'] = Hash::make($request->password);

        if ($request->hasFile('profile_picture')) {
            $userData['profile_picture'] = $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        $user = User::create($userData);

        Auth::login($user);

        return redirect('/welcome');
    }

    // Handle the logout process
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }
}
