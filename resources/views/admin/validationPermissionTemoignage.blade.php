@extends('parent.ParentAdmin')
@section('validationPermissionTemoignage')

<h1>Liste de validation des permission temoinage</h1>

<div class="col-12" style="overflow-x: auto;">

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
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Titre temoignage</th>
                <th>Date temoignage</th>
                <th>Stand</th>
                <th>liens_video</th>
                <th>Directeur</th>
            </tr>
        </thead>
        <tbody>
             @foreach ($list_permission_temoignage as $all_list_permission_temoignage)
                <tr>
                    <td>{{$all_list_permission_temoignage->titre}}</td>
                    <td>{{$all_list_permission_temoignage->date_temoignage }}</td>
                    <td>{{$all_list_permission_temoignage->nom_stand }}</td>
                     <td>{{$all_list_permission_temoignage->liens_video }}</td>
                     <td>{{$all_list_permission_temoignage->prenom_emp }}</td>
                    <td>
                        @if ($all_list_permission_temoignage->id_etat ==1)
                        <div class="d-flex align-items-center gap-2">
                            <p class="text-danger fw-semibold">En attente</p>
                        </div>
                        @else
                        <div class="d-flex align-items-center gap-2">
                            <p class="text-warning fw-semibold">Modification</p>
                        </div>
                        @endif
                    </td>
                    <td>
                        <form id="validationForm" action="{{route('validationPermissionTemoigange')}}" method="POST">
                            @csrf
                                <input type="hidden" name="id_stand" value="{{$all_list_permission_temoignage->id_stand}}">
                                <input type="hidden" name="date_temoignage" value="{{$all_list_permission_temoignage->date_temoignage}}">
                                <input type="hidden" name="liens_video" value="{{$all_list_permission_temoignage->liens_video}}">
                                <input type="hidden" name="titre" value="{{$all_list_permission_temoignage->titre}}">
                                <input type="hidden" name="id_sallon" value="{{$all_list_permission_temoignage->id_sallon}}">
                                <input type="hidden" name="id_directeur" value="{{$all_list_permission_temoignage->id_directeur}}">
                                <input type="hidden" name="id_permission_temoigange" value="{{$all_list_permission_temoignage->id_permission_temoigange}}">
                                <input type="hidden" name="id_etat" value="{{$all_list_permission_temoignage->id_etat}}">
                                <input type="hidden" name="id_temoignage" value="{{$all_list_permission_temoignage->id_temoignage}}">

                                <input type="submit" value="Valider" class="btn btn-success m-1">
                        </form>
                    </td>
                    <td>
                        <form action="#" method="POST">
                            @csrf
                                {{-- web socket refuser fa tsy mila manao an ny controler --}}
                            <input type="submit" value="Refuser" class="btn btn-danger m-1">
                        </form>

                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection