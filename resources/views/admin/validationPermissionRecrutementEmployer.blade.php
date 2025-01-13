@extends('parent.ParentAdmin')
@section('recrutementEmpSection')
<h1>Liste de validation de recrutement</h1>
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
                <th>Date naissance</th>
                <th>Email</th>
                <th>Stand</th>
                <th>etat</th>
                <th>Validation</th>
                <th>Refuse</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($recrutement as $list_recrutement)
                <tr>
                    <td>{{$list_recrutement->nom_emp}}</td>
                    <td>{{$list_recrutement->prenom_emp}}</td>
                    <td>{{$list_recrutement->date_naissance}}</td>
                    <td>{{$list_recrutement->email}}</td>
                    <td>{{$list_recrutement->nom_stand}}</td>
                    <td>
                        @if ($list_recrutement->id_etat ==1)
                        <div class="d-flex align-items-center gap-2">
                            <p class="text-danger fw-semibold">En attente</p>
                        </div>
                        @endif
                    </td>
                    <td>
                        <form action="/validationRecrutement" method="POST">
                            @csrf
                            <input type="hidden" name="nom_emp" value="{{$list_recrutement->nom_emp}}">
                            <input type="hidden" name="prenom_emp" value="{{$list_recrutement->prenom_emp}}">
                            <input type="hidden" name="date_naissance" value="{{$list_recrutement->date_naissance}}">
                            <input type="hidden" name="email" value="{{$list_recrutement->email}}">
                            <input type="hidden" name="id_stand" value="{{$list_recrutement->id_stand}}">
                            <input type="hidden" name="nom_stand" value="{{$list_recrutement->nom_stand}}">
                            <input type="hidden" name="id_permission_recrutement_emp" value="{{$list_recrutement->id_permission_recrutement_emp}}">
                            <input type="hidden" name="id_expediteur" value="{{$list_recrutement->id_expediteur}}">

                            <input type="submit" value="Valider" class="btn btn-success m-1">
                        </form>
                    </td>
                    <td>
                        <form action="{{route('refusDeRecrutement')}}" method="POST">
                            @csrf
                            <input type="hidden" name="prenom_emp" value="{{$list_recrutement->prenom_emp}}">
                            <input type="hidden" name="id_expediteur" value="{{$list_recrutement->id_expediteur}}">
                            <input type="hidden" name="id_permission_recrutement_emp" value="{{$list_recrutement->id_permission_recrutement_emp}}">
                            <input type="submit" value="Refuser" class="btn btn-danger m-1">
                        </form>

                    </td>

                </tr>
            @endforeach

        </tbody>
    </table>
</div>

@endsection