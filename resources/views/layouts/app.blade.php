<!DOCTYPE html>
<html lang="en">
<head>
    <title>Diary Journal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- Tiny Mce Teks Format -->
    <script src="https://cdn.tiny.cloud/1/587zdcqu5fv7s17cbm84aya9rtkh2snlkcr9ym8xt4tgn0xd/tinymce/5/tinymce.min.js"></script>

    <!-- Cropper image -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.js" defer></script>
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
</head>
<body x-data="{ 
    open: false, 
    isSearchOpen: false,
    toggleMenu() {
        this.open = !this.open;
        if(this.open) this.isSearchOpen = false;
    },
    toggleSearch() {
        this.isSearchOpen = !this.isSearchOpen;
        if(this.isSearchOpen) this.open = false;    
    }
}" 
:class="{ 'overflow-hidden': open || isSearchOpen }" 
class="relative">
    <!-- Navigation Bar -->
    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
            <div class="relative flex items-center justify-between h-16">
                <!-- Mobile Menu Button -->
                <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                    <button 
                        @click="toggleMenu()"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-0"
                        aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <div class="relative w-6 h-5">
    <div class="absolute w-6 h-0.5 bg-gray-900 transition-all duration-300 ease-in-out transform origin-center"
        :class="{ 'rotate-45 top-2.5': open, 'top-0': !open }"></div>
    <div class="absolute w-6 h-0.5 bg-gray-900 transition-all duration-300 ease-in-out transform origin-center"
        :class="{ 'opacity-0': open, 'top-2.5': !open }"></div>
    <div class="absolute w-6 h-0.5 bg-gray-900 transition-all duration-300 ease-in-out transform origin-center"
        :class="{ '-rotate-45 top-2.5': open, 'bottom-0': !open }"></div>
