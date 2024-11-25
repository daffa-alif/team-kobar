@extends('layouts.app')

@section('content')

    <style>
        /* Tambahkan sedikit style tambahan untuk memastikan tampilannya optimal */
        .input-file-label {
            display: block;
            padding: 8px;
            font-weight: bold;
            color: #4B5563;
        }

        /* Jika ingin modal cropper tampak lebih baik dengan rasio 1:1 */
        #cropperModal .relative {
            width: 100%;
            height: 100%;
            max-height: 500px; /* Sesuaikan dengan preferensi */
        }
    </style>

    <div class="max-w-3xl mx-auto p-6 bg-white rounded-lg shadow-lg mt-10">
        <h1 class="text-3xl font-semibold text-center text-gray-800 mb-8">Edit Profile</h1>

        <!-- Form untuk mengedit profil -->
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') <!-- Gunakan metode PUT untuk update -->

            <!-- Profile Picture Upload -->
            <div class="mb-6 text-center">
                <label for="profile_picture" class="block text-gray-700 font-medium mb-2">Profile Picture (Optional)</label>
                
                <!-- Image Container with Preview -->
                <div class="flex justify-center items-center space-x-4">
                    <div class="relative">
                        <!-- Display Profile Picture with Preview -->
                        <img id="profile-picture-preview" 
                             src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : 'https://via.placeholder.com/150' }}" 
                             class="w-32 h-32 object-cover rounded-full border-4 border-gray-300 shadow-md mx-auto" 
                             alt="Profile Picture">
                        
                        <!-- Upload Icon Button -->
                        <label for="profile_picture" class="absolute bottom-0 right-0 bg-indigo-600 text-white p-2 rounded-full cursor-pointer hover:bg-indigo-700 transition-all duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2 2l4-4m0 0l4 4l8-8M12 12l4-4l8 8m-8 8h4a2 2 0 0 0 2-2v-4m0-8a2 2 0 0 0-2-2h-4m-8 8v4a2 2 0 0 0 2 2h4" />
                            </svg>
                        </label>
                    </div>

                    <!-- Hidden Input File -->
                    <input type="file" id="profile_picture" name="profile_picture" accept="image/*" class="hidden" onchange="handleImageSelect(event)">
                </div>

                <!-- Information Text -->
                <p class="text-gray-500 mt-2 text-sm">Click the image to change your profile picture.</p>
            </div>

            <!-- Name Input -->
            <div class="mb-6">
                <label for="name" class="block text-gray-700 font-medium mb-2">Name</label>
                <input type="text" name="name" value="{{ Auth::user()->name }}" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600" required>
            </div>

            <!-- Email Input -->
            <div class="mb-6">
                <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
                <input type="email" name="email" value="{{ Auth::user()->email }}" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600" required>
            </div>

            <!-- Description Input -->
            <div class="mb-6">
                <label for="description" class="block text-gray-700 font-medium mb-2">Description (Optional)</label>
                <textarea name="description" class="w-full p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600" rows="4">{{ Auth::user()->description }}</textarea>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full py-3 bg-indigo-600 text-white font-medium rounded-md hover:bg-indigo-700 transition-all duration-300">Update Profile</button>
        </form>

        <!-- Success Message -->
        @if(session('success'))
            <p class="mt-4 text-green-500 text-center">{{ session('success') }}</p>
        @endif
    </div>

    <!-- Modal untuk Cropper -->
    <div id="cropperModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white p-6 rounded-lg shadow-xl max-w-4xl w-full mx-4">
            <div class="mb-4 flex justify-between items-center">
                <h3 class="text-xl font-semibold text-gray-800">Crop Profile Picture (1:1)</h3>
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

    <!-- Script untuk Cropper dan Preview Gambar -->
  <script>
    let cropper;

function handleImageSelect(event) {
    const file = event.target.files[0];
    if (file) {
        // Show the cropper modal
        const modal = document.getElementById('cropperModal');
        modal.style.display = 'flex';

        const image = document.getElementById('cropperImage');
        const reader = new FileReader();

        reader.onload = function (e) {
            image.src = e.target.result;

            // Destroy previous cropper if exists
            if (cropper) {
                cropper.destroy();
            }

            // Initialize cropper with 1:1 aspect ratio
            cropper = new Cropper(image, {
                aspectRatio: 1,  // Menggunakan rasio 1:1
                viewMode: 2,
                autoCropArea: 1,
                responsive: true,
                restore: false,
                guides: true,
                center: true,
                highlight: false,
                cropBoxMovable: true,
                cropBoxResizable: true,
                toggleDragModeOnDblclick: false,
            });
        };

        reader.readAsDataURL(file);
    }
}

function closeCropperModal() {
    const modal = document.getElementById('cropperModal');
    modal.style.display = 'none';
    if (cropper) {
        cropper.destroy();
    }
}

function cropImage() {
    if (cropper) {
        // Get cropped canvas
        const canvas = cropper.getCroppedCanvas({
            width: 800,    // 1:1 ratio example dimensions
            height: 800,
            imageSmoothingEnabled: true,
            imageSmoothingQuality: 'high',
        });

        // Convert to base64 string
        const croppedImage = canvas.toDataURL('image/jpeg');

        // Update preview
        document.getElementById('profile-picture-preview').src = croppedImage;

        // Store cropped image data
        // Optional: Jika Anda ingin menyimpannya di dalam input tersembunyi
        // document.getElementById('cropped-image').value = croppedImage;

        // Close modal
        closeCropperModal();
    }
}

  </script>

@endsection
