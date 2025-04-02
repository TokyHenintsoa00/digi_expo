

@extends('parent.ParentAdmin')
@section('creationSalonAdminSection')

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
</style>

<div class="row">
    <div class="col-md-12">
        <!-- Carte en arrière-plan -->


        <!-- Formulaire par-dessus la carte -->
        <div class="card shadow mb-4">
            <div class="card-header">
                <strong class="card-title">Formulaire pour création du salon</strong>
            </div>
            <div class="card-body">
                @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {!! session('success') !!}
                </div>
                @endif
                @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    {{ $errors->first('error') }}
                </div>
                @endif

                <div class="form-group mb-3">

                    <input type="text" id="search-input" placeholder="Rechercher un lieu..." >
                    <button id="search-button">🔍</button>
                        <br>
                        <br>
                    <div id="map"></div>

                </div>


                <form action="{{route('creationSalonV1')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="latitude" name="latitude">
                    <input type="hidden" id="longitude" name="longitude">
                    <div class="row">

                        <div class="col-md-6 form-group mb-3">
                            <label for="dateDebut">Date de début</label>
                            <input type="date" name="date_debut" id="dateDebut" class="form-control" required>
                        </div>

                        <div class="col-md-6 form-group mb-3">
                            <label for="dateFin">Date de fin</label>
                            <input type="date" name="date_fin" id="dateFin" class="form-control" required>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                            <label for="nomSalon">Nom du salon</label>
                            <input type="text" name="nom_salon" id="nomSalon" class="form-control" required>
                        </div>

                        <div class="col-md-6 form-group mb-3">
                            <label for="nomOrganisateur">Nom organisateur</label>
                            <input type="text" name="nom_organisateur" id="nomOrganisateur" class="form-control" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                            <label for="nombreContact">Nombre de contacts</label>
                            <input type="number" name="nombre_contacts" id="nombreContact" class="form-control" min="1" oninput="generateInputs()">
                        </div>


                        <div class="col-md-6 form-group mb-3">
                            <label for="name">Nom du lieu</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>


                    </div>
                    <div id="dynamicInputsContainer" ></div>

                    <h2>Plan des Places</h2>
    <div class="grid" id="plan"></div>

    <script>
        const places = [
            { id: 1, status: 'available' }, { id: 2, status: 'occupied' },
            { id: 3, status: 'available' }, { id: 4, status: 'available' },
            { id: 5, status: 'occupied' }, { id: 6, status: 'available' },
            { id: 7, status: 'available' }, { id: 8, status: 'occupied' },
            { id: 9, status: 'available' }, { id: 10, status: 'available' }
        ];

        const planContainer = document.getElementById('plan');

        function renderPlaces() {
            planContainer.innerHTML = '';
            places.forEach(place => {
                const div = document.createElement('div');
                div.classList.add('place', place.status);
                div.innerText = `P${place.id}`;
                div.onclick = () => toggleStatus(place);
                planContainer.appendChild(div);
            });
        }

        function toggleStatus(place) {
            if (place.status === 'available') {
                place.status = 'occupied';
            } else {
                place.status = 'available';
            }
            renderPlaces();
        }

        renderPlaces();
    </script>

                    <div class="row">
                        <div class="col-md-12 text-end">
                            <input type="submit" class="btn btn-primary" value="Ajouter"></input>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function generateInputs() {
        const container = document.getElementById('dynamicInputsContainer');
        const count = document.getElementById('nombreContact').value;

        container.innerHTML = '';

        for (let i = 1; i <= count; i++) {
            const row = document.createElement('div');
            row.className = 'form-row mb-3';

            row.innerHTML = `
            <div class="row">

                <div class="col-md-6 form-group mb-3">
                    <label>Nom contact ${i}</label>
                    <input type="text" name="contact[${i}][nom]" class="form-control" placeholder="Nom contact ${i}">
                </div>
                <div class="col-md-6 form-group mb-3">
                    <label>Contact ${i}</label>
                    <input type="text" name="contact[${i}][contact]" class="form-control" placeholder="Contact ${i}">
                </div>
            </div>
            `;

            container.appendChild(row);
        }
    }

     // Initialisation de la carte avec OpenLayers
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

        // Fonction de recherche rapide avec async/await
        document.getElementById('search-button').addEventListener('click', async function() {
            const query = document.getElementById('search-input').value;
            if (!query) return;

            document.getElementById('search-button').textContent = "🔎 Recherche...";

            try {
                let response = await fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}`);
                let data = await response.json();

                if (data.length > 0) {
                    const lat = parseFloat(data[0].lat);
                    const lon = parseFloat(data[0].lon);

                    map.getView().animate({
                        center: ol.proj.fromLonLat([lon, lat]),
                        zoom: 15,
                        duration: 800
                    });

                } else {
                    alert('Lieu non trouvé');
                }
            } catch (error) {
                console.error('Erreur de recherche:', error);
            }

            document.getElementById('search-button').textContent = "🔍";
        });

        let markerLayer; // Déclarer une couche pour le marqueur

        map.on('click', function (e) {
            console.log("Cliqué !");

            // Récupérer les coordonnées du clic
            const coordinate = e.coordinate;
            const [lon, lat] = ol.proj.toLonLat(coordinate);
            console.log(`Latitude: ${lat}, Longitude: ${lon}`);

            if (lat !== null && lon !== null) {
                // Supprimer le marqueur précédent s'il existe
                if (markerLayer) {
                    map.removeLayer(markerLayer);
                }

                // Créer un marqueur (Feature)
                const marker = new ol.Feature({
                    geometry: new ol.geom.Point(coordinate),
                });

                // Définir le style du marqueur avec une icône
                marker.setStyle(new ol.style.Style({
                    image: new ol.style.Icon({
                        anchor: [0.5, 1], // Centre l'icône sur le point cliqué
                        src: 'https://maps.google.com/mapfiles/ms/icons/red-dot.png', // Icône de Google Maps
                        scale: 1 // Taille normale
                    })
                }));

                // Ajouter le marqueur à une source vectorielle
                const vectorSource = new ol.source.Vector({
                    features: [marker]
                });

                // Créer une couche vectorielle et l'ajouter à la carte
                markerLayer = new ol.layer.Vector({
                    source: vectorSource
                });

                map.addLayer(markerLayer);


                document.getElementById('latitude').value = lat;
                document.getElementById('longitude').value = lon;
            }
        });


    //----------------------------------------------------------------------------------------
</script>

@endsection