@extends('parent.parentEmp')
@section('gestionContenueEmpSection')


<h1>Validations</h1>
<div class="container-fluid">
    <div class="container-fluid">
      <div class="card">
        <div class="card-body">
          <div class="row">


            @if (session('success'))
                   <div class="alert alert-success" role="alert">
                       {!! session('success') !!}
                   </div>
            @endif


                <div class="col-md-6">

                    <div class="card">
                        <div class="card-header">
                           Formulaire ajout galerie photos
                        </div>
                        <div class="card-body">
                          <h5 class="card-title">Validez et confirmez vos photos afin qu'ils soient visibles pour les clients</h5>
                          <p class="card-text">Assurez-vous que toutes les informations sont exactes avant la validation finale.</p>
                          <a href="{{route('viewformulaireAddPosterAndProjet')}}" class="btn btn-primary">Valider maintenant</a>
                        </div>
                      </div>
                </div>

                <div class="col-md-6">

                    <div class="card">
                        <div class="card-header">
                           Formulaire ajout galerie video
                        </div>
                        <div class="card-body">
                          <h5 class="card-title">Validez et confirmez vos video afin qu'ils soient visibles pour les clients</h5>
                          <p class="card-text">Assurez-vous que toutes les informations sont exactes avant la validation finale.</p>
                          <a href="{{route('viewformulaireAddVideoEmpSection')}}" class="btn btn-primary">Valider maintenant</a>
                        </div>
                      </div>
                </div>


          </div>
        </div>
      </div>
    </div>
  </div>

@endsection