@extends('layouts.app')

@section('content')
    <div class="flex justify-center items-center h-screen">
        <div class="text-center">
            <h1 class="text-3xl font-bold mb-4">Profile</h1>
            <div class="profile-section">
                @if(Auth::user()->profile_picture)
                    <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="Profile Picture" class="w-24 h-24 rounded-full mx-auto">
                @else
                    <img src="{{ asset('images/default-profile.png') }}" alt="Default Profile Picture" class="w-24 h-24 rounded-full mx-auto">
                @endif

                <h2 class="text-2xl mt-4">{{ Auth::user()->name }}</h2>

                <p class="mt-2">
                    {{ Auth::user()->description ? Auth::user()->description : 'No description available.' }}
                </p>

                <div class="mt-4">
                    <a href="{{ route('profile.edit') }}" class="text-blue-500 hover:underline">Edit Profile</a>
                </div>

                <form action="{{ route('logout') }}" method="POST" class="mt-6">
                    @csrf
                    <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600">Logout</button>
                </form>
            </div>
        </div>
    </div>
@endsection
