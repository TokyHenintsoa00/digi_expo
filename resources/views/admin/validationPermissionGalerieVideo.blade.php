@extends('parent.ParentAdmin')
@section('galerieVideoSection')

<h1>Liste de validation des galerie photos</h1>

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
                <th>Titre video</th>
                <th>Directeur</th>
            </tr>
        </thead>
        <tbody>
             @foreach ($permissionGalerieVideo as $list_galerie_video)
                <tr>
                    <td>{{$list_galerie_video->nom_stand}}</td>
                    <td>{{$list_galerie_video->titre_video }}</td>
                    <td>{{$list_galerie_video->prenom_emp }}</td>
                    <td>
                        @if ($list_galerie_video->id_etat ==1)
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
                        <form id="validationForm" action="{{route('validePermissionGalerieVideo')}}" method="POST">
                            @csrf

                                <input type="hidden" name="id_stand" value="{{$list_galerie_video->id_stand}}">
                                <input type="hidden" name="description_video" value="{{$list_galerie_video->description_video}}">
                                <input type="hidden" name="titre_video" value="{{$list_galerie_video->titre_video}}">
                                <input type="hidden" name="file_video" value="{{$list_galerie_video->file_video}}">
                                <input type="hidden" name = "id_directeur" value="{{$list_galerie_video->id_directeur}}">
                                <input type="hidden" name = "id_permission_gallerie_video" value="{{$list_galerie_video->id_permission_gallerie_video}}">
                                <input type="hidden" name="id_video_contenue" value="{{$list_galerie_video->id_video_contenue}}">
                                <input type="hidden" name="id_etat" value="{{$list_galerie_video->id_etat}}">

                                <input type="submit" value="Valider" class="btn btn-success m-1">
                        </form>
                    </td>
                    <td>
                        {{-- <form action="#" method="POST">
                            @csrf
                              <input type="hidden" name="id_stand" value="{{$list_galerie_video->id_stand}}">
                                <input type="hidden" name="description_video" value="{{$list_galerie_video->description_video}}">
                                <input type="hidden" name="titre_video" value="{{$list_galerie_video->titre_video}}">
                                <input type="hidden" name="file_video" value="{{$list_galerie_video->file_video}}">
                                <input type="hidden" name = "id_directeur" value="{{$list_galerie_video->id_directeur}}">
                                <input type="hidden" name = "id_permission_gallerie_video" value="{{$list_galerie_video->id_permission_gallerie_video}}">
                                <input type="hidden" name="id_video_contenue" value="{{$list_galerie_video->id_video_contenue}}">
                                <input type="hidden" name="id_etat" value="{{$list_galerie_video->id_etat}}">

                                <input type="submit" value="Refuser" class="btn btn-danger m-1">
                        </form> --}}

                        <button
                            class="btn btn-danger m-1 btn-refuser"
                            data-id_permission="{{$list_galerie_video->id_permission_gallerie_video}}"
                            data-id_directeur="{{$list_galerie_video->id_directeur}}">
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
                let response1 = await fetch("{{ route('refusVideo') }}", {
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