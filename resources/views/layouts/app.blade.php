<!DOCTYPE html>
<html lang="en">
<head>
    <title>Diary Journal</title>
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <ul>
        <li><a href="{{route('journal.index')}}">Home</a></li>
        <li><a href="#">Albums</a></li>
        <li><a href="{{route('journal.create')}}">Upload</a></li>
        <li><a href="#">Profile</a></li>
        </ul>
    @yield('content')
</body>
</html>