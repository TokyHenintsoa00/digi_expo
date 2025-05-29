@extends('parent.ParentAdmin')
@section('videoConferenceClientSection')


<h1>Liste de validation des video avec les clients</h1>

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
                <th>Nom Stand</th>
                <th>Conference</th>
                <th>Date debut de conference</th>
                <th>liens</th>
            </tr>
        </thead>
        <tbody>
             @foreach ($permissionVideoConferenceClient as $list_permissionVideoConferenceClient)
                <tr>
                    <td>{{$list_permissionVideoConferenceClient->nom_stand}}</td>
                    <td>Conference client</td>
                    <td>{{$list_permissionVideoConferenceClient->date_debut_conference_client }}</td>
                    <td>{{$list_permissionVideoConferenceClient->liens_video}}</td>
                    <td>
                        @if ($list_permissionVideoConferenceClient->id_etat ==1)
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
                        <form id="validationForm" action="{{route('validationPermissionVideoConferenceClient')}}" method="POST">
                            @csrf

                                <input type="hidden" name="id_stand" value="{{$list_permissionVideoConferenceClient->id_stand}}">
                                <input type="hidden" name="date_debut_conference_client" value="{{$list_permissionVideoConferenceClient->date_debut_conference_client}}">
                                <input type="hidden" name="id_etat" value="{{$list_permissionVideoConferenceClient->id_etat}}">
                                <input type="hidden" name="liens_video" value="{{$list_permissionVideoConferenceClient->liens_video}}">
                                <input type="hidden" name="id_sallon" value="{{$list_permissionVideoConferenceClient->id_sallon}}">
                                <input type="hidden" name="id_directeur" value="{{$list_permissionVideoConferenceClient->id_directeur}}">
                                <input type="hidden" name="id_permission_video_conferece_client" value="{{$list_permissionVideoConferenceClient->id_permission_video_conferece_client}}">
                                <input type="submit" value="Valider" class="btn btn-success m-1">
                        </form>
                    </td>
                    <td>
                       <button
                            class="btn btn-danger m-1 btn-refuser"
                            data-id_permission="{{$list_permissionVideoConferenceClient->id_permission_video_conferece_client}}"
                            data-id_directeur="{{$list_permissionVideoConferenceClient->id_directeur}}">
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
                let response1 = await fetch("{{ route('refusDeConferenceClient') }}", {
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