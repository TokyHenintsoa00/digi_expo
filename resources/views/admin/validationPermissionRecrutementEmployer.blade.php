@extends('parent.ParentAdmin')
@section('recrutementEmpSection')
<h1>Liste de validation de recrutement</h1>
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
                <th>Nom</th>
                <th>Prenom</th>
                <th>Date naissance</th>
                <th>Email</th>
                <th>Stand</th>
                <th>etat</th>
                <th>Validation</th>
                <th>Refuse</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($recrutement as $list_recrutement)
                <tr>
                    <td>{{$list_recrutement->nom_emp}}</td>
                    <td>{{$list_recrutement->prenom_emp}}</td>
                    <td>{{$list_recrutement->date_naissance}}</td>
                    <td>{{$list_recrutement->email}}</td>
                    <td>{{$list_recrutement->nom_stand}}</td>
                    <td>
                        @if ($list_recrutement->id_etat ==1)
                        <div class="d-flex align-items-center gap-2">
                            <p class="text-danger fw-semibold">En attente</p>
                        </div>
                        @endif
                    </td>
                    <td>
                        <form id="validationForm" action="{{route('validationRecrutement')}}" method="POST" onsubmit="event.preventDefault(); sendNotification();">
                            @csrf
                            <input type="hidden" name="nom_emp" value="{{$list_recrutement->nom_emp}}">
                            <input type="hidden" name="prenom_emp" value="{{$list_recrutement->prenom_emp}}">
                            <input type="hidden" name="date_naissance" value="{{$list_recrutement->date_naissance}}">
                            <input type="hidden" name="email" value="{{$list_recrutement->email}}">
                            <input type="hidden" name="id_stand" value="{{$list_recrutement->id_stand}}">
                            <input type="hidden" name="nom_stand" value="{{$list_recrutement->nom_stand}}">
                            <input type="hidden" name="id_permission_recrutement_emp" value="{{$list_recrutement->id_permission_recrutement_emp}}">
                            <input type="hidden" id="id_expediteur" name="id_expediteur" value="{{$list_recrutement->id_expediteur}}">
                            <input type="hidden" name="expediteur" value="{{$list_recrutement->id_expediteur}}">
                            <input type="submit" value="Valider" class="btn btn-success m-1">
                        </form>
                    </td>
                    <td>
                        {{-- <form action="{{route('refusDeRecrutement')}}" method="POST">
                            @csrf
                            <input type="hidden" name="prenom_emp" value="{{$list_recrutement->prenom_emp}}">
                            <input type="hidden" name="id_expediteur" value="{{$list_recrutement->id_expediteur}}">
                            <input type="hidden" name="id_permission_recrutement_emp" value="{{$list_recrutement->id_permission_recrutement_emp}}">
                            <input type="submit" value="Refuser" class="btn btn-danger m-1">
                        </form> --}}
                        <button
                            class="btn btn-danger m-1 btn-refuser"
                            data-id_permission="{{$list_recrutement->id_permission_recrutement_emp}}"
                            data-id_directeur="{{$list_recrutement->id_expediteur}}">
                            Refuser
                        </button>
                    </td>

                </tr>
            @endforeach

        </tbody>
    </table>
</div>
<script>
    function sendNotification()
    {
        const sender = 6;
        const receiver = document.getElementById("id_expediteur").value;
        const content = "Votre permission de recrutement a ete approuver";

        let currentDate = new Date();
        // Convertir la date actuelle en chaîne de caractères
        let dateString = currentDate.toString();

        const url = `http://127.0.0.1:8000/directeur/viewListEmpAndNombreEmpParStand`;

        fetch('http://localhost:8080/api/notifications/send', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(
            {   sender: sender,
                receiver: receiver,
                content: content ,
                dateNotification:dateString,
                url:url
            })
    }).then(() => {
            document.getElementById('validationForm').submit();
        }).catch(error => {
            console.error("Erreur lors de l'envoi de la notification:", error);
            document.getElementById('validationForm').submit();
        });

    }
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.btn-refuser').forEach(button => {
        button.addEventListener('click', async function () {

            const id_permission = this.dataset.id_permission;
            const id_directeur = this.dataset.id_directeur;
            const csrfToken = '{{ csrf_token() }}';


            try {
                // Étape 1 : Appel vers /refusPhoto
                let response1 = await fetch("{{ route('refusDeRecrutement') }}", {
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