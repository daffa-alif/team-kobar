<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Additional mobile-specific adjustments */
        @media (max-width: 640px) {
            .register-image {
                display: none; /* Hide the image for small screens */
            }
            .register-form {
                width: 100%; /* Full width for mobile */
                padding: 2rem; /* Add padding for better spacing */
            }
        }
    </style>
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center">
    <div class="w-full h-full flex">
        <!-- Left Side with Register Form -->
        <div class="register-form w-full md:w-1/2 p-12 flex flex-col justify-center bg-white">
            <h1 class="text-4xl font-bold text-gray-800 mb-6 text-center">Register</h1>
            <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Name:</label>
                    <input 
                        type="text" 
                        name="name" 
                        required 
                        class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                    >
                </div>
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Email:</label>
                    <input 
                        type="email" 
                        name="email" 
                        required 
                        class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                    >
                </div>
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Password:</label>
                    <input 
                        type="password" 
                        name="password" 
                        required 
                        class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                    >
                </div>
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Confirm Password:</label>
                    <input 
                        type="password" 
                        name="password_confirmation" 
                        required 
                        class="w-full px-4 py-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                    >
                </div>
                <button 
                    type="submit" 
                    class="w-full bg-blue-500 text-white py-3 rounded-lg hover:bg-blue-600 transition"
                >
                    Register
                </button>
            </form>
            <p class="mt-6 text-center text-gray-600">
                Already have an account? 
                <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Login here</a>
            </p>
        </div>
        <!-- Right Side with Image -->
        <div class="register-image w-1/2 bg-cover bg-center" style="background-image: url('https://via.placeholder.com/800x600');">
            <!-- The image will cover the right side and adjust automatically -->
        </div>
    </div>
</body>
</html>
