<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
</head>
<body>
    <h1>Selamat Datang di Tubes PBW Tel U Canteen</h1>
    <p>Ini adalah halaman landing page.</p>

    @if(Auth::check())
        <p>Halo, {{ Auth::user()->name }}! 
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" style="border: none; background: none; color: blue; text-decoration: underline; cursor: pointer;">Logout</button>
            </form>
        </p>
        <a href="/admin">Ke Admin Dashboard</a>
    @else
        <a href="{{ route('login') }}">Login</a> | <a href="{{ route('register') }}">Register</a>
    @endif
</body>
</html>
