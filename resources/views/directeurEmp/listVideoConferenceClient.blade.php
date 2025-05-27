@extends('parent.parentDirecteurEmp')
@section('listConferenceClientSection')
<h1>Liste des video conference client</h1>

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
                <th>Date</th>
                <th>liens de la video</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($listVideoConferenceClient as $list_listVideoConferenceClient)
                <tr>
                    <td>Date conference client</td>
                    <td>{{$list_listVideoConferenceClient->date_debut_conference_client}}</td>
                    <td>{{$list_listVideoConferenceClient->liens_video}}</td>

                    <td>
                        @if (\Carbon\Carbon::parse($list_listVideoConferenceClient->date_debut_conference_client)->isFuture())
                        @else
                            <span class="text-muted">(date dépassée)</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection