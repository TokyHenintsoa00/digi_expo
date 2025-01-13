@extends('parent.parentDirecteurEmp')
@section('formulaireModificationVideoConferenceSection')
<link rel="stylesheet" href="{{asset('assets2/css/feather.css')}}">
<!-- Date Range Picker CSS -->
<link rel="stylesheet" href="{{asset('assets2/css/daterangepicker.css')}}">
<!-- App CSS -->
<link rel="stylesheet" href="{{asset('assets2/css/simplebar.css')}}">

<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header">
                <strong class="card-title">modification de video conference</strong>
            </div>
            <div class="card-body">
                  <!-- Afficher le message de succès -->
                   <!-- Afficher le message de succès -->
                   @if (session('success'))
                   <div class="alert alert-success" role="alert">
                       {!! session('success') !!}
                   </div>
                   @endif
                <form action="{{route('modificationVideoConference')}}" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6 mb-3">
                            <label for="inputEmail4">Titre de la video</label>
                            <input type="text" class="form-control" id="inputEmail5" name="titre_video">
                    </div>

                    <div class="form-group col-md-6 mb-3">
                        <label for="inputPassword4">Type de video</label>
                        <select class="form-select" id="faculteSelect" aria-label="Select faculté" name="id_type_video">
                            <option selected disabled>Type de video</option>
                            @foreach ($type_video as $list_type_video)
                                <option value="{{$list_type_video->id_type_video}}">{{$list_type_video->nom_type}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label for="inputPassword4">Type de conference</label>
                        <select class="form-select" id="faculteSelect" aria-label="Select faculté" name="id_type_conference">
                            <option selected disabled>Type de conference</option>
                            @foreach ($type_conference as $list_type_conference)
                                <option value="{{$list_type_conference->id_type_conference}}">{{$list_type_conference->nom_type_conference}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label for="inputEmail4">Date de conference</label>
                        <input type="datetime-local" class="form-control" id="inputEmail5" name="date_heure_conference">
                    </div>
                </div>


                <div class="form-group col-md-6 mb-3">
                    <label for="inputAddress2">Liens de la video</label>
                    <input type="url" class="form-control" id="inputEmail5" name="liens_video" placeholder="Veuillez mettre le lien ici">
                </div>
                    <input type="hidden" name="id_salle_conference" value="{{$id_salle_conference}}">
                    <input type="submit" class="btn btn-primary" value="Modifier">
                </form>
            </div> <!-- /. card-body -->
        </div> <!-- /. card -->
    </div> <!-- /. col -->
</div> <!-- /. end-section -->
@endsection