@extends('parent.parentHome')
@section('permissionDeFaireUnStandSection')

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Formulaire d'exposition </h5>

            <!-- Afficher le message de succès -->
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

            <div class="card">
                <div class="card-body">
                    <form id="permissionForm" action="/getInsertPermissionStandEmp" method="POST" enctype="multipart/form-data" onsubmit="event.preventDefault(); sendNotificationDirecteurToAdmin();">
                        {{-- <form id="permissionForm" action="#" method="GET" enctype="multipart/form-data" onsubmit="event.preventDefault(); sendNotificationDirecteurToAdmin();"> --}}

                            @csrf
                            <div class="row"> <!-- Row for both forms -->
                                <!-- Formulaire du stand -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="nomStand" class="form-label">Nom de stand</label>
                                        <input type="text" class="form-control" id="nomStand" aria-describedby="nomHelp" name="nom_stand" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="faculteSelect" class="form-label">Votre catégorie</label>
                                        <select class="form-select" id="faculteSelect" aria-label="Select faculté" name="id_categorie" required>
                                            <option selected disabled>Choisissez votre faculté</option>
                                            @foreach ($categorie as $list_categorie)
                                            <option value="{{$list_categorie->id_categorie}}">{{$list_categorie->nom_categorie}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="nomStand" class="form-label">Nom de la catégorie</label>
                                        <input type="text" class="form-control" id="nomStand" aria-describedby="nomHelp" name="nom_categorie_stand" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="descriptionStand" class="form-label">Description du stand</label>
                                        <textarea class="form-control" id="descriptionStand" rows="4" placeholder="Décrivez votre stand ici..." name="description_stand" required></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="emailEmploye" class="form-label">Date de debut de l'exposition</label>
                                        <input type="date" class="form-control" id="emailEmploye" aria-describedby="emailHelp" name="date_debut" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="emailEmploye" class="form-label">Date de fin de l'exposition</label>
                                        <input type="date" class="form-control" id="emailEmploye" aria-describedby="emailHelp" name="date_fin" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="nomStand" class="form-label">image du stand</label>
                                        <input type="file" class="form-control" id="img_stand" name="img_stand" accept="image/*" required>
                                    </div>
                                </div>

                                <!-- Formulaire de l'employé -->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="nomEmploye" class="form-label">Votre nom</label>
                                        <input type="text" class="form-control" id="nomEmploye" aria-describedby="nomHelp" name="nom_employe" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="prenomEmploye" class="form-label">Votre prenom</label>
                                        <input type="text" class="form-control" id="prenomEmploye" aria-describedby="prenomHelp" name="prenom_employe" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="prenomEmploye" class="form-label">Date de naissance</label>
                                        <input type="date" class="form-control" id="prenomEmploye" aria-describedby="prenomHelp" name="date_naissance" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="emailEmploye" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="emailEmploye" aria-describedby="emailHelp" name="email_employe" required>
                                    </div>
                                </div>

                                <!--
                                <div class="grid">


                                    {{-- grid pour les ligne du bas pour le premier plan --}}
                                    <div class="cell" style="grid-column: 3; grid-row: 9;"></div>
                                    <div class="cell" style="grid-column: 4; grid-row: 9;"></div>
                                    <div class="cell" style="grid-column: 5; grid-row: 9;"></div>
                                    <div class="cell" style="grid-column: 6; grid-row: 9;"></div>
                                    <div class="cell" style="grid-column: 7; grid-row: 9;"></div>
                                    <div class="cell" style="grid-column: 8; grid-row: 9;"></div>
                                    <div class="cell" style="grid-column: 9; grid-row: 9;"></div>
                                    <div class="cell" style="grid-column: 10; grid-row: 9;"></div>
                                    {{------------------------------------------------------}}

                                    {{--Grid pour les ligne a droite du premier plan--}}
                                    <div class="cell" style="grid-column: 10; grid-row: 8"></div>
                                    <div class="cell" style="grid-column: 10; grid-row: 7"></div>
                                    <div class="cell" style="grid-column: 10; grid-row: 6"></div>
                                    <div class="cell" style="grid-column: 10; grid-row: 5"></div>
                                    <div class="cell" style="grid-column: 10; grid-row: 4"></div>
                                    <div class="cell" style="grid-column: 10; grid-row: 3"></div>
                                    <div class="cell" style="grid-column: 10; grid-row: 2"></div>
                                    <div class="cell" style="grid-column: 10; grid-row: 1"></div>
                                    {{------------------------------------------------}}

                                    {{--grid pour les ligne du haut du premier pplan--}}
                                    <div class="cell" style="grid-column: 9; grid-row: 2;"></div>

                                </div>
                                -->
                            </div>




                            <input type="submit" value="Soumettre" class="btn btn-primary">
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let stands = document.querySelectorAll(".stand");
        let selectedStandInput = document.getElementById("selectedStand");

        stands.forEach(stand => {
            stand.addEventListener("click", function () {
                stands.forEach(s => s.classList.remove("selected"));
                this.classList.add("selected");
                selectedStandInput.value = this.textContent;
            });
        });
    });
</script>
<script>
    function sendNotificationDirecteurToAdmin()
    {
        const sender = 0;
        const receiver = 6;
        const content = "Vous avez recu une nouvelle permission d'exposition"
        // Obtenir la date actuelle
        let currentDate = new Date();
        // Convertir la date actuelle en chaîne de caractères
        let dateString = currentDate.toString();
        let url = `http://127.0.0.1:8000/admin/viewValidationPermissionStand`;

        fetch('http://localhost:8080/api/notifications/directeurSendAdmin/sendNotification', {
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
            document.getElementById('permissionForm').submit();
        }).catch(error => {
            console.error("Erreur lors de l'envoi de la notification:", error);
            document.getElementById('permissionForm').submit();
        });
    }
</script>
@endsection
