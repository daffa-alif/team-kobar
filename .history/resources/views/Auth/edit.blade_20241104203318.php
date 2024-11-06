<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
</head>
<body>
    <h1>Edit Profile</h1>
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- Use PUT method for update -->
        <div>
            <label>Name:</label>
            <input type="text" name="name" value="{{ Auth::user()->name }}" required>
        </div>
        <div>
            <label>Email:</label>
            <input type="email" name="email" value="{{ Auth::user()->email }}" required>
        </div>
        <div>
            <label>Profile Picture (optional):</label>
            <input type="file" name="profile_picture" accept="image/*">
        </div>
        <div>
            <label>Description (optional):</label>
            <textarea name="description">{{ Auth::user()->description }}</textarea>
        </div>
        <button type="submit">Update Profile</button>
    </form>
    <p><a href="{{ route('welcome') }}">Back to Profile</a></p> <!-- Ensure this route is defined -->
    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif
</body>
</html>
