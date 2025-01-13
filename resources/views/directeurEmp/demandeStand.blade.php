@extends('parent.parentDirecteurEmp')
@section('demandeStandSection')

<link rel="stylesheet" href="{{asset('assets2/css/feather.css')}}">
<!-- Date Range Picker CSS -->
<link rel="stylesheet" href="{{asset('assets2/css/daterangepicker.css')}}">
<!-- App CSS -->
<link rel="stylesheet" href="{{asset('assets2/css/simplebar.css')}}">

<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header">
                <h5 class="card-title fw-semibold mb-4">Formulaire pour une nouvelle stand </h5>
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

                <form action="{{route('demandeStandEmp')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6 mb-3">
                            <label for="inputEmail4">Nom du stand</label>
                            <input type="text" class="form-control" id="inputEmail5" name="nom_stand">
                        </div>
                        <div class="form-group col-md-6 mb-3">
                            <label for="inputPassword4">Categorie</label>
                            <select class="form-select" id="faculteSelect" aria-label="Select faculté" name="id_categorie">
                                <option selected disabled>Choisissez votre Categorie</option>
                                @foreach ($getAllCategorie as $list_getAllCategorie)
                                <option value="{{$list_getAllCategorie->id_categorie}}">{{$list_getAllCategorie->nom_categorie}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6 mb-3">
                            <label for="inputEmail4">Nom de la categorie</label>
                            <input type="text" class="form-control" id="inputEmail5" name="nom_categorie">
                        </div>

                        <div class="form-group col-md-6 mb-3">
                            <label for="inputAddress2">Date du debut</label>
                            <input type="date" class="form-control" id="emailEmploye" aria-describedby="emailHelp" name="date_debut" required>
                        </div>

                        <div class="form-group col-md-6 mb-3">
                            <label for="inputAddress2">Date de fin</label>
                            <input type="date" class="form-control" id="emailEmploye" aria-describedby="emailHelp" name="date_fin" required>
                        </div>

                    </div>
                    <div class="form-group mb-3">
                        <label for="inputAddress">Description</label>
                        <textarea class="form-control" id="descriptionStand" rows="4" placeholder="Décrivez votre stand ici..." name="description_stand"></textarea>
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label for="inputAddress2">Image du stand</label>
                        <input type="file" class="form-control" id="img_stand" name="img_stand" accept="image/*" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Envoyer</button>
                </form>
            </div> <!-- /. card-body -->
        </div> <!-- /. card -->
    </div> <!-- /. col -->
</div> <!-- /. end-section -->


@endsection
