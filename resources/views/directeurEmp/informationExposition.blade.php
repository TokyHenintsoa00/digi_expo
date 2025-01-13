@extends('parent.parentDirecteurEmp')
@section('informationExpositionSection')

<h1>Information de l'exposition</h1>

<div class="row">
    @foreach ($getStandById as $list_getStandById)

    <div class="col-md-12 mb-4">
        <div class="card p-3 transition-effect d-flex flex-row align-items-center">
            <!-- Image à gauche -->
            <img src="../assets/{{$list_getStandById->img_stand}}" class="img-fluid rounded me-3" alt="..." style="width: 150px; height: 150px; object-fit: cover;">
            <!-- Contenu à droite -->
            <div>
                <h4 class="card-title mb-2">{{$list_getStandById->nom_stand}}</h4>
                <p class="card-text">{{$list_getStandById->description_stand}}</p>
            </div>
        </div>
    </div>

    @endforeach
</div>

@endsection
