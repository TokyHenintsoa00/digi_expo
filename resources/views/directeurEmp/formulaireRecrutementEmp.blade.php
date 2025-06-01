@extends('parent.parentDirecteurEmp')
@section('formulaireRecrutementSection')
<link rel="stylesheet" href="{{asset('assets2/css/feather.css')}}">
<!-- Date Range Picker CSS -->
<link rel="stylesheet" href="{{asset('assets2/css/daterangepicker.css')}}">
<!-- App CSS -->
<link rel="stylesheet" href="{{asset('assets2/css/simplebar.css')}}">

<div class="row">
    <div class="col-md-12">
        <div class="card shadow mb-4">
            <div class="card-header">
                <strong class="card-title">Formulaire de recrutement de nouvelle éditeur de stand</strong>
            </div>
            <div class="card-body">
                  <!-- Afficher le message de succès -->
                   <!-- Afficher le message de succès -->
                   @if (session('success'))
                   <div class="alert alert-success" role="alert">
                       {!! session('success') !!}
                   </div>
                   @endif
                   <form id="permissionForm" action="{{route('recrutementEmp')}}" method="POST" onsubmit="event.preventDefault(); sendNotificationRecrutement();">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6 mb-3">
                            <label for="inputEmail4">Nom</label>
                            <input type="text" class="form-control" id="inputEmail5" name="nom_emp">
                        </div>
                        <div class="form-group col-md-6 mb-3">
                            <label for="inputEmail4">Prenom </label>
                            <input type="text" class="form-control" id="inputEmail5" name="prenom_emp">
                        </div>
                        <div class="form-group col-md-6 mb-3">
                            <label for="inputEmail4">Email </label>
                            <input type="mail" class="form-control" id="inputEmail5" name="email_emp">
                        </div>
                        <div class="form-group col-md-6 mb-3">
                            <label for="inputEmail4">Date de naissance </label>
                            <input type="date" class="form-control" id="inputEmail5" name="date_naissance_emp">
                        </div>
                    </div>
                    <div class="form-group col-md-6 mb-3">
                        <label for="inputPassword4">Stand</label>
                        <select class="form-select" id="faculteSelect" aria-label="Select faculté" name="id_stand">
                            <option selected disabled>Stand de recrutement</option>
                            @foreach ($viewMembreStand as $list_viewMembreStand)
                                <option value="{{$list_viewMembreStand->id_stand}}">{{$list_viewMembreStand->nom_stand}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Envoyer</button>
                </form>
            </div> <!-- /. card-body -->
        </div> <!-- /. card -->
    </div> <!-- /. col -->
</div> <!-- /. end-section -->

<script>
    function sendNotificationRecrutement()
    {
        const sender = 7;
        const receiver = 6;
        const content = "Vous avez recu une nouvelle permission de recrutement"
        // Obtenir la date actuelle
        let currentDate = new Date();
        // Convertir la date actuelle en chaîne de caractères
        let dateString = currentDate.toString();
        let url = `http://127.0.0.1:8000/admin/viewValidationRecrutementEmp`;
        fetch('http://localhost:8080/api/notifications/directeur/permissionRecrutement/sendNotification', {
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

    // function sendNotificationRecrutement() {
    //     const message = {
    //         sender: 7,
    //         receiver: 6,
    //         content: "Vous avez recu une nouvelle permission de recrutement",
    //         dateNotification: new Date().toISOString(),
    //         url: "http://127.0.0.1:8000/admin/viewValidationRecrutementEmp"
    //     };
    //     // Envoi via le préfixe /app (config Spring)
    //     stompClient.send("/app/notification", {}, JSON.stringify(message));
    // }
</script>
@endsection