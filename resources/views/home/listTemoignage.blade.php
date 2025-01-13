@extends('parent.parentHome')
@section('listTemoignageSection')



<h2>Liste des prochaine video conference</h2>

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
                <th>Titre de video Conference</th>
                <th>Type</th>
                <th>Date de membre</th>
                <th>Liens</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($getAllTemoignage as $getAllTemoignages)
                @if (\Carbon\Carbon::parse($getAllTemoignages->date_temoignage)->isFuture())
                <tr>
                    <td>{{ $getAllTemoignages->titre }}</td>
                    <td>{{ $getAllTemoignages->nom_stand }}</td>
                    <td>{{ $getAllTemoignages->date_temoignage}}</td>
                    <td>
                        @if ($getAllTemoignages->liens_video == null)
                            <span class="text-danger fw-semibold">Pas encore de liens de video</span>
                        @else
                            {{ $getAllTemoignages->liens_video }}
                        @endif
                    </td>

                </tr>
                @endif

            @endforeach
        </tbody>
    </table>
</div>


@endsection