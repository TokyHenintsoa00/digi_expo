@extends('parent.parentDirecteurEmp')
@section('AddPosterAndProjetEmpSection')


<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header">
                <strong class="card-title">Formulaire d'ajout de contenue photo</strong>
            </div>
            <div class="card-body">
                  <!-- Afficher le message de succès -->
                   <!-- Afficher le message de succès -->
                   @if (session('success'))
                   <div class="alert alert-success" role="alert">
                       {!! session('success') !!}
                   </div>
                   @endif
                <form action="{{route('AddPosterAndProjetEmp')}}" method="POST" enctype="multipart/form-data">
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
                            <label for="inputPassword4">Votre contenue dans le stand</label>
                            <select class="form-select" id="faculteSelect" aria-label="Select faculté" name="id_type_stand">
                                <option >Choisissez votre type de contenue de stand</option>
                                @foreach ($type_stand as $list_type_stand)
                                <option value="{{$list_type_stand->id_type_stand}}">{{$list_type_stand->nom_type_stand}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6 mb-3">
                            <label for="inputEmail4">Le nom de votre type de contenue</label>
                            <input type="text" class="form-control" id="inputEmail5" name="nom_info_type_stand">
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="inputAddress">Description</label>
                        <textarea class="form-control" id="descriptionStand" rows="4" placeholder="Décrivez votre stand ici..." name="description_info_type_stand"></textarea>
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label for="inputAddress2">Image de contenue</label>
                        <input type="file" class="form-control" id="img_stand" name="img_info_type_stand[]" accept="image/*" multiple>
                    </div>

                    <input type="submit" class="btn btn-primary" value="Publier">
                </form>
            </div> <!-- /. card-body -->
        </div> <!-- /. card -->
    </div> <!-- /. col -->
</div> <!-- /. end-section -->


@endsection