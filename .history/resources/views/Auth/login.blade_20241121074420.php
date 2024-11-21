<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center">
    <div class="bg-white shadow-lg rounded-lg flex w-3/4 overflow-hidden">
        <!-- Left Side with Image -->
        <div class="w-1/2 hidden md:block">
            <img 
                src="https://via.placeholder.com/600x400" 
                alt="Login Illustration" 
                class="h-full w-full object-cover"
            >
        </div>
        <!-- Right Side with Login Form -->
        <div class="w-full md:w-1/2 p-8 flex flex-col justify-center">
            <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Login</h1>
            <form action="{{ route('login') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Email:</label>
                    <input 
                        type="email" 
                        name="email" 
                        required 
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                    >
                </div>
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Password:</label>
                    <input 
                        type="password" 
                        name="password" 
                        required 
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                    >
                </div>
                <button 
                    type="submit" 
                    class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition"
                >
                    Login
                </button>
            </form>
            <p class="mt-4 text-center text-gray-600">
                Don't have an account? 
                <a href="{{ route('register') }}" class="text-blue-500 hover:underline">Register here</a>
            </p>
        </div>
    </div>
</body>
</html>
