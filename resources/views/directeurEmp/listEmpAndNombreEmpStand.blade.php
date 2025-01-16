@extends('parent.parentDirecteurEmp')
@section('listEmpNombreEmpStandSection')


<h2>Liste des editeur par stand</h2>


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
                <th>Nom</th>
                <th>Prenom</th>
                <th>Stand</th>
                <th>Date de membre</th>
                <th>etat</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($getAllEmpDirecteur as $list_getAllEmpDirecteur)
                <tr>
                    <td>{{$list_getAllEmpDirecteur->nom_emp}}</td>
                    <td>{{$list_getAllEmpDirecteur->prenom_emp}}</td>
                    <td>{{$list_getAllEmpDirecteur->nom_stand}}</td>
                    <td>{{$list_getAllEmpDirecteur->date_membre}}</td>

                    @if ($list_getAllEmpDirecteur->id_etat_emp == 2)
                    <td>
                        <span class="text-success fw-semibold">editeur encore actif</span>
                    </td>
                    @elseif ($list_getAllEmpDirecteur->id_etat_emp == 8)
                        <td>
                            <span class="text-danger fw-semibold">editeur licensier</span>
                        </td>
                    @elseif ($list_getAllEmpDirecteur->id_etat_emp == 9)
                        <td>
                            <span class="text-warning fw-semibold">editeur démmissionner</span>
                        </td>
                    @endif

                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<h2>Nombre d'editeur par stand</h2>

<div class="col-5">

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
                <th>Stand</th>
                <th>Nombre d'editeur</th>


            </tr>
        </thead>
        <tbody>
            @foreach ($getCountEmpStand as $list_getCountEmpStand)
                <tr>
                    <td>{{$list_getCountEmpStand->nom_stand}}</td>
                    <td>{{$list_getCountEmpStand->nombre_emp}}</td>


                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection