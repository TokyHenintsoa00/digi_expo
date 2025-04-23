@extends('parent.parentHome')
@section('homePageSection')
<style>
    #map {
    width: 100%;
    height: 50vh; /* Réduit la hauteur de la carte à 80% de l'écran */

}
    #search-container {
        position: absolute;
        top: 10px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 1000;
        background: white;
        padding: 10px;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        display: flex;
        gap: 5px;
    }
    #search-input {
        padding: 8px;
        width: 250px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
    #search-button {
        padding: 8px;
        background: #001f54;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
    #search-button:hover {
        background: #001f54;
    }

    .card {
        position: relative; /* Nécessaire pour z-index */
        z-index: 2; /* Le formulaire sera devant */
        background-color: white; /* Pour que le fond soit opaque */
        padding: 20px; /* Espacement intérieur */
        border-radius: 8px; /* Bordures arrondies */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Ombre pour le contraste */
    }

    .organisateur-info {
        display: flex;
        justify-content: space-between; /* Sépare les éléments horizontalement */
        align-items: center; /* Aligne verticalement au centre */
    }

    .reste-jours {
        color: #001365;
        font-size: 1.2em; /* Ajustez la taille */
        font-weight: bold;
        margin: 0; /* Supprimez les marges par défaut */
    }


</style>
@php
    use Carbon\Carbon;
        $now = Carbon::now();
@endphp
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

<section class="organisateur-section py-5">
    <div class="container">
        @if (!isset($reception[0]->nom_du_sallon))
            <h2 class="mb-4 text-center">Nom de l'exposition : pas econre d'exposition</h2>
        @else
            <h2 class="mb-4 text-center">Nom de l'exposition : {{$reception[0]->nom_du_sallon}}</h2>
        @endif

        @foreach ($organisateur as $organisateur)
        <div class="organisateur-info bg-white p-4 rounded shadow-sm mb-4">
            <div>
                <h4 class="mb-3">{{ $organisateur->nom_organisateur }}</h4>
                <ul class="list-unstyled mb-0">
                    @foreach ($contact_organisateur as $contact)
                            <li class="mb-2">
                                <strong>{{ ucfirst($contact->type_contact) }} :</strong> {{ $contact->contact }}
                            </li>
                    @endforeach
                </ul>
                <ul>
                    <li>    
                        <strong>Lieu : </strong>{{$location_name}}
                    </li>
                </ul>
            </div>
            <div>
                <h2 class="reste-jours">
                    @if ($reste_jour == 0 || $reste_jour <0  )
                        En attente d'une nouvelle salon
                    @elseif ($now < $date_debut_salon)
                        Salon d'exposition en attente d'ouverture
                    @else
                        {{ $reste_jour }} jours restant
                    @endif

                </h2>
            </div>
        </div>
    @endforeach

    </div>
    <div id="map"></div>



</section>
<center>
    <h1>Liste des stand d'expositions</h1>

</center>

<div class="container-fluid">

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        {{-- @php
                            use Carbon\Carbon;
                        @endphp --}}
                        <!-- First row of 3 cards -->
                        <div class="row">

                            @if (empty($stand))
                                <p class="text-center">Aucun stand disponible pour le moment.</p>
                            @else
                                @foreach ($stand as $list_stand_success)
                                    {{-- @if (Carbon::parse($list_stand_success->date_fin_stand)->isAfter($date_fin_salon))

                                        <div class="col-md-4 mb-4">
                                            <div class="card transition-effect">
                                                <img src="../assets/{{$list_stand_success->img_stand}}" class="card-img-top" alt="...">
                                                <div class="card-body">
                                                    <h4 class="card-title">{{$list_stand_success->nom_stand}}</h4>
                                                    <p class="card-text">{{$list_stand_success->description_stand}}</p>
                                                    <p>Ce stand n'est plus disponible</p>
                                                </div>
                                            </div>
                                        </div>
                                    @else --}}

                                    @if ($reste_jour == 0)
                                        <div class="col-md-4 mb-4">
                                            <div class="card transition-effect">
                                                <img src="../assets/{{$list_stand_success->img_stand}}" class="card-img-top" alt="...">
                                                <div class="card-body">
                                                    <h4 class="card-title">{{$list_stand_success->nom_stand}}</h4>
                                                    <p class="card-text">{{$list_stand_success->description_stand}}</p>
                                                    <p>Ce stand n'est plus disponible</p>
                                                </div>
                                            </div>
                                        </div>
                                    @elseif ( Carbon::parse(now())->isAfter($list_stand_success->date_fin_stand) ||
                                                Carbon::parse($list_stand_success->date_fin_stand)->isAfter($date_fin_salon))
                                        <div class="col-md-4 mb-4">
                                            <div class="card transition-effect">
                                                <img src="../assets/{{$list_stand_success->img_stand}}" class="card-img-top" alt="...">
                                                <div class="card-body">
                                                    <h4 class="card-title">{{$list_stand_success->nom_stand}}</h4>
                                                    <p class="card-text">{{$list_stand_success->description_stand}}</p>
                                                    <p>Ce stand n'est plus disponible</p>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                    <div class="col-md-4 mb-4">
                                        <div class="card transition-effect">
                                            <img src="../assets/{{$list_stand_success->img_stand}}" class="card-img-top" alt="...">
                                            <div class="card-body">
                                                <h4 class="card-title">{{$list_stand_success->nom_stand}}</h4>
                                                <p class="card-text">{{$list_stand_success->description_stand}}</p>
                                            <form action="{{route('viewGestionContenueHome')}}" method="GET">
                                                    <input type="hidden" name="id_stand" value="{{$list_stand_success->id_stand}}">
                                                    <input type="submit" value="Voir les contenues" class="btn btn-primary">
                                            </form>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                @endforeach
                            @endif


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- <script>
     const map = L.map('map').setView([-18.8792, 47.5079], 12); // Antananarivo par défaut

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
}).addTo(map);

