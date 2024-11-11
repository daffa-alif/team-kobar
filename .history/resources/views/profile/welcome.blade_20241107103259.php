@extends('layouts.app')

@section('content')
    <div class="profile-container">
        <h1>Welcome to your Profile</h1>
        <p>{{ Auth::user()->name }}'s Profile</p>
                    <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="Profile Picture" style="width: 100px; height: 100px; border-radius: 50%;">
                @else
                    <img src="{{ asset('images/default-profile.png') }}" alt="Default Profile Picture" style="width: 100px; height: 100px; border-radius: 50%;">
                @endif

                <h2>{{ Auth::user()->name }}</h2>

                <p>
                    {{ Auth::user()->description ? Auth::user()->description : 'No description available.' }}
                </p>

                <div>
                    <a href="{{ route('profile.edit') }}">Edit Profile</a>
                </div>

                <form action="{{ route('logout') }}" method="POST" style="margin-top: 20px;">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </div>
        </div>
    </div>
@endsection
