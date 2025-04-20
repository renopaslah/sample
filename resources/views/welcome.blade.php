@extends('layouts.app')

@section('content')
    <div class="row row-deck row-cards">
        <div class="col-md-6">
            <div id="map" class="ratio ratio-16x9"></div>
        </div>
    </div>
@endsection

@push('scripts')
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <script>
        // Inisialisasi peta dengan view default
        var map = L.map('map').setView([0, 0], 2);

        // Tambahkan tile layer (OpenStreetMap)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Fungsi untuk menangani sukses mendapatkan lokasi
        function onLocationFound(e) {
            var radius = e.accuracy / 2;

            // Buat marker untuk lokasi pengguna
            L.marker(e.latlng).addTo(map)
                .bindPopup("Anda berada dalam " + radius.toFixed(2) + " meter dari titik ini").openPopup();

            // Buat circle untuk menunjukkan akurasi
            L.circle(e.latlng, radius).addTo(map);

            // Set view ke lokasi pengguna
            map.setView(e.latlng, 15);
        }

        // Fungsi untuk menangani error mendapatkan lokasi
        function onLocationError(e) {
            alert("Gagal mendapatkan lokasi Anda: " + e.message);
        }

        // Daftarkan event handlers
        map.on('locationfound', onLocationFound);
        map.on('locationerror', onLocationError);

        // Coba dapatkan lokasi
        map.locate({
            setView: true,
            maxZoom: 16
        });
    </script>
@endpush
