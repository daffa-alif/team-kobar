@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-10 max-w-7xl">
    <!-- Card Konten -->
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        <!-- Gambar -->
        @if($journal->image_url)
            <img src="{{ asset('storage/' . $journal->image_url) }}" class="w-full h-96 object-cover" alt="{{ $journal->title }}">
        @endif

        <div class="p-6">
            <!-- Judul -->
            <h1 class="text-4xl font-bold text-gray-800 mb-4">{{ $journal->title }}</h1>
            <p class="text-sm text-gray-500 mb-6">Published on {{ $journal->created_at->format('F j, Y') }}</p>

            <hr class="mb-6 border-gray-300">

            <!-- Konten -->
            <div class="text-lg text-gray-700 leading-relaxed mb-6" style="line-height: 1.8;">
                {!! $journal->content !!} <!-- Menampilkan konten dengan format HTML -->
            </div>
        </div>
    </div>

    <!-- Card Tombol -->
    <div class="bg-white shadow-lg rounded-lg mt-6">
        <div class="p-6 flex space-x-2"> <!-- Mengubah space-x-4 menjadi space-x-2 untuk jarak lebih kecil -->
            <!-- Tombol Edit -->
            <a href="{{ route('journal.edit', $journal->id) }}" class="bg-indigo-600 text-white px-6 py-3 rounded-lg text-lg font-medium hover:bg-indigo-700 transition-all duration-300">
                Edit
            </a>

            <!-- Tombol Delete -->
            <form action="{{ route('journal.destroy', $journal->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this journal?');" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 text-white px-6 py-3 rounded-lg text-lg font-medium hover:bg-red-700 transition-all duration-300">
                    Delete
                </button>
            </form>

            <!-- Tombol Kembali -->
            <a href="{{ route('journal.index') }}" class="bg-gray-500 text-white px-6 py-3 rounded-lg text-lg font-medium hover:bg-gray-600 transition-all duration-300">
                Back to Journals
            </a>
        </div>
    </div>
</div>
@endsection
