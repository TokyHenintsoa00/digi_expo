@extends('parent.ParentAdmin')
@section('permissionBrochure')

<h1>Validation des permission de brochure</h1>

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
                <th>Nom du brochure</th>
                <th>Fichier</th>
                <th>Directeur</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($permissionBrochure as $list_permissionBrochure)
                <tr>
                    <td>{{$list_permissionBrochure->nom_brochure_stand}}</td>
                    <td>{{$list_permissionBrochure->img_brochure}}</td>
                    <td>{{$list_permissionBrochure->prenom_emp}}</td>
                    <td>
                        @if ($list_permissionBrochure->id_etat ==1)
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
                        <form id="validationForm" action="{{route('validationPermissionBrochure')}}" method="POST">
                            @csrf
                                <input type="hidden" name="id_info_type_stand" value="{{$list_permissionBrochure->id_info_type_stand}}">
                                <input type="hidden" name="nom_brochure_stand" value="{{$list_permissionBrochure->nom_brochure_stand}}">
                                <input type="hidden" name="img_brochure" value="{{$list_permissionBrochure->img_brochure}}">
                                <input type="hidden" name="date_ajout_brochure" value="{{$list_permissionBrochure->date_ajout_brochure}}">
                                <input type="hidden" name="id_permission_brochure" value="{{$list_permissionBrochure->id_permission_brochure}}">
                                <input type="hidden" name="id_permission_brochure" value="{{$list_permissionBrochure->id_permission_brochure}}">
                                <input type="hidden" name="id_directeur" value="{{$list_permissionBrochure->id_directeur}}">
                                <input type="hidden" name="id_etat" value="{{$list_permissionBrochure->id_etat}}">

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