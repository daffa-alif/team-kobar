<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <h1>Register</h1>
    <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label>Name:</label>
            <input type="text" name="name" required>
        </div>
        <div>
            <label>Email:</label>
            <input type="email" name="email" required>
        </div>
        <div>
            <label>Password:</label>
            <input type="password" name="password" required>
        </div>
        <div>
            <label>Confirm Password:</label>
            <input type="password" name="password_confirmation" required>
        </div>
        <div>
            <label>Profile Picture:</label>
            <input type="file" name="profile_picture">
        </div>
        <div>
            <label>Description:</label>
            <textarea name="description"></textarea>
        </div>
        <button type="submit">Register</button>
    </form>
</body>
</html>
