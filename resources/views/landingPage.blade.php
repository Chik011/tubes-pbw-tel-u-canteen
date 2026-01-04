<x-layout>
<div class="container">
    <!-- HERO SECTION DENGAN BACKGROUND -->
    <div class="p-5 mb-5 rounded-4 text-white"
         style="
            background:
            linear-gradient(rgba(220,38,38,0.85), rgba(220,38,38,0.85)),
            url('https://images.unsplash.com/photo-1600891964599-f61ba0e24092');
            background-size: cover;
            background-position: center;
         ">

        <div class="row align-items-center">
            <div class="col-md-7">
                <h1 class="display-4 fw-bold">
                    Lapar di Telkom University?
                </h1>
                <p class="fs-5 mt-3">
                    Pesan makanan favoritmu dari kantin kampus tanpa antre.
                    Cepat, praktis, dan ramah di kantong mahasiswa.
                </p>

                @auth
                    <a href="{{ route('order') }}" class="btn btn-light btn-lg mt-3">
                        🍽 Pesan Sekarang
                    </a>
                @else
                    <a href="{{ route('order') }}" class="btn btn-light btn-lg mt-3">
                        🚀 Mulai Pesan
                    </a>
                @endauth
            </div>
        </div>
    </div>

    <!-- SECTION CARA PESAN -->
    <div class="py-5">

        <h2 class="fw-bold text-center mb-5" style="color: #dc3545;">Cara Pesan</h2>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 shadow-sm text-center border-0">
                    <div class="card-body">
                        <h1>📱</h1>
                        <h5 class="fw-bold mt-3">Pilih Menu</h5>
                        <p class="text-muted">
                            Cari makanan dari tenant favoritmu.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 shadow-sm text-center border-0">
                    <div class="card-body">
                        <h1>🛒</h1>
                        <h5 class="fw-bold mt-3">Pesan & Bayar</h5>
                        <p class="text-muted">
                            Pesan cepat tanpa antre panjang.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card h-100 shadow-sm text-center border-0">
                    <div class="card-body">
                        <h1>🍽</h1>
                        <h5 class="fw-bold mt-3">Ambil Makanan/Delivery</h5>
                        <p class="text-muted">
                            Ambil pesanan langsung di kantin atau Delivery.
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- CTA -->
    <div class="p-5 mt-5 bg-light rounded-4 text-center shadow-sm">
        <h2 class="fw-bold">Lapar? Jangan Antre.</h2>
        <p class="text-muted mb-4">
            Semua kantin Tel-U dalam satu platform
        </p>

        <a href="{{ route('order') }}" class="btn btn-danger btn-lg">
            Mulai Pesan 🍔
        </a>
    </div>
</div>
</x-layout>

