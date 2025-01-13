@extends('parent.ParentAdmin')
@section('validationPermissionStandSection')
<h1>Liste de validation de permission</h1>
<div class="col-12">
    <h1>de stand</h1>
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
                <th>Nom de stand</th>
                <th>Categorie</th>
                <th>Nom de la categorie</th>
                <th>Description de stand</th>
                <th>Expediteur</th>
                <th>Action</th> <!-- Ajout d'une colonne pour l'action -->
            </tr>
        </thead>
        <tbody>
            @foreach ($permission as $list_permission)
                <tr>
                    <td>{{$list_permission->nom_stand}}</td>
                    <td>{{$list_permission->nom_categorie}}</td>
                    <td>{{$list_permission->nom_categorie_stand}}</td>
                    <td>{{$list_permission->description_stand}}</td>
                    <td>{{$list_permission->nom_emp}} {{$list_permission->prenom_emp}}</td>
                    <td class="d-flex align-items-center"> <!-- Alignement du bouton avec le texte -->
                        <form action="/validePermissionByAdmin" method="POST">
                            @csrf
                            <input type="hidden" name="id_permission_stand" value="{{$list_permission->id_permission_stand}}">
                            <input type="hidden" name="nom_stand" value="{{$list_permission->nom_stand}}">
                            <input type="hidden" name="id_categorie" value="{{$list_permission->id_categorie}}">
                            <input type="hidden" name="nom_categorie_stand" value="{{$list_permission->nom_categorie_stand}}">
                            <input type="hidden" name="description_stand" value="{{$list_permission->description_stand}}">
                            <input type="hidden" name="date_debut_stand" value="{{$list_permission->date_debut_stand}}">
                            <input type="hidden" name="date_fin_stand" value="{{$list_permission->date_fin_stand}}">


                            <input type="hidden" name="nom_emp" value="{{$list_permission->nom_emp}}">
                            <input type="hidden" name="prenom_emp" value="{{$list_permission->prenom_emp}}">
                            <input type="hidden" name="email" value="{{$list_permission->email}}">
                            <input type="hidden" name="date_naissance" value="{{$list_permission->date_naissance}}">
                            <input type="hidden" name="image_stand" value="{{$list_permission->img_stand}}">


                            <input type="submit" value="Valider" class="btn btn-success m-1">
                        </form>
                        <form action="/refusePermissiontandByAdmin" method="post">
                            @csrf
                            <input type="hidden" name="id_permission_stand" value="{{$list_permission->id_permission_stand}}">
                            <input type="hidden" name="prenom_emp" value="{{$list_permission->prenom_emp}}">
                            <input type="hidden" name="email" value="{{$list_permission->email}}">
                            <input type="submit" value="Refuser" class="btn btn-danger m-1">
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
