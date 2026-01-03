<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Tubes PBW Tel U Canteen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <x-navbar />

    <main>
        {{ $slot }}
    </main>

    <footer class="bg-white mt-5 pt-4 border-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
                    <h5 class="text-uppercase fw-bold" style="color: #dc3545;">🍽️ Tel U Canteen</h5>
                    <p class="small text-muted">
                        Kantin Universitas Telkom menyediakan berbagai makanan dan minuman untuk mahasiswa dan staf. Nikmati pengalaman makan yang nyaman dan terjangkau.
                    </p>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h6 class="text-uppercase fw-bold">Tautan</h6>
                    <ul class="list-unstyled mb-0">
                        <li><a href="/" class="text-dark text-decoration-none small">Beranda</a></li>
                        <li><a href="/order" class="text-dark text-decoration-none small">Pesan</a></li>
                        <li><a href="/location" class="text-dark text-decoration-none small">Lokasi</a></li>
                        <li><a href="/history" class="text-dark text-decoration-none small">Riwayat</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h6 class="text-uppercase fw-bold">Kontak</h6>
                    <ul class="list-unstyled">
                        <li class="small text-muted">Email: info@telucanteen.com</li>
                        <li class="small text-muted">Telepon: +62 21 1234 567</li>
                        <li class="small text-muted">Alamat: Kampus Telkom University</li>
                    </ul>
                </div>
            </div>
            <hr>
            <div class="text-center pb-3">
                <small class="text-muted">© 2025 Tel U Canteen. Copy Right Tubes PBW.</small>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

