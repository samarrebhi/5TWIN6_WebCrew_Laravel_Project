@extends('Front/layout')

@section('content')
<div class="container my-5" style="padding-top: 120px;"> 
    <h2 class="text-center mb-4">Recycling Centers Map</h2>

    <!-- Carte Leaflet -->
    <div id="map" style="height: 500px;"></div>
</div>
@endsection

@section('scripts')
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <script>
        // Initialisation de la carte
        var map = L.map('map').setView([33.8869, 9.5375], 6); // Centrer sur la Tunisie

        // Ajout des tuiles OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Récupération des centres en JSON depuis la base de données
        var centers = @json($centers); // Assurez-vous d'utiliser 'centers'

        // Ajout de marqueurs pour chaque centre
        centers.forEach(function(center) {
            if (center.latitude && center.longitude) {
                L.marker([center.latitude, center.longitude]).addTo(map)
                    .bindPopup('<strong>' + center.name + '</strong><br>' + center.address);
            }
        });
    </script>
@endsection
