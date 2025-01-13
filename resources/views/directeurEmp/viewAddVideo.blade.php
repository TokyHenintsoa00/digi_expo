@extends('parent.parentDirecteurEmp')
@section('viewAddVideoSection')

<style>
    /* .container {
        font-family: 'Arial', sans-serif;
        color: #333;
        padding: 20px;
        background-color: #f9f9f9;
    } */

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
                <form action="{{route('viewformulaireModifierAddPosterAndProjetEmp')}}" method="GET">
                    <input type="hidden" name="id_info_type_stand" value="{{$contenue_stand->id_info_type_stand}}">
                    <input type="submit" value="Ajouter une video" class="btn btn-primary font-custom">
                </form>

            </div>
        @endforeach
    </div>


@endsection