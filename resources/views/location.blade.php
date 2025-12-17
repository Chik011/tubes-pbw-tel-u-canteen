<x-layout>
    <div class="container-fluid px-0 mt-5">

        <!-- Header -->
        <div class="container mb-4">
            <h1 class="text-center fw-bold">Lokasi Kantin Tel U</h1>
            <p class="text-center text-muted">
                Temukan seluruh kantin & tenant di area Kampus Telkom University
            </p>
        </div>

        <!-- MAP FULL WIDTH (ALA McD) -->
        <div class="w-100" style="height: 600px;">
            <div id="map" style="width: 100%; height: 100%;"></div>
        </div>

        <!-- INFORMASI BAWAH -->
        <div class="container mt-5">
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3">Informasi Lokasi</h5>
                            <p><strong>Alamat:</strong><br>
                                Kampus Telkom University<br>
                                Jl. Telekomunikasi No.1, Bandung, Jawa Barat 40257
                            </p>

                            <p class="mb-1"><strong>Jam Operasional:</strong></p>
                            <ul>
                                <li>Senin – Jumat: 07:00 – 17:00</li>
                                <li>Sabtu: 08:00 – 15:00</li>
                                <li>Minggu: Tutup</li>
                            </ul>

                            <p><strong>Kontak:</strong> +62 21 1234 567</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3">Fasilitas Kantin</h5>
                            <ul>
                                <li>🍽️ Area makan indoor & outdoor (±200 orang)</li>
                                <li>🅿️ Area parkir luas</li>
                                <li>📶 WiFi kampus</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Leaflet CSS & JS -->
    <link
        rel="stylesheet"
        href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <!-- Map Script -->
    <script>
        // Center Telkom University
        const map = L.map('map').setView([-6.9737, 107.6316], 15);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        // Custom icon
        const kantinIcon = L.icon({
            iconUrl: 'https://cdn-icons-png.flaticon.com/512/3075/3075977.png',
            iconSize: [38, 38],
            iconAnchor: [19, 38],
            popupAnchor: [0, -32]
        });

        // Data kantin (dummy – nanti bisa dari DB)
                const kantinList = [
            {
                name: 'Kantin Asrama Putra',
                lat: -6.9701161,
                lng: 107.6275168
            },
            {
                name: 'Kantin Asrama Putri',
                lat: -6.9743933,
                lng: 107.629055
            },
            {
                name: 'Kantin TULT',
                lat: -6.9694507,
                lng: 107.6281158
            },
            {
                name: 'Kantin FIT',
                lat: -6.9732719,
                lng: 107.6324709
            },
            {
                name: 'Kantin FIK',
                lat: -6.9724321,
                lng: 107.631631
            },
            {
                name: 'Kantin FEB',
                lat: -6.9718885,
                lng: 107.6325829
            }
        ];


        kantinList.forEach(kantin => {
            L.marker([kantin.lat, kantin.lng], { icon: kantinIcon })
                .addTo(map)
                .bindPopup(
                    `<strong>${kantin.name}</strong><br>Telkom University`
                );
        });
    </script>
</x-layout>