</div>

                    </button>
                </div>

                <!-- Logo and Title -->
                <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
                    <a href="{{ route('journal.index') }}" class="text-2xl font-bold text-gray-900">Diary Journal</a>
                </div>

                <!-- Desktop Navbar -->
                <div class="hidden sm:block sm:ml-6">
                    <div class="flex items-center space-x-4">
                        <!-- Desktop Search Bar (Moved to the left) -->
                        <form action="{{ route('journal.index') }}" method="GET" 
                              x-data="{ isSearching: false }"
                              class="relative flex items-center">
                            <div class="relative group">
                                <input 
                                    type="text" 
                                    name="search" 
                                    id="search"
                                    @focus="isSearching = true"
                                    @blur="isSearching = false"
                                    class="w-64 pl-10 pr-4 py-2 text-sm text-gray-900 bg-gray-50 
                                           rounded-full border border-gray-300 
                                           transition-all duration-300 ease-in-out
                                           focus:w-80 focus:ring-2 focus:ring-indigo-500/50 
                                           focus:border-indigo-500 hover:border-indigo-400 
                                           focus:outline-none focus:bg-white
                                           group-hover:shadow-lg group-hover:shadow-indigo-500/20"
                                    placeholder="Cari Journal..."
                                >
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg 
                                        class="w-5 h-5 text-gray-400 transition-all duration-300 ease-in-out"
                                        :class="{ 'text-indigo-500 scale-110': isSearching }"
                                        fill="none" 
                                        stroke="currentColor" 
                                        viewBox="0 0 24 24"
                                    >
                                        <path 
                                            stroke-linecap="round" 
                                            stroke-linejoin="round" 
                                            stroke-width="2" 
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                                        >
                                        </path>
                                    </svg>
                                </div>
                            </div>
                        </form>
                        
                        <!-- Navigation Links -->
                        <a href="{{ route('journal.index') }}" class="{{ request()->routeIs('journal.index') ? 'bg-indigo-600 text-white px-3 py-2 rounded-md text-sm font-medium' : 'text-gray-900 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium' }}">Beranda</a>
                        <a href="{{ route('journal.create') }}" class="{{ request()->routeIs('journal.create') ? 'bg-indigo-600 text-white px-3 py-2 rounded-md text-sm font-medium' : 'text-gray-900 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium' }}">Unggah</a>
                        <a href="{{ route('profile.welcome') }}" class="{{ request()->routeIs('profile.welcome') ? 'bg-indigo-600 text-white px-3 py-2 rounded-md text-sm font-medium' : 'text-gray-900 hover:text-indigo-600 px-3 py-2 rounded-md text-sm font-medium' }}">Data</a>
                    </div>
                </div>

                <!-- Mobile Search Icon -->
                <div class="sm:hidden flex items-center">
                    <button 
                        @click="toggleSearch()" 
                        class="p-2 rounded-full hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-colors duration-200"
                    >
                        <svg 
                            class="w-6 h-6 text-gray-600 transition-colors duration-200"
                            :class="{ 'text-indigo-600': isSearchOpen }"
                            fill="none" 
                            stroke="currentColor" 
                            viewBox="0 0 24 24"
                        >
                            <path 
                                stroke-linecap="round" 
                                stroke-linejoin="round" 
                                stroke-width="2" 
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                            >
                            </path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Rest of the mobile menu and search components remain the same -->
        <!-- Mobile Search Bar -->
        <div 
            x-show="isSearchOpen"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 transform -translate-y-2"
            x-transition:enter-end="opacity-100 transform translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 transform translate-y-0"
            x-transition:leave-end="opacity-0 transform -translate-y-2"
            class="sm:hidden absolute top-16 inset-x-0 p-4 bg-white shadow-lg z-50"
        >
            <form action="{{ route('journal.index') }}" method="GET" class="relative">
                <input 
                    type="text" 
                    name="search" 
                    class="w-full pl-10 pr-4 py-2 text-sm text-gray-900 
                           bg-gray-50 rounded-full border border-gray-300 
                           focus:ring-2 focus:ring-indigo-500/50 
                           focus:border-indigo-500 focus:outline-none
                           transition-all duration-300"
                    placeholder="Search journals..."
                    @click.away="isSearchOpen = false"
                >
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg 
                        class="w-5 h-5 text-gray-400" 
                        fill="none" 
                        stroke="currentColor" 
                        viewBox="0 0 24 24"
                    >
                        <path 
                            stroke-linecap="round" 
                            stroke-linejoin="round" 
                            stroke-width="2" 
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
                        >
                        </path>
                    </svg>
                </div>
            </form>
        </div>

        <!-- Mobile Menu -->
        <div 
            x-show="open"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 transform -translate-y-2"
            x-transition:enter-end="opacity-100 transform translate-y-0"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 transform translate-y-0"
            x-transition:leave-end="opacity-0 transform -translate-y-2"
            class="sm:hidden absolute top-16 inset-x-0 p-4 bg-white shadow-lg z-50">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="{{ route('journal.index') }}" class="{{ request()->routeIs('journal.index') ? 'bg-indigo-600 text-white block px-3 py-2 rounded-md text-base font-medium' : 'text-gray-900 block px-3 py-2 rounded-md text-base font-medium' }}">Beranda</a>
                <a href="{{ route('journal.create') }}" class="{{ request()->routeIs('journal.create') ? 'bg-indigo-600 text-white block px-3 py-2 rounded-md text-base font-medium' : 'text-gray-900 block px-3 py-2 rounded-md text-base font-medium' }}">Unggah</a>
                <a href="{{ route('profile.welcome') }}" class="{{ request()->routeIs('profile.welcome') ? 'bg-indigo-600 text-white block px-3 py-2 rounded-md text-base font-medium' : 'text-gray-900 block px-3 py-2 rounded-md text-base font-medium' }}">Data</a>
            </div>
        </div>
    </nav>

    <!-- Rest of the content remains the same -->
    <div 
        class="absolute inset-0 z-30 bg-white/50 backdrop-blur-sm transition-opacity duration-500"
        x-show="open || isSearchOpen"
        x-cloak
        x-transition:enter="transition-opacity ease-in-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-in-out duration-300"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0">
    </div>

    <div class="container mt-4 z-20 relative">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        tinymce.init({
          selector: 'textarea#content',
          plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
          toolbar_mode: 'floating',
          setup: function (editor) {
              editor.on('change', function () {
                  tinymce.triggerSave();
              });
              editor.on('BeforeSetContent', function(e) {
                  e.content = e.content.replace(/{/g, '').replace(/}/g, '');
              });
          }
        });
      </script>


<!-- Cropper -->
<script>
    let cropper;

    function handleImageSelect(event) {
        const file = event.target.files[0];
        if (file) {
            // Show the cropper modal
            const modal = document.getElementById('cropperModal');
            modal.style.display = 'flex';
            
            // Create image preview for cropper
            const image = document.getElementById('cropperImage');
            const reader = new FileReader();
            
            reader.onload = function(e) {
                image.src = e.target.result;
                
                // Initialize cropper with 16:9 aspect ratio
                if (cropper) {
                    cropper.destroy();
                }
                
                cropper = new Cropper(image, {
                    aspectRatio: 16 / 9,
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
                width: 1600,    // 16:9 ratio example dimensions
                height: 900,
                imageSmoothingEnabled: true,
                imageSmoothingQuality: 'high',
            });
            
            // Convert to base64 string
            const croppedImage = canvas.toDataURL('image/jpeg');
            
            // Update preview
            document.getElementById('image-preview').src = croppedImage;
            
            // Store cropped image data
            document.getElementById('cropped-image').value = croppedImage;
            
            // Close modal
            closeCropperModal();
        }
    }

    // Close modal when clicking outside
    document.getElementById('cropperModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeCropperModal();
        }
    });
</script>

</body>
</html>