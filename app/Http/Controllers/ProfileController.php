<?php

// app/Http/Controllers/ProfileController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Show the profile page.
     */
    public function welcome()
    {
        return view('profile.welcome'); // Return the profile view
    }
}

