@extends('layouts.app')

@section('content')
<!-- Hero Section with Background Image -->
<section class="bg-cover bg-center text-white py-16 px-6 text-center" 
    style="background-image: url('{{ asset('storage/background/image.jpg') }}');">
    <div class="relative z-10">
        <h1 class="text-4xl font-extrabold">Welcome to Your Diary Journal</h1>
        <p class="mt-4 text-xl">A place to write, share, and cherish your memories</p>
        <a href="{{ route('journal.create') }}" class="mt-6 inline-block bg-indigo-700 text-white py-3 px-6 rounded-full text-lg font-medium hover:bg-indigo-800 hover:shadow-lg hover:scale-105 transform transition-all duration-300">
            Start Writing
        </a>
    </div>
</section>

<!-- Content Section: Display Journals -->
<div class="container mx-auto py-12 px-6">
    <h2 class="text-3xl font-semibold text-center text-gray-800 mb-8">My Journals</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 justify-center">
        @forelse($journals as $journal)
            <!-- Journal Card -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden transform hover:scale-105 transition-all duration-300 hover:shadow-2xl">
                <!-- Card Image -->
                <img src="{{ $journal->image_url ? asset('storage/' . $journal->image_url) : 'https://via.placeholder.com/150' }}" 
                    alt="{{ $journal->title }}" 
                    class="w-full h-56 object-cover rounded-t-lg">

                <!-- Card Content -->
                <div class="p-6">
                    <h5 class="text-2xl font-bold text-gray-800">{{ $journal->title }}</h5>
                    <p class="text-gray-600 mt-3 text-sm">{!! Str::limit(strip_tags($journal->content), 120) !!}</p>


                    <!-- Journal Meta Information -->
                    <div class="text-gray-500 mt-3 text-xs">
                        <p>Created on: {{ $journal->created_at->setTimezone('Asia/Jakarta')->format('d M Y') }} at {{ $journal->created_at->setTimezone('Asia/Jakarta')->format('H:i') }} WIB</p>
                        @if($journal->created_at != $journal->updated_at)
                            <p>Last updated: {{ $journal->updated_at->setTimezone('Asia/Jakarta')->format('d M Y') }} at {{ $journal->updated_at->setTimezone('Asia/Jakarta')->format('H:i') }} WIB</p>
                        @endif
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center mt-4 space-x-4">
                        <a href="{{ route('journal.show', $journal->id) }}" 
                            class="bg-indigo-600 text-white px-4 py-2 rounded-full text-sm font-medium hover:bg-indigo-700 transition-all duration-300">
                            Read More
                        </a>

                        <a href="{{ route('journal.edit', $journal->id) }}" 
                            class="bg-yellow-600 text-white px-4 py-2 rounded-full text-sm font-medium hover:bg-yellow-700 transition-all duration-300">
                            Edit
                        </a>

                        <form action="{{ route('journal.destroy', $journal->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this journal?')" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-full text-sm font-medium hover:bg-red-700 transition-all duration-300">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center">
                <div class="bg-gray-50 rounded-lg p-8">
                    <p class="text-gray-600 text-lg mb-4">No journals found.</p>
                    <p class="text-gray-500">Start writing your first journal entry!</p>
                    <a href="{{ route('journal.create') }}" 
                       class="mt-4 inline-block bg-indigo-600 text-white px-6 py-3 rounded-full text-sm font-medium hover:bg-indigo-700 transition-all duration-300">
                        Create Journal
                    </a>
                </div>
            </div>
        @endforelse
    </div>

   <!-- Pagination Section -->
