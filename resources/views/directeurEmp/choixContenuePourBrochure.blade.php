{{-- @extends('parent.parentDirecteurEmp')
@section('choixContenuePourBrochureSection')

<style>
    .container {
        font-family: 'Arial', sans-serif;
        color: #333;
        padding: 20px;
        background-color: #f9f9f9;
    }

    .stand-title {
        font-size: 28px;
        font-weight: bold;
        color: #1a1a1a;
        margin-bottom: 30px;
        text-align: center;
        border-bottom: 2px solid #e3e3e3;
        padding-bottom: 10px;
    }

    .stand-info {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        margin-bottom: 30px;
    }

    .stand-name {
        font-size: 24px;
        color: #000000;
        font-weight: bold;
        margin-top: 0;
    }

    .stand-description {
        font-size: 16px;
        line-height: 1.6;
        margin: 15px 0;
        color: #555;
    }

    .stand-images {
        margin-top: 15px;
        gap: 15px;
        justify-content: center;
    }

    .stand-image-link {
        display: inline-block;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s ease;
    }

    .stand-image-link:hover {
        transform: scale(1.05);
    }

    .stand-image {
        width: auto;
    height: auto;
    max-width: 100%;
    max-height: 180px;
    object-fit: contain;
    border-radius: 4px;
    }
    body, h2, h3, label, p, input, button, {
        font-family: 'Plus Jakarta Sans', sans-serif;
    }



    .stand-date, .stand-type {
        font-size: 15px;
        color: #777;
        margin-top: 10px;
    }

    .stand-date strong, .stand-type strong {
        color: #000000;
    }

    .font-custom {
        font-family: 'Plus Jakarta Sans', sans-serif;
    }
    </style>
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
                        @foreach ($stand  as $standbyId)
                            {{$standbyId->nom_stand}}
                        @endforeach</h3>
                    </h4>

                <p class="stand-description">Description:{{ $contenue_stand->description_info_type_stand }}</p>
                <div class="stand-images d-flex flex-wrap">
                    @foreach (json_decode($contenue_stand->img_info_type_stand) as $image)
                        <a href="{{ asset('assets/' . $image) }}" class="stand-image-link" target="_blank">
                            <img src="{{ asset('assets/' . $image) }}" alt="Image du stand" class="stand-image img-thumbnail me-2" width="200" height="150">
                        </a>
                    @endforeach
                </div>
                <p class="stand-type"><strong>Type de contenue :</strong> {{ $contenue_stand->nom_type_stand }}</p>
                <form action="{{route('viewFormulaireAjoutBrochure')}}" method="GET">
                    <input type="hidden" name="id_info_type_stand" value="{{$contenue_stand->id_info_type_stand}}">
                    <input type="hidden" name="id_info_type_stand_desc" value="{{$contenue_stand->id_info_type_stand_desc}}">
                    <input type="hidden" name="id_stand" value="{{$contenue_stand->id_stand}}">
                    <input type="submit" value="Ajouter une brochure" class="btn btn-primary font-custom">
                </form>

                <form action="">
                    <input type="hidden" name="id_info_type_stand" value="{{$contenue_stand->id_info_type_stand}}">
                    <input type="hidden" name="id_info_type_stand_desc" value="{{$contenue_stand->id_info_type_stand_desc}}">
                    <input type="hidden" name="id_stand" value="{{$contenue_stand->id_stand}}">
                    <input type="submit" value="Modifier" class="btn btn-primary font-custom">
                </form>

            </div>
        @endforeach
    </div>


@endsection --}}
@extends('parent.parentDirecteurEmp')
@section('choixContenuePourBrochureSection')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');

    .container {
        font-family: 'Poppins', sans-serif;
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }

    .stand-title {
        font-size: 32px;
        font-weight: bold;
        color: #333;
        margin-bottom: 40px;
        text-align: center;
        border-bottom: 3px solid #007bff;
        padding-bottom: 10px;
        text-transform: uppercase;
        letter-spacing: 1.5px;
    }

    .stand-section {
        background-color: #f9f9f9;
        padding: 20px 30px;
        border-radius: 10px;
        box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.1);
        margin-bottom: 30px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .stand-section:hover {
        transform: translateY(-5px);
        box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2);
    }

    .stand-name {
        font-size: 26px;
        font-weight: 600;
        color: #1a1a1a;
        margin: 0 0 10px;
    }

    .stand-description {
        font-size: 16px;
        line-height: 1.8;
        color: #555;
        margin: 15px 0;
    }

    .stand-images {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 20px;
        margin-top: 20px;
    }

    .stand-image-link {
        display: block;
        overflow: hidden;
        border: 3px solid #fff;
        border-radius: 8px;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .stand-image-link:hover {
        transform: scale(1.05);
        box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.2);
        border-color: #007bff;
    }

    .stand-image {
        width: 100%;
        height: auto;
        max-height: 300px;
        object-fit: contain;
        border-radius: 6px;
    }

    .stand-type {
        font-size: 14px;
        color: #555;
        margin: 10px 0;
    }

    .stand-type strong {
        color: #13304f;
    }

    .button-container {
        margin-top: 20px;
        display: flex;
        gap: 15px;
    }

    .alert-danger {
        background-color: #f8d7da;
        color: #842029;
        border: 1px solid #f5c2c7;
        border-radius: 6px;
        padding: 10px 15px;
        margin-bottom: 20px;
    }
</style>

<div class="container mt-4">
    <h2 class="stand-title">Gérer votre contenu</h2>

    @if ($errors->any())
    <div class="alert alert-danger" role="alert">
        {{ $errors->first('error') }}
    </div>
    @endif

    @foreach ($contenue as $contenue_stand)
    <div class="stand-section">
        <h3 class="stand-name">Titre : {{ $contenue_stand->nom_info_type_stand }}</h3>
        <h4>Stand :
            @foreach ($stand as $standbyId)
                {{ $standbyId->nom_stand }}
            @endforeach
        </h4>
        <p class="stand-description">Description : {{ $contenue_stand->description_info_type_stand }}</p>

        <div class="stand-images">
            @foreach (json_decode($contenue_stand->img_info_type_stand) as $image)
            <a href="{{ asset('assets/' . $image) }}" class="stand-image-link" target="_blank">
                <img src="{{ asset('assets/' . $image) }}" alt="Image du stand" class="stand-image">
            </a>
            @endforeach
        </div>

        <p class="stand-type">
            <strong>Type de contenu :</strong>
            {{ $contenue_stand->nom_type_stand }}</p>

        <div class="button-container">
            <form action="{{ route('viewFormulaireAjoutBrochure') }}" method="GET">
                <input type="hidden" name="id_info_type_stand" value="{{ $contenue_stand->id_info_type_stand }}">
                <input type="hidden" name="id_info_type_stand_desc" value="{{ $contenue_stand->id_info_type_stand_desc }}">
                <input type="hidden" name="id_stand" value="{{ $contenue_stand->id_stand }}">
                <button type="submit" class="btn btn-primary">Ajouter une brochure</button>
            </form>
            <form action="{{ route('viewFormulaireDeModificationBrochure') }}" method="GET">
                <input type="hidden" name="id_info_type_stand" value="{{ $contenue_stand->id_info_type_stand }}">
                <button type="submit" class="btn">Modifier</button>
            </form>
        </div>
    </div>
    @endforeach
</div>
@endsection
