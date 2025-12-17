
<x-layout>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .page-title {
            font-weight: bold;
            color: #dc3545;
        }

        .menu-card img {
            height: 220px;
            object-fit: cover;
        }

        .menu-card {
            border: none;
            box-shadow: 0 4px 10px rgba(0,0,0,0.08);
        }

        .menu-card .card-body {
            text-align: center;
        }

        .btn-outline-danger {
            font-weight: 600;
        }

        .cart-card {
            border: none;
            box-shadow: 0 4px 10px rgba(0,0,0,0.08);
        }

        .cart-header {
            background-color: #dc3545;
            color: white;
            font-weight: bold;
            text-align: center;
        }
    </style>

    <div class="container my-5">
        <h1 class="text-center mb-5 page-title">Pesan Makanan</h1>

        <div class="row g-4">
            <!-- MENU -->
            <div class="col-lg-8">
                <div class="row g-4">

                    <!-- ITEM -->
                    <div class="col-md-6">
                        <div class="card menu-card">
                            <img src="{{ asset('img/naci_oyeng.jpeg') }}" class="card-img-top">
                            <div class="card-body">
                                <h5>Nasi Goreng</h5>
                                <p class="text-muted">Nasi goreng spesial dengan telur dan ayam.</p>
                                <p class="fw-bold">Rp 15.000</p>
                                <button class="btn btn-outline-danger w-100">
                                    Tambah ke Keranjang
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card menu-card">
                            <img src="{{ asset('img/ayam_bakar.jpeg') }}" class="card-img-top">
                            <div class="card-body">
                                <h5>Ayam Bakar</h5>
                                <p class="text-muted">Ayam bakar dengan bumbu rempah.</p>
                                <p class="fw-bold">Rp 20.000</p>
                                <button class="btn btn-outline-danger w-100">
                                    Tambah ke Keranjang
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card menu-card">
                            <img src="{{ asset('img/sate_ayam.jpeg') }}" class="card-img-top">
                            <div class="card-body">
                                <h5>Sate Ayam</h5>
                                <p class="text-muted">Sate ayam dengan bumbu kacang.</p>
                                <p class="fw-bold">Rp 18.000</p>
                                <button class="btn btn-outline-danger w-100">
                                    Tambah ke Keranjang
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card menu-card">
                            <img src="{{ asset('img/bakso.jpeg') }}" class="card-img-top">
                            <div class="card-body">
                                <h5>Bakso</h5>
                                <p class="text-muted">Bakso daging sapi dengan mie.</p>
                                <p class="fw-bold">Rp 12.000</p>
                                <button class="btn btn-outline-danger w-100">
                                    Tambah ke Keranjang
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- KERANJANG -->
            <div class="col-lg-4">
                <div class="card cart-card sticky-top" style="top:100px;">
                    <div class="card-header cart-header">
                        🛒 Keranjang Belanja
                    </div>

                    <div class="card-body text-center">
                        <p class="text-muted mb-4">
                            Keranjang masih kosong
                        </p>

                        <button class="btn btn-outline-danger w-100">
                            Checkout
                        </button>

                        <small class="d-block mt-2 text-muted">
                            Tambahkan menu untuk melanjutkan
                        </small>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-layout>
