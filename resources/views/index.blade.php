<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - Website Journal</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-transparent fixed w-full top-0 left-0 z-50 p-5">
        <div class="container mx-auto flex justify-between items-center">
            <!-- Logo -->
            <a href="/" class="text-white text-2xl font-bold">Journal</a>
            <!-- Navbar Links -->
            <div class="space-x-4">
                <a href="{{ route('login') }}" class="text-white hover:text-gray-300">Login</a>
                <a href="{{ route('register') }}" class="text-white hover:text-gray-300">Daftar</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section (Selamat Datang) -->
    <section class="min-h-screen flex items-center justify-center bg-cover bg-center relative" 
             style="background-image: url('https://source.unsplash.com/1600x900/?nature');">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="relative z-10 text-center text-white p-6">
            <!-- Background Glass Effect -->
            <div class="bg-white bg-opacity-20 backdrop-blur-lg rounded-lg p-10 max-w-lg mx-auto">
                <h1 class="text-4xl font-extrabold mb-4">Selamat datang di Website Journal!</h1>
                <p class="text-xl mb-6">Temukan dan tulis cerita-cerita luar biasa di jurnal kami.</p>
                <a href="{{ route('login') }}" 
                   class="bg-yellow-500 text-gray-900 py-2 px-6 rounded-full text-lg font-semibold hover:bg-yellow-400 transition">
                   Mulai Sekarang
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center py-6 mt-20">
        <div class="container mx-auto">
            <p class="text-sm">© 2024 Journal App. All Rights Reserved.</p>
            <p class="text-sm">Alamat: Jl. Contoh No. 123, Kota ABC</p>
        </div>
    </footer>

</body>

</html>
