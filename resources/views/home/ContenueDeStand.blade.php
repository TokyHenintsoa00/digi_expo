@extends('parent.parentHome')
@section('ContenueDeStandSection')
<style>
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
        cursor: pointer;
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

    .modal-img {
        max-width: 100%;
        max-height: 80vh;
        display: block;
        margin: auto;
    }
</style>

<div class="container mt-4">
    @foreach ($stand as $nom_stand)
        <h2 class="stand-title">Galerie photo: {{ $nom_stand->nom_stand }}</h2>
    @endforeach

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

    @foreach ($contenue as $contenue_stand)
        <div class="stand-info">
            <h3 class="stand-name">Titre: {{ $contenue_stand->nom_info_type_stand }}</h3>
            <p class="stand-description">Description: {{ $contenue_stand->description_info_type_stand }}</p>

            <div class="stand-images d-flex flex-wrap">
                @foreach (json_decode($contenue_stand->img_info_type_stand) as $image)
                    <a href="javascript:void(0)" class="stand-image-link" data-bs-toggle="modal" data-bs-target="#imageModal" data-image="{{ asset('assets/' . $image) }}">
                        <img src="{{ asset('assets/' . $image) }}" alt="Image du stand" class="stand-image img-thumbnail me-2" width="200" height="150">
                    </a>
                @endforeach
            </div>

            <p class="stand-type"><strong>Type de contenu :</strong> {{ $contenue_stand->nom_type_stand }}</p>
            <form action="{{route('pdfDownload')}}" method="POST">
                @csrf
                <input type="hidden" name="id_info_type_stand" value="{{$contenue_stand->id_info_type_stand}}">
                <input type="submit" value="Télécharger une brochure" class="btn btn-primary font-custom">
            </form>
        </div>
    @endforeach
</div>

<!-- Modal pour afficher l'image en grand -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Aperçu de l'image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img src="" id="modalImage" class="modal-img" alt="Image du stand">
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const imageModal = document.getElementById('imageModal');
        imageModal.addEventListener('show.bs.modal', function (event) {
            let button = event.relatedTarget;
            let imageSrc = button.getAttribute('data-image');
            let modalImage = document.getElementById('modalImage');
            modalImage.src = imageSrc;
        });
    });
</script>
@endsection
