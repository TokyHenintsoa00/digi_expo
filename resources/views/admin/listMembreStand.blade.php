@extends('parent.ParentAdmin')
@section('listMembreStandSection')

<h2>Liste des membre de stand</h2>

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

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nom du stand</th>
                <th>Responsable</th>
                <th>Editeur</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($membre_stand as $list_membre_stand)
            <tr>
                <td>{{ $list_membre_stand->nom_stand }}</td>
                <td>{{ $list_membre_stand->nom_directeur }} {{ $list_membre_stand->prenom_directeur }}</td>

                @if (is_null($list_membre_stand->prenom_emp) )
                <td><span class="text-danger fw-semibold">Null</span></td>
                @else
                <td><span class="fw-semibold">{{ $list_membre_stand->prenom_emp }}</span></td>
                @endif
                @if ($list_membre_stand->id_etat_personne == 8)
                    <td>
                        <span class="text-danger fw-semibold">Employé licencié</span>
                    </td>
                @elseif ($list_membre_stand->id_etat_personne == 9)
                    <td>
                        <span class="text-warning fw-semibold">Employé démissionnaire</span>
                    </td>
                    @elseif ($list_membre_stand->id_etat_personne == 10)
                    <td>
                        <span class="text-warning fw-semibold">Directeur démissionnaire</span>
                    </td>

                @elseif ($list_membre_stand->id_etat_personne == 7)
                <td>
                    <span class="text-success fw-semibold">Directeur</span>
                </td>
                @elseif ($list_membre_stand->id_etat_personne == 2)
                <td>
                    <span class="text-success fw-semibold">Employer actif</span>
                </td>

                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection

