@extends('parent.parentDirecteurEmp')
@section('viewMessageDirecteurSection')

<h2>Liste des employer par stand</h2>


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
            </tr>
        </thead>
        <tbody>
            @foreach ($membre_stand as $list_getAllEmployerDirecteur)
                @if ($list_getAllEmployerDirecteur->id_emp != null && $list_getAllEmployerDirecteur->id_etat_personne !=8)
            <tr>
                <td>{{ $list_getAllEmployerDirecteur->nom_emp }}</td>
                <td>{{ $list_getAllEmployerDirecteur->prenom_emp }}</td>
                <td>{{ $list_getAllEmployerDirecteur->nom_stand }}</td>
                <td>
                    <a href="{{ route('viewMessageSendOrReciveDirecteur', [
                        'nom_emp' => $list_getAllEmployerDirecteur->nom_emp,
                        'prenom_emp' => $list_getAllEmployerDirecteur->prenom_emp,
                        'id_emp' => $list_getAllEmployerDirecteur->id_emp,
                        'id_directeur' =>$list_getAllEmployerDirecteur->id_directeur,
                        'nom_dir' =>$list_getAllEmployerDirecteur->nom_directeur,
                        'prenom_dir' =>$list_getAllEmployerDirecteur->prenom_directeur,
                        'etat_dir'=>7
                    ]) }}">
                        Voir Messages
                    </a>
                </td>
            </tr>
            @endif
        @endforeach
        </tbody>
    </table>
</div>

@endsection