<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
</head>
<body>
    <h1>Edit Profile</h1>
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- This is used for PUT method to update -->
        <div>
            <label>Profile Picture:</label>
            <input type="file" name="profile_picture" accept="image/*">
        </div>
        <div>
            <label>Description:</label>
            <textarea name="description" placeholder="Update your description...">{{ Auth::user()->description }}</textarea>
        </div>
        <button type="submit">Update Profile</button>
    </form>
    <p><a href="{{ route('welcome') }}">Back to Welcome Page</a></p>
</body>
</html>
