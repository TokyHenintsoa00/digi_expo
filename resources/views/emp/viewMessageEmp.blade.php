@extends('parent.parentEmp')
@section('viewMessageEmpSection')

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
            @foreach ($membre_stand as $list_membre_stand)
                @if ($list_membre_stand->id_emp != session('id_emp'))
                <tr>
                    <td>
                        {{ $list_membre_stand->nom_emp ?? $list_membre_stand->nom_directeur }}
                    </td>
                    <td>
                        {{ $list_membre_stand->prenom_emp ?? $list_membre_stand->prenom_directeur }}
                    </td>
                    <td>{{ $list_membre_stand->nom_stand }}</td>
                    <td>
                        <a href="{{ route('viewMessageSendOrReciveEmp', [
                            'nom' => $list_membre_stand->nom_emp ?? $list_membre_stand->nom_directeur,
                            'prenom' => $list_membre_stand->prenom_emp ?? $list_membre_stand->prenom_directeur,
                            'id' => $list_membre_stand->id_emp ??  $list_membre_stand->id_directeur,
                            'etat' => $list_membre_stand->id_etat_personne,
                            'nom_emp' =>$list_membre_stand->nom_emp,
                            'prenom_emp' =>$list_membre_stand->prenom_emp,
                            'id_emp' =>$list_membre_stand->id_emp
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