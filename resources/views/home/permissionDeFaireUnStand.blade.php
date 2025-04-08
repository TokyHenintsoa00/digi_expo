@extends('parent.parentHome')
@section('permissionDeFaireUnStandSection')
<style>
 .stand {
   width: 70px;
   height: 70px;
   border: 1px solid #0e4e20;
   display: flex;
   align-items: center;
   justify-content: center;
   font-size: 12px;
   background-color: #15a141;
   color: white;
   border-radius: 8px;
   box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
   transition: transform 0.2s, background-color 0.3s;
   cursor: pointer;
 }

 .stand:hover {
   transform: scale(1.05);
   background-color: #128a39;
 }

 .demo {
   background-color: #1c9643;
 }

 .demo:hover {
   background-color: #157a35;
 }

 .block {
   display: flex;
   flex-direction: column;
   align-items: center;
 }

 .row-custom {
   display: flex;
 }

 .rectangle,
 .rectangle1 {
   border: 1px solid #333;
   width: 152px;
   height: 635px;
   display: flex;
   justify-content: center;
   align-items: center;
   background-color: #fff;
   font-weight: bold;
   border-radius: 12px;
   box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
 }

 .space {
   height: 10px;
 }

 .title {
   text-align: center;
   margin-bottom: 10px;
   font-weight: bold;
   font-size: 18px;
   color: #333;
 }

 .container-fluid {
   padding-top: 20px;
   padding-bottom: 40px;
 }

 .selected {
        transform: scale(1.1);
        box-shadow: 4px 4px 15px rgba(0, 0, 0, 0.3);
    }
</style>
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
                    {{-- <form id="permissionForm" action="/getInsertPermissionStandEmp" method="POST" enctype="multipart/form-data" onsubmit="event.preventDefault(); sendNotificationDirecteurToAdmin();"> --}}
                        <form id="permissionForm" action="#" method="GET" enctype="multipart/form-data" onsubmit="event.preventDefault(); sendNotificationDirecteurToAdmin();">

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

                               <div class="container-fluid">
                                   <div class="row" style="margin-left: 60px">
                                     <!-- Bloc HAUT -->
                                      <div class="col-auto align-self-end">
                                       <!-- Ligne du haut -->
                                       <div class="d-flex">
                                         <div class="stand"></div>
                                         <div class="stand"></div>
                                         <div class="stand"></div>
                                         <div class="stand"></div>
                                         <div class="stand"></div>
                                         <div class="stand"></div>
                                         <div class="stand"></div>
                                         <div class="stand"></div>
                                         <div class="stand"></div>
                                         <div class="stand"></div>
                                       </div>
                                       <!-- Ligne de gauche -->
                                       <div class="d-flex">
                                         <div class="block">
                                           <div class="stand"></div>
                                           <div class="stand"></div>
                                           <div class="stand"></div>
                                           <div class="stand"></div>
                                           <div class="stand"></div>
                                           <div class="stand"></div>
                                         </div>
                                         <div class="mx-2 d-flex align-items-center justify-content-center" style="width: 280px; height: 80px; border: 1px solid black; margin-top:50px">
                                           HAUT
                                         </div>
                                       </div>
                                       <!-- Ligne du bas -->
                                       <div class="d-flex">
                                         <div class="stand"></div>
                                         <div class="stand"></div>
                                         <div class="stand"></div>
                                         <div class="stand"></div>
                                         <div class="stand"></div>
                                         <div class="stand"></div>
                                         <div class="stand"></div>
                                         <div class="stand"></div>
                                         <div class="stand"></div>
                                         <div class="stand"></div>
                                       </div>
                                     </div>

                                     <!-- Bloc démonstration et stands verticaux -->
                                     <div class="col-auto align-self-end ms-n5 ms-lg-n6" style="margin-left: -25px;">
                                       <div class="title">ENTRÉE</div>
                                       <div class="row-custom">
                                         <!-- Colonne gauche démonstration -->
                                         <div class="block" style="margin-left:-15px">
                                           <div class="stand demo">Sponsor</div>
                                           <div class="stand demo">FOSP</div>
                                           <div class="stand demo">CAM</div>
                                           <div class="stand demo">ENS</div>
                                           <div class="stand demo">AGRO</div>
                                           <div class="stand demo">DAE</div>
                                           <div class="stand demo">DAE</div>
                                           <div class="stand demo">DAE</div>
                                           <div class="stand demo">DAE</div>
                                         </div>
                                         <div style="width: 10px;"></div>
                                         <!-- Colonne droite démonstration -->
                                         <div class="block">
                                           <div class="stand demo">Sponsor</div>
                                           <div class="stand demo">Medc</div>
                                           <div class="stand demo">Mùdc</div>
                                           <div class="stand demo">Poly</div>
                                           <div class="stand demo">EGS</div>
                                           <div class="stand demo">BAU/CR EF</div>
                                           <div class="stand demo">IESSI</div>
                                           <div class="stand demo">ESAV</div>
                                           <div class="stand demo">STICOM</div>
                                         </div>
                                       </div>
                                     </div>
                                     <!-- Présidence -->
                                     <div class="col-auto">
                                      <div class="d-flex flex-row flex-nowrap" style="margin-top: 32px;">

                                          <div class="rectangle me-2"
                                              style="height: 490px; margin-top: 145px; margin-left: -24px; flex-shrink: 0; min-width: 60px;">
                                          </div>

                                          <div class="rectangle"
                                              style="height: 490px; margin-top: 145px; margin-left: 24px; flex-shrink: 0; min-width: 100px;">
                                              Présidence
                                          </div>

                                      </div>

                                  </div>
                               </div>


                                   <div class="d-flex" style="margin-top: 90px; margin-left:75px">
                                      <div class="stand"></div>

                                      <div class="stand"></div>
                                      <div class="stand"></div>
                                      <div class="stand"></div>
                                      <div class="stand"></div>
                                      <div class="stand"></div>
                                      <div class="stand"></div>
                                      <div class="stand"></div>
                                      <div class="stand"></div>
                                      <div class="stand"></div>



                                    </div>


                                    <div class="d-flex">
                                      <div class="block" style="margin-left:74.4px">
                                        <div class="stand"></div>
                                        <div class="stand"></div>
                                        <div class="stand"></div>
                                        <div class="stand"></div>
                                        <div class="stand"></div>
                                        <div class="stand"></div>
                                        <div class="stand"></div>
                                        <div class="stand"></div>
                                      </div>
                                    </div>


                                    <div class="d-flex" style="margin-left:144px; margin-top:-70px" >
                                      <div class="stand"></div>
                                      <div class="stand"></div>
                                      <div class="stand"></div>
                                      <div class="stand"></div>
                                      <div class="stand"></div>
                                      <div class="stand"></div>
                                      <div class="stand"></div>
                                      <div class="stand"></div>
                                      <div class="stand"></div>
                                      <div class="stand"></div>

                                    </div>

                                    <div class="d-flex flex-column" style="margin-left: 775px; margin-top:-630px">
                                      <div class="stand">Sponsor</div>
                                      <div class="stand">FOSP</div>
                                      <div class="stand">CAM</div>
                                      <div class="stand">ENS</div>
                                      <div class="stand">AGRO</div>
                                      <div class="stand">DAE</div>
                                      <div class="stand">DAE</div>
                                      <div class="stand">DAE</div>

                                   </div>
                                     <input type="hidden" id="selectedStand" name="place_stand" required>

                               </div>

                            </div>
                            <br>
                            <br>

                            <br>
                            <br>
                            <br>
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
