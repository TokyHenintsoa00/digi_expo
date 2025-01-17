@extends('parent.parentDirecteurEmp')
@section('choixContenuePourBrochureSection')



<div class="container mt-4">
    <h2 class="stand-title">Gerer votre contenue</h2>
    @if ($errors->any())
    <div class="alert alert-danger" role="alert">
        {{ $errors->first('error') }}
    </div>
    @endif

    @foreach ($contenue as $contenue_stand)
    <div class="stand-info">
        <h3 class="stand-name">Titre:{{ $contenue_stand->nom_info_type_stand }}<br>
            <h4>
                Stand:
                @foreach ($stand as $standbyId)
                    {{$standbyId->nom_stand}}
                @endforeach
            </h4>
        </h3>

        <p class="stand-description">Description:{{ $contenue_stand->description_info_type_stand }}</p>
        <div class="stand-images d-flex flex-wrap">
            @foreach (json_decode($contenue_stand->img_info_type_stand) as $image)
            <a href="{{ asset('assets/' . $image) }}" class="stand-image-link" target="_blank">
                <img src="{{ asset('assets/' . $image) }}" alt="Image du stand" class="stand-image img-thumbnail me-2" width="200" height="150">
            </a>
            @endforeach
        </div>
        <p class="stand-type"><strong>Type de contenue :</strong> {{ $contenue_stand->nom_type_stand }}</p>

        <div class="button-container">
            <!-- Ajouter une brochure button -->
            <form action="{{route('viewFormulaireAjoutBrochure')}}" method="GET">
                <input type="hidden" name="id_info_type_stand" value="{{$contenue_stand->id_info_type_stand}}">
                <input type="hidden" name="id_info_type_stand_desc" value="{{$contenue_stand->id_info_type_stand_desc}}">
                <input type="hidden" name="id_stand" value="{{$contenue_stand->id_stand}}">
                <input type="submit" value="Ajouter une brochure" class="btn btn-primary font-custom">
            </form>

            <!-- Modifier button -->
            <form action="{{route('viewFormulaireDeModificationBrochure')}}">
                <input type="hidden" name="id_info_type_stand" value="{{$contenue_stand->id_info_type_stand}}">
                <input type="submit" value="Modifier" class="btn btn-primary font-custom">
            </form>
        </div>
    </div>
    @endforeach
</div>

@endsection
