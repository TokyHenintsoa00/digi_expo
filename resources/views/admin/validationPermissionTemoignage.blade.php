@extends('parent.ParentAdmin')
@section('validationPermissionTemoignage')

<h1>Liste de validation des permission temoinage</h1>

<div class="col-12">

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
            </tr>
        </thead>
        <tbody>
             @foreach ($list_permission_temoignage as $all_list_permission_temoignage)
                <tr>
                    <td>{{$all_list_permission_temoignage->titre}}</td>
                    <td>{{$all_list_permission_temoignage->date_temoignage }}</td>
                    <td>{{$all_list_permission_temoignage->nom_stand }}</td>
                     <td>{{$all_list_permission_temoignage->liens_video }}</td>
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
                        <form id="validationForm" action="{{route('validePermissionGalerieVideo')}}" method="POST">
                            @csrf
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