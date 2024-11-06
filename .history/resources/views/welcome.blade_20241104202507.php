<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
</head>
<body>
    <div style="display: flex; justify-content: center; align-items: center; height: 100vh;">
        <div style="text-align: center;">
            <h1>Profile</h1>
            <div class="profile-section">
                @if(Auth::user()->profile_picture)
                    <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="Profile Picture" style="width: 100px; height: 100px; border-radius: 50%;">
                @else
                    <img src="{{ asset('images/default-profile.png') }}" alt="Default Profile Picture" style="width: 100px; height: 100px; border-radius: 50%;">
                @endif

                <h2>{{ Auth::user()->name }}</h2>

                <p>
                    {{ Auth::user()->description ? Auth::user()->description : 'No description available.' }}
                </p>

                <div>
                    <a href="{{ route('Auth.edit') }}">Edit Profile</a>
                </div>

                <form action="{{ route('logout') }}" method="POST" style="margin-top: 20px;">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
