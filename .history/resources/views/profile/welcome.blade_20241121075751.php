@extends('layouts.app')

@section('content')
    <div style="display: flex; justify-content: center; align-items: center; height: 100vh;">
        <div style="text-align: center;">
            <h1>Profile</h1>
            <div class="profile-section">
                @if(Auth::user()->profile_picture)
                    <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" 
                         alt="Profile Picture" 
                         style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover;">
                @else
                    <img src="{{ asset('storage/default-profile.png') }}" 
                         alt="Default Profile Picture" 
                         style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover;">
                @endif

                <h2>{{ Auth::user()->name }}</h2>

                <p>
                    {{ Auth::user()->description ? Auth::user()->description : 'No description available.' }}
                </p>

                <div style="margin-top: 20px;">
                    <a href="{{ route('profile.edit') }}" 
                       style="text-decoration: none; color: #007bff;">Edit Profile</a>
                </div>

                <form action="{{ route('logout') }}" method="POST" style="margin-top: 20px;">
                    @csrf
                    <button type="submit" 
                            style="background-color: #f44336; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer;">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
