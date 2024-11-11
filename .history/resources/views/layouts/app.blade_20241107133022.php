<!DOCTYPE html>
<html lang="en">
<head>
    <title>Diary Journal</title>
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>


    
</head>
<body>
    <ul>
        <li><a href="{{ route('journal.index') }}">Beranda</a></li>
        <li><a href="#">Albums</a></li>
        <li><a href="{{ route('journal.create') }}">Unggah</a></li>
        <li><a href="{{ route('profile.welcome') }}">Data </a></li>
    </ul>
    
    @yield('content')
</body>
</html>