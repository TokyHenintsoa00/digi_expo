@extends('parent.parentDirecteurEmp')
@section('listTemoignageSection')


<h2>Liens de vidéo</h2>

<div class="col-13">

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
                <th>Titre</th>
                <th>Exposition</th>
                <th>date de temoignage</th>
                <th>liens de la video</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($temoignage as $list_temoignage)
                <tr>
                    <td>{{{$list_temoignage->titre}}}</td>
                    <td>{{$list_temoignage->nom_stand}}</td>
                    <td>{{$list_temoignage->date_temoignage}}</td>
                    <td>
                        @if ($list_temoignage->liens_video == null)
                            <span class="text-danger fw-semibold">Pas encore de liens de video</span>
                        @else
                            {{ $list_temoignage->liens_video }}
                        @endif
                    </td>
                    <td>
                        @if (\Carbon\Carbon::parse($list_temoignage->date_temoignage)->isFuture())
                            <div class="d-flex gap-2">
                                @if ($list_temoignage->liens_video != null)
                                    <form action="{{route('viewModificationemoignage')}}" method="get">
                                        <input type="hidden" name="id_temoignage" value="{{ $list_temoignage->id_temoignage }}">
                                        <input type="submit" class="btn btn-primary" value="Modifier">
                                    </form>
                                @else
                                    <form action="{{route('viewAjoutLiensTemoignage')}}" method="get">
                                        <input type="hidden" name="id_temoignage" value="{{ $list_temoignage->id_temoignage }}">
                                        <input type="submit" class="btn btn-primary" value="Ajouter un lien">
                                    </form>
                                @endif
                            </div>
                        @else
                            <span class="text-muted">Modification non autorisée (date dépassée)</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection