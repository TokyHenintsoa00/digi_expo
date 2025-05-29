@extends('parent.ParentAdmin')
@section('validationPermissionConference')

<h1>Liste de validation de confenrence</h1>

<div class="col-12" style="overflow-x: auto;">

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
                <th>Titre video</th>
                <th>Type video</th>
                <th>Type de confenrence</th>
                <th>Directeur</th>
                <th>Date de confenrence</th>
                <th>liens</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($permissionConference as $list_permissionConference)
                <tr>
                    <td>{{$list_permissionConference->titre_video }}</td>
                    <td>{{$list_permissionConference->nom_type }}</td>
                    <td>{{$list_permissionConference->nom_type_conference }}</td>
                    <td>{{$list_permissionConference->prenom_emp}}</td>
                    <td>{{$list_permissionConference->date_heure_salle_conference  }}</td>
                    <td>{{$list_permissionConference->liens_video  }}</td>
                    <td>
                        @if ($list_permissionConference->id_etat ==1)
                        <div class="d-flex align-items-center gap-2">
                            <p class="text-danger fw-semibold">En attente</p>
                        </div>
                        @else
                        <div class="d-flex align-items-center gap-2">
                            <p class="text-warning fw-semibold">Modification</p>
                        </div>
                        @endif
                    </td>
                    <td>
                        <form id="validationForm" action="{{route('validationPermissionConference')}}" method="POST">
                            @csrf
                                <input type="hidden" name="id_etat" value="{{$list_permissionConference->id_etat}}">
                                <input type="hidden" name="titre_video" value="{{$list_permissionConference->titre_video}}">
                                <input type="hidden" name="id_type_conference" value="{{$list_permissionConference->id_type_conference}}">
                                <input type="hidden" name="date_heure_salle_conference" value="{{$list_permissionConference->date_heure_salle_conference}}">
                                <input type="hidden" name="liens_video" value="{{$list_permissionConference->liens_video}}">
                                <input type="hidden" name="id_type_video" value="{{$list_permissionConference->id_type_video}}">
                                <input type="hidden" name="id_directeur" value="{{$list_permissionConference->id_directeur}}">
                                <input type="hidden" name="id_permission_video_conference" value="{{$list_permissionConference->id_permission_video_conference }}">
                                <input type="hidden" name="id_salle_conference" value="{{$list_permissionConference->id_salle_conference  }}">


                                <input type="submit" value="Valider" class="btn btn-success m-1">
                        </form>
                    </td>
                    <td>
                        <button
                            class="btn btn-danger m-1 btn-refuser"
                            data-id_permission="{{$list_permissionConference->id_permission_video_conference }}"
                            data-id_directeur="{{$list_permissionConference->id_directeur}}">
                            Refuser
                        </button>

                    </td>

                </tr>
            @endforeach

        </tbody>
    </table>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.btn-refuser').forEach(button => {
        button.addEventListener('click', async function () {

            const id_permission = this.dataset.id_permission;
            const id_directeur = this.dataset.id_directeur;
            const csrfToken = '{{ csrf_token() }}';


            try {
                // Étape 1 : Appel vers /refusPhoto
                let response1 = await fetch("{{ route('refusDeConference') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": csrfToken
                    },
                    body: JSON.stringify({
                        id_permission_galerie: id_permission
                    })
                });

                if (!response1.ok) throw new Error("Échec de refusPhoto");

                // Étape 2 : Appel vers /refusPermission
                let response2 = await fetch("{{ route('refusPermission') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": csrfToken
                    },
                    body: JSON.stringify({
                        id_directeur: id_directeur
                    })
                });

                if (!response2.ok) throw new Error("Échec de refusPermission");

                alert("Refus effectué avec succès.");
                location.reload();

            } catch (error) {
                console.error(error);
                alert("Une erreur est survenue.");
            }
        });
    });
});
</script>
@endsection