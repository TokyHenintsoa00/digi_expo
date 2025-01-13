@extends('parent.parentEmp')
@section('standEmpSection')
<h1>Liste des stands non publiés et publiés</h1>


<div class="col-10">
    <h1>de stand</h1>
    @if (session('success'))
    <div class="alert alert-success" role="alert">
        {!! session('success') !!}
    </div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nom de stand</th>
                <th>Description</th>
                <th>Etat</th>
              
            </tr>
        </thead>
        <tbody>
            @foreach ($standMembre as $list_stand_membre)
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

                        @else
                            <div class="d-flex align-items-center gap-2">
                                <p class="text-success fw-semibold">Publié</p>
                            </div>


                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>


@endsection