<!-- Pagination Section -->
@if ($journals->hasPages())
<nav role="navigation" aria-label="Pagination Navigation" class="flex flex-col items-center justify-center mt-8 space-y-4">
    <!-- Mobile Pagination (Current Page Indicator) -->
    <div class="sm:hidden w-full flex flex-col items-center gap-4">
        <p class="text-sm text-gray-700">
            <span class="font-medium">Page {{ $journals->currentPage() }}</span>
            /
            <span class="font-medium">{{ $journals->lastPage() }}</span>
        </p>
        
        <div class="w-full flex justify-center gap-2">
            <!-- Mobile Previous Button -->
            @if ($journals->onFirstPage())
                <span class="flex-1 max-w-[120px] inline-flex justify-center items-center px-4 py-2 text-sm font-medium text-gray-400 bg-white border border-gray-300 cursor-not-allowed leading-5 rounded-full">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    Prev
                </span>
            @else
                <a href="{{ $journals->previousPageUrl() }}" 
                   class="flex-1 max-w-[120px] inline-flex justify-center items-center px-4 py-2 text-sm font-medium text-indigo-600 bg-white border border-gray-300 rounded-full hover:bg-indigo-50 hover:border-indigo-400 active:bg-indigo-100 transition-all duration-300">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    Prev
                </a>
            @endif

            <!-- Current/Total Pages for Mobile -->
            <div class="flex-1 inline-flex justify-center items-center gap-1">
                @for ($i = max(1, $journals->currentPage() - 1); $i <= min($journals->lastPage(), $journals->currentPage() + 1); $i++)
                    @if ($i == $journals->currentPage())
                        <span aria-current="page" class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-white bg-indigo-600 border border-indigo-600 cursor-default leading-5 rounded-full shadow-sm">
                            {{ $i }}
                        </span>
                    @else
                        <a href="{{ $journals->url($i) }}" 
                           class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-full hover:bg-indigo-50 hover:text-indigo-700 transition-all duration-300">
                            {{ $i }}
                        </a>
                    @endif
                @endfor
            </div>

            <!-- Mobile Next Button -->
            @if ($journals->hasMorePages())
                <a href="{{ $journals->nextPageUrl() }}" 
                   class="flex-1 max-w-[120px] inline-flex justify-center items-center px-4 py-2 text-sm font-medium text-indigo-600 bg-white border border-gray-300 rounded-full hover:bg-indigo-50 hover:border-indigo-400 active:bg-indigo-100 transition-all duration-300">
                    Next
                    <svg class="w-5 h-5 ml-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </a>
            @else
                <span class="flex-1 max-w-[120px] inline-flex justify-center items-center px-4 py-2 text-sm font-medium text-gray-400 bg-white border border-gray-300 cursor-not-allowed leading-5 rounded-full">
                    Next
                    <svg class="w-5 h-5 ml-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </span>
            @endif
        </div>
    </div>

    <!-- Desktop Pagination -->
    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-center">
        <div>
            <span class="relative z-0 inline-flex gap-2">
                {{-- Previous Page Link --}}
                @if ($journals->onFirstPage())
                    <span aria-disabled="true" aria-label="Previous">
                        <span class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-gray-400 bg-white border border-gray-300 cursor-not-allowed rounded-full leading-5">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </span>
                    </span>
                @else
                    <a href="{{ $journals->previousPageUrl() }}" rel="prev" 
                       class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-indigo-600 bg-white border border-gray-300 rounded-full leading-5 hover:bg-indigo-50 hover:border-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-indigo-100 transition-all duration-300">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                    </a>
                @endif

                {{-- Pagination Numbers --}}
                @for ($i = 1; $i <= $journals->lastPage(); $i++)
                    @if ($i == $journals->currentPage())
                        <span aria-current="page">
                            <span class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-white bg-indigo-600 border border-indigo-600 cursor-default leading-5 rounded-full shadow-sm transform scale-110 transition-all duration-300">
                                {{ $i }}
                            </span>
                        </span>
                    @else
                        <a href="{{ $journals->url($i) }}" 
                           class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-full hover:bg-indigo-50 hover:text-indigo-700 hover:border-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-indigo-100 transition-all duration-300">
                            {{ $i }}
                        </a>
                    @endif
                @endfor

                {{-- Next Page Link --}}
                @if ($journals->hasMorePages())
                    <a href="{{ $journals->nextPageUrl() }}" rel="next" 
                       class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-indigo-600 bg-white border border-gray-300 rounded-full leading-5 hover:bg-indigo-50 hover:border-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 active:bg-indigo-100 transition-all duration-300">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                    </a>
                @else
                    <span aria-disabled="true" aria-label="Next">
                        <span class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-gray-400 bg-white border border-gray-300 cursor-not-allowed rounded-full leading-5">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </span>
                    </span>
                @endif
            </span>
        </div>
    </div>
</nav>
@endif
@endsection