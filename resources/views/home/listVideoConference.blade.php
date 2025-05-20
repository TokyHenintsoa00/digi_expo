@extends('parent.parentHome')
@section('linkVideoSection')

<h2>Liste des prochaines conférences</h2>

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
                <th>Titre de la vidéoconférence</th>
                <th>Type de conférence </th>
                <th>Catégorie</th>
                <th>Date prévue</th>
                <th>Liens</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($videoConference as $videoConferences)
                @if (\Carbon\Carbon::parse($videoConferences->date_heure_salle_conference)->isFuture())
                <tr>
                    <td>{{ $videoConferences->titre_video }}</td>
                    <td>{{ $videoConferences->nom_type }}</td>
                    <td>{{ $videoConferences->nom_type_conference }}</td>
                    <td>{{ $videoConferences->date_heure_salle_conference }}</td>
                    <td>
                        @if ($videoConferences->liens_video == null)
                            <span class="text-danger fw-semibold">Pas encore de lien vidéo</span>
                        @else
                            {{ $videoConferences->liens_video }}
                        @endif
                    </td>

                </tr>
                @endif

            @endforeach
        </tbody>
    </table>
</div>


@endsection