@extends('parent.parentDirecteurEmp')
@section('videConferenceSection')
<h1>Gestion de video conference</h1>
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
                           Planification
                        </div>
                        <div class="card-body">
                          <h5 class="card-title">Planifiez vos conférences vidéo pour qu'elles soient accessibles aux clients</h5>
                          <p class="card-text">Remplissez toutes les informations nécessaires avant la validation finale pour garantir leur exactitude.</p>
                          <a href="{{route('viewPlanificationVideoConference')}}" class="btn btn-primary">Planifier</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            Historique et gestion des conférences
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Consultez l'historique, listez les conférences, et ajoutez des liens si nécessaire</h5>
                            <p class="card-text">Assurez-vous que toutes les conférences ont les liens appropriés pour une accessibilité optimale.</p>
                            <a href="{{ route('viewModificationVideoConference') }}" class="btn btn-primary">Voir l'historique et gérer</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                           conference avec les clients
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Panifier une videoConference avec les clients</h5>
                            <p class="card-text">Assurez-vous que toutes les conférences ont les liens appropriés pour une accessibilité optimale.</p>
                            <a href="{{ route('viewModificationVideoConference') }}" class="btn btn-primary">Voir l'historique et gérer</a>
                        </div>
                    </div>
                </div>



          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
