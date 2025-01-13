@extends('parent.parentDirecteurEmp')
@section('modificationStandEmpSection')

<link rel="stylesheet" href="{{asset('assets2/css/feather.css')}}">
<!-- Date Range Picker CSS -->
<link rel="stylesheet" href="{{asset('assets2/css/daterangepicker.css')}}">
<!-- App CSS -->
<link rel="stylesheet" href="{{asset('assets2/css/simplebar.css')}}">

<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header">
                <strong class="card-title">Modification de stand</strong>
            </div>
            <div class="card-body">
                  <!-- Afficher le message de succès -->
                   <!-- Afficher le message de succès -->
                   @if (session('success'))
                   <div class="alert alert-success" role="alert">
                       {!! session('success') !!}
                   </div>
                   @endif
                <form action="{{('modifier')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @foreach ($modifier as $list_modification)
                        <input type="hidden" name="id_stand" value="{{$list_modification->id_stand}}">
                    @endforeach
                    <div class="form-row">
                        <div class="form-group col-md-6 mb-3">
                            <label for="inputEmail4">Nom du stand</label>
                            <input type="text" class="form-control" id="inputEmail5" name="nom_stand">
                        </div>
                        <div class="form-group col-md-6 mb-3">
                            <label for="inputPassword4">Categorie</label>
                            <select class="form-select" id="faculteSelect" aria-label="Select faculté" name="id_faculte_stand">
                                <option selected disabled>Choisissez votre categorie</option>
                                @foreach ($categorie as $list_categorie)
                                    <option value="{{$list_categorie->id_categorie}}">{{$list_categorie->nom_categorie}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6 mb-3">
                            <label for="inputEmail4">Nom de la categorie</label>
                            <input type="text" class="form-control" id="inputEmail5" name="nom_categorie_stand">
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="inputAddress">Description</label>
                        <textarea class="form-control" id="descriptionStand" rows="4" placeholder="Décrivez votre stand ici..." name="description_stand"></textarea>
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label for="inputAddress2">Image du stand</label>
                        <input type="file" class="form-control" id="img_stand" name="img_stand" accept="image/*">
                    </div>

                    <input type="submit" class="btn btn-primary" value="Publier">
                </form>
            </div> <!-- /. card-body -->
        </div> <!-- /. card -->
    </div> <!-- /. col -->
</div> <!-- /. end-section -->


@endsection