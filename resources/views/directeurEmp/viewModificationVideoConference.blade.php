@extends('parent.parentDirecteurEmp')
@section('modificationVideoConferenceSection')

<h2>Modification de liens de vidéo</h2>

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
                <th>Type de conference</th>
                <th>Date de commencement</th>
                <th>Liens</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($videoConference as $videoConferences)
                <tr>
                    <td>{{ $videoConferences->titre_video }}</td>
                    <td>{{ $videoConferences->nom_type }}</td>
                    <td>{{ $videoConferences->nom_type_conference }}</td>
                    <td>{{ $videoConferences->date_heure_salle_conference }}</td>
                    <td>
                        @if ($videoConferences->liens_video == null)
                            <span class="text-danger fw-semibold">Pas encore de liens de video</span>
                        @else
                            {{ $videoConferences->liens_video }}
                        @endif
                    </td>
                    <td>
                        @if (\Carbon\Carbon::parse($videoConferences->date_heure_salle_conference)->isFuture())
                            <div class="d-flex gap-2">
                                @if ($videoConferences->liens_video != null)
                                    <form action="{{ route('viewFormulaireModificationVideoConference') }}" method="get">
                                        <input type="hidden" name="id_salle_conference" value="{{ $videoConferences->id_salle_conference }}">
                                        <input type="submit" class="btn btn-primary" value="Modifier">
                                    </form>
                                @else
                                    <form action="{{ route('viewAddLinkVideo') }}" method="get">
                                        <input type="hidden" name="id_salle_conference" value="{{ $videoConferences->id_salle_conference }}">
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
