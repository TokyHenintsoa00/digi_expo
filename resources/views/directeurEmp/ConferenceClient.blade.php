@extends('parent.parentDirecteurEmp')
@section('ConferenceClientSection')


<link rel="stylesheet" href="{{asset('assets2/css/feather.css')}}">
<!-- Date Range Picker CSS -->
<link rel="stylesheet" href="{{asset('assets2/css/daterangepicker.css')}}">
<!-- App CSS -->
<link rel="stylesheet" href="{{asset('assets2/css/simplebar.css')}}">

<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header">
                <h5 class="card-title fw-semibold mb-4">Planification de la video audioConference </h5>
            </div>
            <div class="card-body">
                  <!-- Afficher le message de succès -->
                   <!-- Afficher le message de succès -->
                   @if (session('success'))
                   <div class="alert alert-success" role="alert">
                       {!! session('success') !!}
                   </div>
                   @endif
                <form action="{{route('ajoutDeReunion')}}" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6 mb-3">
                            <label for="inputEmail4">Date de votre galerie</label>
                            <input type="datetime-local" class="form-control" id="inputEmail5" name="date_heure_reunion">
                        </div>

                        <div class="form-group col-md-6 mb-3">
                            <label for="inputPassword4">Exposition</label>
                            <select class="form-select" id="faculteSelect" aria-label="Select faculté" name="id_stand">

                                @foreach ($standDirecteur as $list_standDirecteur)
                                    <option value="{{$list_standDirecteur->id_stand}}">{{$list_standDirecteur->nom_stand}}</option>
                                @endforeach

                            </select>
                        </div>

                        <div class="form-group col-md-6 mb-3">
                            <label for="inputAddress2">Liens de la video</label>
                            <input type="url" class="form-control" id="inputEmail5" name="liens_video" placeholder="Veuillez mettre le lien ici">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                </form>
            </div> <!-- /. card-body -->
        </div> <!-- /. card -->
    </div> <!-- /. col -->
</div> <!-- /. end-section -->




@endsection