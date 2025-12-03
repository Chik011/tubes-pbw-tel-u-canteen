<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
    <a href="/">Landing page</a> <br>

    <h1>Ini Halaman Admin</h1>
    <p>Selamat datang, {{ Auth::user()->name }}!</p>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn btn-danger">Logout</button>
    </form>
</body>
</html>
