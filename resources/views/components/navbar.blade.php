
<nav class="navbar navbar-expand-lg bg-light shadow-sm">
    <div class="container">
        <a class="navbar-brand" style="color: #dc3545; font-weight: bold;" href="/">🍽️ Kantin Tel-U</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link active" style="color: #dc3545; font-weight: bold;" aria-current="page" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" style="color: #dc3545;" href="/order">Pesan</a>
                </li>
                {{-- Only show History for non-admin users --}}
                @auth
                    @if(!auth()->user()->isAdmin())
                    <li class="nav-item">
                        <a class="nav-link" style="color: #dc3545;" href="/history">History</a>
                    </li>
                    @endif
                @else
                <li class="nav-item">
                    <a class="nav-link" style="color: #dc3545;" href="/history">History</a>
                </li>
                @endauth
                <li class="nav-item">
                    <a class="nav-link" style="color: #dc3545;" href="/location">Lokasi</a>
                </li>
                @auth
                    @if(auth()->user()->isAdmin())
                    <li class="nav-item">
                        <a class="nav-link" style="color: #dc3545;" href="/admin">Admin</a>
                    </li>
                    @endif
                @endauth
            </ul>
            <ul class="navbar-nav">
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" style="color: #dc3545;" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li>
                                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" style="color: #dc3545;" href="/login">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" style="color: #dc3545;" href="/register">Register</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

