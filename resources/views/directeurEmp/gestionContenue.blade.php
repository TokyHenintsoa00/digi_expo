@extends('parent.parentDirecteurEmp')
@section('gestionContenueSection')

<h1>Gestion de contenue d'exposition</h1>
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
                           Formulaire ajout de photo
                        </div>
                        <div class="card-body">
                          <h5 class="card-title">Validez et confirmez vos contenue photos afin qu'ils soient visibles pour les clients</h5>
                          <p class="card-text">Assurez-vous que toutes les informations sont exactes avant la validation finale.</p>
                          <a href="{{route('viewformulaireAddPosterAndProjetEmp')}}" class="btn btn-primary">Valider maintenant</a>
                        </div>
                      </div>
                </div>



                <div class="col-md-6">

                    <div class="card">
                        <div class="card-header">
                           Modification d' ajout de photo
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Nous vous encourageons à valider et à confirmer les modifications apportées à vos contenus photo afin qu'ils soient accessibles aux clients.</h5>
                            <p class="card-text">Assurez-vous que toutes les informations modifiées sont exactes avant de procéder à la validation finale.</p>
                            <a href="{{route('viewModifierPosterProjet')}}" class="btn btn-primary">Procéder à la modification</a>
                        </div>
                      </div>
                </div>


                <div class="col-md-6">

                    <div class="card">
                        <div class="card-header">
                           Formulaire ajout de video
                        </div>
                        <div class="card-body">
                          <h5 class="card-title">Validez et confirmez vos contenue video afin qu'ils soient visibles pour les clients</h5>
                          <p class="card-text">Assurez-vous que toutes les informations sont exactes avant la validation finale.</p>
                          <a href="{{route('viewFormulaireAddVideo')}}" class="btn btn-primary">Valider maintenant</a>
                        </div>
                      </div>
                </div>



                <div class="col-md-6">

                    <div class="card">
                        <div class="card-header">
                           Modification d' ajout de video
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Nous vous encourageons à valider et à confirmer les modifications apportées à vos contenus video afin qu'ils soient accessibles aux clients.</h5>
                            <p class="card-text">Assurez-vous que toutes les informations modifiées sont exactes avant de procéder à la validation finale.</p>
                            <a href="{{route('viewModificationVideo')}}" class="btn btn-primary">Procéder à la modification</a>
                        </div>
                      </div>
                </div>




          </div>
        </div>
      </div>
    </div>
  </div>


@endsection