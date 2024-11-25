@extends('layouts.app')

@section('content')

<div class="container mx-auto mt-10 max-w-6xl">
    <h2 class="text-3xl font-semibold text-center text-gray-800 mb-8">Edit Journal</h2>

    <!-- Form -->
    <form action="{{ route('journal.update', $journal->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-8 rounded-lg shadow-lg space-y-6">
        @csrf
        @method('PUT')

        <!-- Image Upload -->
        <div class="mb-6 text-center">
            <label for="image" class="block text-gray-700 font-medium mb-2">Image (Optional)</label>

            <!-- Image Container with Preview -->
            <div class="flex justify-center items-center space-x-4">
                <div class="relative">
                    <!-- Display Image Preview -->
                    <img id="image-preview" 
                        src="{{ $journal->image_url ? asset('storage/'.$journal->image_url) : 'https://via.placeholder.com/1920x1080' }}" 
                        class="w-64 h-36 object-cover border-4 border-gray-300 shadow-md mx-auto" 
                        alt="Image Preview">
                    
                    <!-- Upload Icon Button -->
                    <label for="image" class="absolute bottom-0 right-0 bg-indigo-600 text-white p-2 rounded-full cursor-pointer hover:bg-indigo-700 transition-all duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2 2l4-4m0 0l4 4l8-8M12 12l4-4l8 8m-8 8h4a2 2 0 0 0 2-2v-4m0-8a2 2 0 0 0-2-2h-4m-8 8v4a2 2 0 0 0 2 2h4" />
                        </svg>
                    </label>
                </div>

                <!-- Hidden Input File -->
                <input type="file" id="image" name="image" accept="image/*" class="hidden" onchange="handleImageSelect(event)">
                <input type="hidden" id="cropped-image" name="cropped_image" value="{{ old('cropped_image', $journal->cropped_image) }}">
            </div>

            <!-- Information Text -->
            <p class="text-gray-500 mt-2 text-sm">Click the image to change. Image will be cropped to 16:9 ratio.</p>
        </div>

        <!-- Title Input -->
        <div class="mb-4">
            <label for="title" class="block text-gray-700 text-lg font-medium">Title</label>
            <input type="text" class="form-control mt-2 p-3 border border-gray-300 rounded-md w-full focus:outline-none focus:ring-2 focus:ring-indigo-500" 
                id="title" name="title" value="{{ old('title', $journal->title) }}" required>
        </div>

        <!-- Content Input -->
        <div class="mb-4">
            <label for="content" class="block text-gray-700 text-lg font-medium">Content</label>
            <textarea class="form-control mt-2 p-3 border border-gray-300 rounded-md w-full h-[700px] focus:outline-none focus:ring-2 focus:ring-indigo-500" 
                    id="content" name="content" required>{{ old('content', $journal->content) }}</textarea>
        </div>

        <!-- Submit Button -->
        <div class="text-center">
            <button type="submit" class="bg-indigo-600 text-white px-6 py-3 rounded-md text-lg font-medium w-full hover:bg-indigo-700 transition-all duration-300 focus:outline-none">
                Save Changes
            </button>
        </div>
    </form>
</div>

<!-- Cropper Modal -->
<div id="cropperModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg shadow-xl max-w-4xl w-full mx-4">
        <div class="mb-4 flex justify-between items-center">
            <h3 class="text-xl font-semibold text-gray-800">Crop Image (16:9)</h3>
            <button onclick="closeCropperModal()" class="text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        
        <div class="relative h-96 bg-gray-100">
            <img id="cropperImage" class="max-h-full max-w-full">
        </div>
        
        <div class="mt-4 flex justify-end space-x-3">
            <button onclick="closeCropperModal()" class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300">
                Cancel
            </button>
            <button onclick="cropImage()" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                Crop & Save
            </button>
        </div>
    </div>
</div>

@endsection
