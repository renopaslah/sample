@extends('layouts.app')

@section('content')
    <div class="row row-deck row-cards">
        <div class="col-md-12">
            <div id="map" style="height: 400px;"></div>
        </div>
    </div>
@endsection

@push('scripts')
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <script>
        // Inisialisasi map (akan diganti setelah dapat lokasi)
        var map = L.map('map').setView([0, 0], 13);

        // Tambahkan tile dari OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        // Dapatkan lokasi dari browser
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var lat = position.coords.latitude;
                var lon = position.coords.longitude;

                // Update peta ke lokasi pengguna
                map.setView([lat, lon], 15);

                // Tambahkan marker
                L.marker([lat, lon])
                    .addTo(map)
                    .bindPopup("Anda di sini 📍")
                    .openPopup();
            }, function(error) {
                alert("Gagal mendapatkan lokasi: " + error.message);
            });
        } else {
            alert("Geolocation tidak didukung di browser ini.");
        }
    </script>
@endpush

