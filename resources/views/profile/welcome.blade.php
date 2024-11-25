@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto p-6 bg-white rounded-xl shadow-2xl mt-10" x-data="{ open: false }">
        <h1 class="text-4xl font-semibold text-center text-gray-800 mb-8">Your Profile</h1>

        <div class="flex items-center justify-center mb-8">
            <!-- Profile Picture Section -->
            <div class="relative">
                <!-- Profile Picture -->
                <img 
                    src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : 'https://via.placeholder.com/150' }}" 
                    alt="Profile Picture" 
                    class="w-40 h-40 object-cover rounded-full border-4 border-indigo-500 shadow-xl transition-all duration-300 transform hover:scale-105 cursor-pointer" 
                    @click="open = true">
            </div>
        </div>

        <!-- Combined Profile Information Section -->
        <div class="bg-gray-50 p-6 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 space-y-6">
            <!-- Name Section -->
            <div class="border-b border-gray-200 pb-4">
                <h3 class="text-xl font-medium text-gray-700 mb-2">Nama</h3>
                <p class="text-lg text-gray-900">{{ Auth::user()->name }}</p>
            </div>

            <!-- Description Section -->
            <div class="border-b border-gray-200 pb-4">
                <h3 class="text-xl font-medium text-gray-700 mb-2">Deskripsi</h3>
                <p class="text-lg text-gray-600">{{ Auth::user()->description ? Auth::user()->description : 'No description available.' }}</p>
            </div>

            <!-- Member Since Section -->
            <div>
                <h3 class="text-xl font-medium text-gray-700 mb-2">Tanggal Akun dibuat</h3>
                <p class="text-lg text-gray-600">{{ Auth::user()->created_at->format('F j, Y') }}</p>
            </div>
        </div>

        <!-- Edit Profile Link -->
        <div class="mt-6 text-center">
            <form action="{{ route('profile.edit') }}" method="GET">
                <button type="submit" class="w-full bg-indigo-500 hover:bg-indigo-600 text-white font-medium py-3 px-6 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600 transition-all duration-300">
                    Edit Profile
                </button>
            </form>
        </div>

        <!-- Logout Button -->
        <div class="mt-6 text-center">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white font-medium py-3 px-6 rounded-md focus:outline-none focus:ring-2 focus:ring-red-600 transition-all duration-300">
                    Logout
                </button>
            </form>
        </div>

        <!-- Modal for Viewing Profile Picture -->
        <div 
            @click.away="open = false" 
            x-show="open" 
            class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50 backdrop-blur-sm"
            x-transition:enter="transition-opacity ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
        >
            <div class="bg-white p-4 rounded-lg shadow-lg max-w-md w-auto mx-4">
                <div class="flex justify-end">
                    <button @click="open = false" class="text-xl text-gray-500">&times;</button>
                </div>
                <!-- Image Modal with max width -->
                <img src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : 'https://via.placeholder.com/150' }}" 
                     alt="Profile Picture" 
                     class="w-full h-auto max-w-[400px] mx-auto object-cover rounded-lg shadow-lg">
            </div>
        </div>
    </div>

    <!-- Include Alpine.js if not already included in your layout -->
    <script src="//unpkg.com/alpinejs" defer></script>
@endsection