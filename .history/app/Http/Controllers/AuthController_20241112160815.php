<?php

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
        // Validate input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to log in with provided credentials
        if (Auth::attempt($request->only('email', 'password'))) {
            return redirect()->route('profile.welcome');  // Redirect to the profile welcome page
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
        // Validate registration input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Prepare user data for creation
        $userData = $request->only('name', 'email');
        $userData['password'] = Hash::make($request->password);

        // Handle profile picture upload if available
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
        Auth::logout(); // Log out the user
        return redirect()->route('home'); // Redirect to the home page after logout
    }

    /**
     * Handle profile update process.
     */
    public function update(Request $request)
    {
        // Validate input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'profile_picture' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'description' => 'nullable|string|max:500',
        ]);

        $user = Auth::user(); // Get the currently authenticated user

        // Update user data
        $user->name = $request->name;
        $user->email = $request->email;

        // Handle profile picture upload if available
        if ($request->hasFile('profile_picture')) {
            // Delete old profile picture if it exists
            if ($user->profile_picture) {
                \Storage::delete('public/' . $user->profile_picture);
            }
            $user->profile_picture = $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        // Update description if provided
        $user->description = $request->description;
        $user->save(); // Save changes

        // Redirect to profile welcome page after update
        return redirect()->route('profile.welcome')->with('success', 'Profile updated successfully.');
    }
}
