@extends('parent.parentDirecteurEmp')

@section('standDirecteurSection')

<h1>Liste des stands non publiés et publiés</h1>
<style>

</style>
<div class="col-12">
    <h1>de stand</h1>
    @if (session('success'))
    <div class="alert alert-success" role="alert">
        {!! session('success') !!}
    </div>
    @endif

    <table class="table table-hover">
        <thead>
            <tr>
                <th>Nom de stand</th>
                <th>Description</th>
                <th>Etat</th>
                <th>Info</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($getStandMembre as $list_stand_membre)
                <tr>
                    <td>
                        <h6>{{$list_stand_membre->nom_stand}}</h6>
                    </td>
                    <td>{{$list_stand_membre->description_stand}}</td>
                    <td>
                        @if ($list_stand_membre->id_etat == 4)
                            <div class="d-flex align-items-center gap-2">
                                <p class="text-danger fw-semibold">Non publié</p>
                            </div>
                            <td>
                                <form action="{{route('viewInformationExposition')}}" method="get">
                                    <input type="submit" value="Voir les information" class="btn btn-outline-dark m-1">
                                </form>

                            </td>
                            <td>
                                <form action="{{route('publication')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="id_stand" value="{{$list_stand_membre->id_stand}}">
                                    <input type="submit" value="Publier le stand" class="btn btn-primary">
                                </form>
                            </td>
                            <td>
                                <form action="{{route('viewModifierStand')}}" method="get">
                                    <input type="hidden" name="id_stand" value="{{$list_stand_membre->id_stand}}">
                                    <input type="submit" value="Modifier" class="btn btn-outline-dark m-1">
                                </form>
                            </td>
                            <td>
                                <form action="{{route('supprimerStand')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="id_stand" value="{{$list_stand_membre->id_stand}}">
                                    <input type="submit" value="Supprimer" class="btn btn-outline-dark m-1">
                                </form>
                            </td>
                        @else
                            <div class="d-flex align-items-center gap-2">
                                <p class="text-success fw-semibold">Publié</p>
                            </div>
                            <td>
                                <form action="{{route('viewInformationExposition')}}" method="get">

                                    <input type="submit" value="Voir les information" class="btn btn-outline-dark m-1">
                                </form>

                            </td>
                            <td>

                                <form action="{{route('supprimerStand')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id_stand" value="{{$list_stand_membre->id_stand}}">
                                    <input type="submit" value="Supprimer" class="btn btn-outline-dark m-1">
                                </form>
                            </td>

                        @endif
                    </td>
                </tr>
            @endforeach


        </tbody>
    </table>
</div>


@endsection
