<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
</head>
<body>
    <h1>Welcome, {{ Auth::user()->name }}</h1>
    @if(Auth::user()->profile_picture)
        <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="Profile Picture" style="width: 100px; height: 100px;">
    @endif
    <p>{{ Auth::user()->description }}</p>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>