// Ajouter les marqueurs pour les lieux existants
const locations = @json($locations); // Passer les lieux existants à la vue

locations.forEach(location => {
    const marker = L.marker([location.latitude, location.longitude]).addTo(map);
    marker.bindPopup(`<b>${location.name}</b>`);
});
</script> --}}


<script>
   const map = new ol.Map({
            target: 'map',
            layers: [
                // Couche Satellite en HD (Optimisée)
                new ol.layer.Tile({
                    source: new ol.source.XYZ({
                        url: 'https://mt1.google.com/vt/lyrs=s&x={x}&y={y}&z={z}&scale=2&hl=fr',
                        crossOrigin: 'anonymous',
                        tilePixelRatio: 2 // Améliore la qualité sans ralentir
                    })
                }),
                // Couche Routes et Lieux en HD
                new ol.layer.Tile({
                    source: new ol.source.XYZ({
                        url: 'https://mt1.google.com/vt/lyrs=y&x={x}&y={y}&z={z}&scale=2&hl=fr',
                        crossOrigin: 'anonymous',
                        tilePixelRatio: 2
                    })
                })
            ],
            view: new ol.View({
                center: ol.proj.fromLonLat([47.5079, -18.8792]), // 📍 Tananarive
                zoom: 12,
                minZoom: 3,
                maxZoom: 19
            })
        });

        // const locations = @json($locations); // Passer les lieux existants à la vue

        // locations.forEach(location =>{
        //     const [lon,lat]= [locations.latitude,locations.longtude];
        // });

        // // Convertir la longitude/latitude en coordonnées
        // const coordinate = ol.proj.fromLonLat([lon, lat]);

        // const marker = new ol.Feature({
        //             geometry: new ol.geom.Point(coordinate),
        // });


        // // Définir le style du marqueur avec une icône
        // marker.setStyle(new ol.style.Style({
        //             image: new ol.style.Icon({
        //                 anchor: [0.5, 1], // Centre l'icône sur le point cliqué
        //                 src: 'https://maps.google.com/mapfiles/ms/icons/red-dot.png', // Icône de Google Maps
        //                 scale: 1 // Taille normale
        //             })
        // }));


        //  // Ajouter le marqueur à la source vectorielle
        //  const markerLayer = new ol.layer.Vector({
        //     source: new ol.source.Vector({
        //         features: [marker]
        //     })
        // });

        // // Ajouter la couche à la carte
        // map.addLayer(markerLayer);

            // Récupérer les données de localisation depuis Laravel
    const locations = @json($locations); // Assurez-vous que $locations contient un tableau de lieux avec lat et long

// Boucle sur les lieux et ajoute un marqueur pour chaque position
locations.forEach(location => {
    const [lat, lon] = [location.latitude, location.longitude]; // Assurez-vous que les clés sont correctes

    // Convertir la longitude/latitude en coordonnées
    const coordinate = ol.proj.fromLonLat([lon, lat]);

    // Créer un marqueur pour chaque position
    const marker = new ol.Feature({
        geometry: new ol.geom.Point(coordinate),
    });

    // Définir le style de l'icône du marqueur
    marker.setStyle(new ol.style.Style({
        image: new ol.style.Icon({
            anchor: [0.5, 1], // Centre l'icône
            src: 'https://maps.google.com/mapfiles/ms/icons/red-dot.png', // Icône de Google Maps
            scale: 1 // Ajuste la taille de l'icône
        })
    }));

    // Ajouter le marqueur à la source vectorielle
    const markerLayer = new ol.layer.Vector({
        source: new ol.source.Vector({
            features: [marker]
        })
    });

    // Ajouter la couche à la carte
    map.addLayer(markerLayer);
});


</script>

@endsection
