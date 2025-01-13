@extends('parent.parentDirecteurEmp')
@section('formulaireAddVideoSection')

<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header">
                <strong class="card-title">Formulaire d'ajout de contenue video</strong>
            </div>
            <div class="card-body">
                  <!-- Afficher le message de succès -->
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
                <form action="{{route('addVideo')}}" method="POST" enctype="multipart/form-data">
                   @csrf

                    <div class="form-row">


                        <div class="form-group col-md-6 mb-3">
                            <label for="inputPassword4">Stand</label>
                            <select class="form-select" id="faculteSelect" aria-label="Select faculté" name="id_stand">
                                <option selected disabled>Choisissez votre stand</option>
                                @foreach ($stand as $list_stand)
                                    <option value="{{$list_stand->id_stand}}">{{$list_stand->nom_stand}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6 mb-3">
                            <label for="inputEmail4">Le nom de la video</label>
                            <input type="text" class="form-control" id="inputEmail5" name="titre_video">
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="inputAddress">Description</label>
                        <textarea class="form-control" id="descriptionStand" rows="4" placeholder="Décrivez votre stand ici..." name="description_video"></textarea>
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label for="videoFile">Fichier vidéo</label>
                        {{-- <input type="file" class="form-control" id="videoFile" name="video_contenue[]" accept="video/*" multiple> --}}
                        <input type="file" class="form-control" id="videoFile" name="video_contenue" accept="video/*">

                    </div>

                    <input type="submit" class="btn btn-primary" value="Publier">
                </form>
            </div> <!-- /. card-body -->
        </div> <!-- /. card -->
    </div> <!-- /. col -->
</div> <!-- /. end-section -->

@endsection