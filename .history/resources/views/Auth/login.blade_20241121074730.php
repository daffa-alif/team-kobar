<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Additional mobile-specific adjustments */
        @media (max-width: 640px) {
            .login-image {
                display: none; /* Hide the image for small screens */
            }
            .login-form {
                width: 100%; /* Full width for mobile */
                padding: 2rem; /* Add padding for better spacing */
            }
        }
    </style>
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center">
    <div class="w-full h-full flex">
        <!-- Left Side with Image -->
        <div class="login-image w-1/2 bg-cover bg-center" style="background-image: url('https://via.placeholder.com/800x600');">
            <!-- The image will cover the left side and adjust automatically -->
        </div>
        <!-- Right Side with Login Form -->
        <div class="login-form w-full md:w-1/2 p-12 flex flex-col justify-center bg-white">
            <h1 class="text-4xl font-bold text-gray-800 mb-6 text-center">Login</h1>
            <form action="{{ route('login') }}" method="POST" class="space-y-6">
                @csrf
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
                <button 
                    type="submit" 
                    class="w-full bg-blue-500 text-white py-3 rounded-lg hover:bg-blue-600 transition"
                >
                    Login
                </button>
            </form>
            <p class="mt-6 text-center text-gray-600">
                Don't have an account? 
                <a href="{{ route('register') }}" class="text-blue-500 hover:underline">Register here</a>
            </p>
        </div>
    </div>
</body>
</html>
