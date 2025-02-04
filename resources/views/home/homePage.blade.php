@extends('parent.parentHome')
@section('homePageSection')
<style>
    #map {
        height: 400px;
        margin-bottom: 20px;
        position: relative; /* Nécessaire pour que z-index fonctionne */
        z-index: 1; /* Plus petit z-index = derrière */
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
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

<section class="organisateur-section py-5">
    <div class="container">
        <h2 class="mb-4 text-center">Informations de l'Organisateur</h2>
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
            </div>
            <div>
                <h2 class="reste-jours">
                    @if ($reste_jour == 0 || $reste_jour <0  )
                        En attente d'une nouvelle salon
                    @else
                        {{ $reste_jour }} jours restant
                    @endif

                </h2>
            </div>
        </div>
    @endforeach

    </div>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <div id="map"></div>
    <script>

    </script>


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
                        @php
                            use Carbon\Carbon;
                        @endphp
                        <!-- First row of 3 cards -->
                        <div class="row">
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
                                                <p>Ce stand n'est plus disponible1</p>
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
                                                <p>Ce stand n'est plus disponible2</p>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
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
</script>

@endsection
