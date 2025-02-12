{{-- @extends('parent.ParentAdmin')
@section('creationSalonAdminSection')
<style>
    #map {
        height: 400px;
        margin-bottom: 20px;
    }
</style>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header">
                <strong class="card-title">Formulaire pour création du salon</strong>
            </div>
            <div class="card-body">
                <!-- Afficher le message de succès -->
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

                <form action="{{route('creationSalonV1')}}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Première ligne : Nom du salon et Nom organisateur -->
                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                            <label for="nomSalon">Nom du salon</label>
                            <input type="text" name="nom_salon" id="nomSalon" class="form-control">
                        </div>

                        <div class="col-md-6 form-group mb-3">
                            <label for="nomOrganisateur">Nom organisateur</label>
                            <input type="text" name="nom_organisateur" id="nomOrganisateur" class="form-control">
                        </div>
                    </div>

                    <!-- Deuxième ligne : Nombre de contacts et Date de début -->
                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                            <label for="nombreContact">Nombre de contacts</label>
                            <input type="number" name="nombre_contacts" id="nombreContact" class="form-control" min="1" oninput="generateInputs()">
                        </div>

                        <div class="col-md-6 form-group mb-3">
                            <label for="dateDebut">Date de début</label>
                            <input type="date" name="date_debut" id="dateDebut" class="form-control" required>
                        </div>
                    </div>

                    <!-- Troisième ligne : Date de fin et Nom du lieu -->
                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                            <label for="dateFin">Date de fin</label>
                            <input type="date" name="date_fin" id="dateFin" class="form-control" required>
                        </div>

                        <div class="col-md-6 form-group mb-3">
                            <label for="name" class="form-label">Nom du lieu</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                    </div>

                    <!-- Map -->
                    <div class="form-group mb-3">
                        <div id="map"></div>
                        <input type="hidden" id="latitude" name="latitude">
                        <input type="hidden" id="longitude" name="longitude">
                    </div>

                    <!-- Bouton -->
                    <div class="row">
                        <div class="col-md-12 text-end">
                            <button type="submit" class="btn btn-primary">Ajouter</button>
                        </div>
                    </div>
                </form>

                <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
            </div> <!-- /. card-body -->
        </div> <!-- /. card -->
    </div> <!-- /. col -->
</div> <!-- /. end-section -->



<script>
    function generateInputs() {
        const container = document.getElementById('dynamicInputsContainer');
        const count = document.getElementById('nombreContact').value;

        // Vider le conteneur
        container.innerHTML = '';

        for (let i = 1; i <= count; i++) {
            const row = document.createElement('div');
            row.className = 'form-row mb-3 align-items-center';

            // Titre pour chaque champ (Nom et Contact)
            const col = document.createElement('div');
            col.className = 'form-group col-md-12 d-flex justify-content-between';

            // Champ pour le nom
            const inputNomWrapper = document.createElement('div');
            inputNomWrapper.className = 'col-md-5';

            const labelNom = document.createElement('label');
            labelNom.innerHTML = `Nom contact ${i}`;
            inputNomWrapper.append(labelNom);

            const inputNom = document.createElement('input');
            inputNom.type = 'text';
            inputNom.name = `contact[${i}][nom]`;
            inputNom.placeholder = `Nom contact ${i}`;
            inputNom.className = 'form-control';
            inputNomWrapper.append(inputNom);

            // Champ pour le contact
            const inputContactWrapper = document.createElement('div');
            inputContactWrapper.className = 'col-md-5';

            const labelContact = document.createElement('label');
            labelContact.innerHTML = `Contact ${i}`;
            inputContactWrapper.append(labelContact);

            const inputContact = document.createElement('input');
            inputContact.type = 'text';
            inputContact.name = `contact[${i}][contact]`;
            inputContact.placeholder = `Contact ${i}`;
            inputContact.className = 'form-control';
            inputContactWrapper.append(inputContact);

            // Ajouter les colonnes à la ligne
            col.appendChild(inputNomWrapper);
            col.appendChild(inputContactWrapper);

            // Ajouter la ligne au conteneur
            row.appendChild(col);
            container.appendChild(row);
        }
    }


    const map = L.map('map').setView([-18.8792, 47.5079], 12); // Antananarivo par défaut

    L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
    attribution: '&copy; <a href="https://www.esri.com/">Esri</a>',
    maxZoom: 19,
}).addTo(map);




    // Ajouter un marqueur au clic
    let marker;

    map.on('click', function (e) {
    const { lat, lng } = e.latlng;

    //exisite

    marker = L.marker(e.latlng).addTo(map);
    document.getElementById('latitude').value = lat;
    document.getElementById('longitude').value = lng;
    });


