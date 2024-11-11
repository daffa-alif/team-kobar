<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
</head>
<body>
    <div style="display: flex; justify-content: center; align-items: center; height: 100vh;">
        <div>
            <h1>Welcome, {{ Auth::user()->name }}</h1>
            <div class="profile-section">
                @if(Auth::user()->profile_picture)
                    <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="Profile Picture" style="width: 100px; height: 100px; border-radius: 50%;">
                @endif
                <p>{{ Auth::user()->description }}</p>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
