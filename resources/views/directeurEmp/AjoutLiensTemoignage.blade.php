@extends('parent.parentDirecteurEmp')
@section('AjoutLiensTemoignageSection')

<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header">
                <strong class="card-title">formulaire d'ajout de Liens de video</strong>
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
                <form action="{{route('ajoutLiensTemoignage')}}" method="POST">
                    @csrf

                    <div class="form-row">
                        <div class="form-group col-md-6 mb-3">
                            <label for="inputAddress2">Liens de la video</label>

                            <input type="url" class="form-control" id="inputEmail5" name="liens_video" placeholder="Veuillez mettre le lien ici">
                        </div>
                    </div>
                    <input type="hidden" name="id_temoignage" value="{{$id_temoignage}}">
                    <input type="submit" class="btn btn-primary" value="Publier">
                </form>
            </div> <!-- /. card-body -->
        </div> <!-- /. card -->
    </div> <!-- /. col -->
</div> <!-- /. end-section -->

@endsection