</script>

@endsection --}}

{{-- @extends('parent.ParentAdmin')
@section('creationSalonAdminSection')
<style>
    #map {
        height: 400px;
        margin-bottom: 20px;
    }
</style>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

<div class="row">
    <div class="col-md-12">
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

                <form action="{{route('creationSalonV1')}}" method="POST" enctype="multipart/form-data">
                    @csrf

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
                            <label for="dateDebut">Date de début</label>
                            <input type="date" name="date_debut" id="dateDebut" class="form-control" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                            <label for="dateFin">Date de fin</label>
                            <input type="date" name="date_fin" id="dateFin" class="form-control" required>
                        </div>

                        <div class="col-md-6 form-group mb-3">
                            <label for="name">Nom du lieu</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <div id="map"></div>
                        <input type="hidden" id="latitude" name="latitude">
                        <input type="hidden" id="longitude" name="longitude">
                    </div>

                    <div id="dynamicInputsContainer"></div>

                    <div class="row">
                        <div class="col-md-12 text-end">
                            <button type="submit" class="btn btn-primary">Ajouter</button>
                        </div>
                    </div>
                </form>

                <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
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
                <div class="form-group col-md-6">
                    <label>Nom contact ${i}</label>
                    <input type="text" name="contact[${i}][nom]" class="form-control" placeholder="Nom contact ${i}">
                </div>
                <div class="form-group col-md-6">
                    <label>Contact ${i}</label>
                    <input type="text" name="contact[${i}][contact]" class="form-control" placeholder="Contact ${i}">
                </div>
            `;

            container.appendChild(row);
        }
    }

    const map = L.map('map').setView([-18.8792, 47.5079], 12);

    const satelliteLayer = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
        attribution: '&copy; <a href="https://www.esri.com/">Esri</a>',
        maxZoom: 19,
    });

    const labelsLayer = L.tileLayer('https://{s}.basemaps.cartocdn.com/light_only_labels/{z}/{x}/{y}{r}.png', {
        attribution: '&copy; <a href="https://carto.com/">CARTO</a>',
        maxZoom: 19,
    });

    satelliteLayer.addTo(map);
    labelsLayer.addTo(map);

    let marker;
    map.on('click', function (e) {
        const { lat, lng } = e.latlng;

        if (marker) {
            map.removeLayer(marker);
        }

        marker = L.marker(e.latlng).addTo(map);
        document.getElementById('latitude').value = lat;
        document.getElementById('longitude').value = lng;
    });

</script>

@endsection --}}

@extends('parent.ParentAdmin')
@section('creationSalonAdminSection')
<style>
    #map {
        height: 400px;
        margin-bottom: 20px;
        position: relative; /* Nécessaire pour z-index */
        z-index: 1; /* La carte sera derrière */
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
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

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

                <form action="{{route('creationSalonV1')}}" method="POST" enctype="multipart/form-data">
                    @csrf

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




                    <div class="form-group mb-3">
                        <div id="map"></div>
                        <input type="hidden" id="latitude" name="latitude">
                        <input type="hidden" id="longitude" name="longitude">
                    </div>



                    <div class="row">
                        <div class="col-md-12 text-end">
                            <button type="submit" class="btn btn-primary">Ajouter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
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

    //map
    //-------------------------------------------------------------------------------
    // const map = L.map('map').setView([-18.8792, 47.5079], 12);

    // const satelliteLayer = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
    //     attribution: '&copy; <a href="https://www.esri.com/">Esri</a>',
    //     maxZoom: 19,
    // });

    // const labelsLayer = L.tileLayer('https://{s}.basemaps.cartocdn.com/light_only_labels/{z}/{x}/{y}{r}.png', {
    //     attribution: '&copy; <a href="https://carto.com/">CARTO</a>',
    //     maxZoom: 19,
    // });

    // satelliteLayer.addTo(map);
    // labelsLayer.addTo(map);

    // let marker;
    // map.on('click', function (e) {
    //     const { lat, lng } = e.latlng;

    //     if (marker) {
    //         map.removeLayer(marker);
    //     }

    //     marker = L.marker(e.latlng).addTo(map);
    //     document.getElementById('latitude').value = lat;
    //     document.getElementById('longitude').value = lng;
    // });


    //----------------------------------------------------------------------------------------
</script>

@endsection