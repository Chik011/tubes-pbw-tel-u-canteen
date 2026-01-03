<x-layout>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .auth-card {
            border: none;
            box-shadow: 0 4px 10px rgba(0,0,0,0.08);
            border-radius: 12px;
        }

        .auth-header {
            background-color: #dc3545;
            color: white;
            border-radius: 12px 12px 0 0 !important;
        }

        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-danger:hover {
            background-color: #c82333;
            border-color: #c82333;
        }

        .auth-link {
            color: #dc3545;
            text-decoration: none;
            font-weight: 600;
        }

        .auth-link:hover {
            color: #c82333;
            text-decoration: underline;
        }
    </style>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card auth-card">
                    <div class="card-header auth-header py-3">
                        <h3 class="mb-0 text-center">Login</h3>
                    </div>
                    <div class="card-body p-4">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label fw-bold">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-4">
                                <label for="password" class="form-label fw-bold">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-danger w-100 py-2">Login</button>
                        </form>
                        <p class="mt-4 text-center">
                            Belum punya akun? 
                            <a href="{{ route('register') }}" class="auth-link">Daftar di sini</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>

