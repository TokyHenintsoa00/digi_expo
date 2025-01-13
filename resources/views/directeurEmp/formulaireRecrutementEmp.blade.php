@extends('parent.parentDirecteurEmp')
@section('formulaireRecrutementSection')
<link rel="stylesheet" href="{{asset('assets2/css/feather.css')}}">
<!-- Date Range Picker CSS -->
<link rel="stylesheet" href="{{asset('assets2/css/daterangepicker.css')}}">
<!-- App CSS -->
<link rel="stylesheet" href="{{asset('assets2/css/simplebar.css')}}">

<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header">
                <strong class="card-title">Formulaire de recrutement de nouvelle employer de stand</strong>
            </div>
            <div class="card-body">
                  <!-- Afficher le message de succès -->
                   <!-- Afficher le message de succès -->
                   @if (session('success'))
                   <div class="alert alert-success" role="alert">
                       {!! session('success') !!}
                   </div>
                   @endif
                <form action="{{route('recrutementEmp')}}" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6 mb-3">
                            <label for="inputEmail4">Nom</label>
                            <input type="text" class="form-control" id="inputEmail5" name="nom_emp">
                        </div>
                        <div class="form-group col-md-6 mb-3">
                            <label for="inputEmail4">Prenom </label>
                            <input type="text" class="form-control" id="inputEmail5" name="prenom_emp">
                        </div>
                        <div class="form-group col-md-6 mb-3">
                            <label for="inputEmail4">Email </label>
                            <input type="mail" class="form-control" id="inputEmail5" name="email_emp">
                        </div>
                        <div class="form-group col-md-6 mb-3">
                            <label for="inputEmail4">Date de naissance </label>
                            <input type="date" class="form-control" id="inputEmail5" name="date_naissance_emp">
                        </div>
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label for="inputPassword4">Stand</label>
                        <select class="form-select" id="faculteSelect" aria-label="Select faculté" name="id_stand">
                            <option selected disabled>Stand de recrutement</option>
                            @foreach ($viewMembreStand as $list_viewMembreStand)
                                <option value="{{$list_viewMembreStand->id_stand}}">{{$list_viewMembreStand->nom_stand}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                </form>
            </div> <!-- /. card-body -->
        </div> <!-- /. card -->
    </div> <!-- /. col -->
</div> <!-- /. end-section -->
@endsection