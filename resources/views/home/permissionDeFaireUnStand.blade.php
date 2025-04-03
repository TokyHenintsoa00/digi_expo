{{--
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Disposition en Grid</title>
    <style>
        .grid-container, .grid-container2 {
            display: grid;
            grid-template-columns: repeat(11, 50px);
            grid-template-rows: repeat(8, 50px);
            gap: 2px;
            justify-content: center;
            align-items: center;
            margin-top: -5%;
            padding: 100px;
            margin-left: -35%;
        }

        .stand, .sponsor {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
            font-size: 12px;
        }

        .stand { background-color: #10a579; }
        .sponsor { background-color: #d8c7e8; font-weight: bold; }

        .haut {
            grid-column: 3 / span 3;
            grid-row: 4;
            text-align: center;
            font-weight: bold;
            border: 1px solid black;
            padding: 5px;
        }

        .main-areas {
            width: 250px;
            height: 20px;
            border: 1px solid black;
            text-align: center;
            line-height: 20px;
            font-weight: bold;
            margin: 2% auto;
        }

        .container {
            display: flex;
            align-items: flex-start;
            margin-left: 50%;
            margin-top: -57%;
        }

        .side-panel {
            display: flex;
            flex-direction: column;
            background-color: #10a579;
        }

        .side-panel div {
            background-color: #10a579;
            border: 1px solid white;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 64px;
            height: 50px;
        }

        .main-area, .main-area1 {
            width: 130px;
            height: 400px;
            border: 1px solid black;
            margin-top: 30px;
        }

        .main-area1 { margin-left: 50px; }
    </style>
</head>
<body>
    <div class="main-areas">Entrer</div>
    <div class="grid-container">
       <!-- Première ligne de stands -->
       <div class="stand" style="grid-column: 1; grid-row: 2;"></div>
       <div class="stand"style="grid-column: 2; grid-row: 1;"></div>
       <div class="stand"style="grid-column: 3; grid-row: 1;"></div>
       <div class="stand"style="grid-column: 4; grid-row: 1;"></div>
       <div class="stand"style="grid-column: 5; grid-row: 1;"></div>
       <div class="stand"style="grid-column: 6; grid-row: 1;"></div>
       <div class="stand"style="grid-column: 7; grid-row: 1;"></div>
       <div class="stand"style="grid-column: 8; grid-row: 1;"></div>
       <div class="stand"style="grid-column: 9; grid-row: 1;"></div>
       <div class="stand"style="grid-column: 10; grid-row: 1;"></div>


       <!-- Stands verticaux gauche -->
       <div class="stand" style="grid-column: 1; grid-row: 1;"></div>
       <div class="stand" style="grid-column: 1; grid-row: 2;"></div>
       <div class="stand" style="grid-column: 1; grid-row: 3;"></div>
       <div class="stand" style="grid-column: 1; grid-row: 4;"></div>
       <div class="stand" style="grid-column: 1; grid-row: 5;"></div>
       <div class="stand" style="grid-column: 1; grid-row: 6;"></div>
       <div class="stand" style="grid-column: 1; grid-row: 7"></div>
       <div class="stand" style="grid-column: 1; grid-row: 8"></div>


       <!-- Dernière ligne de stands -->
       <div class="stand" style="grid-column: 2; grid-row: 8;"></div>
       <div class="stand" style="grid-column: 3; grid-row: 8;"></div>
       <div class="stand" style="grid-column: 4; grid-row: 8;"></div>
       <div class="stand" style="grid-column: 5; grid-row: 8;"></div>
       <div class="stand" style="grid-column: 6; grid-row: 8;"></div>
       <div class="stand" style="grid-column: 7; grid-row: 8;"></div>
       <div class="stand" style="grid-column: 8; grid-row: 8;"></div>
       <div class="stand" style="grid-column: 9; grid-row: 8;"></div>
       <div class="stand" style="grid-column: 10; grid-row: 8;"></div>

       <!-- Stands sponsors à droite -->
       <div class="sponsor" style="grid-column: 11; grid-row: -10;">Sponsor</div>
       <div class="sponsor" style="grid-column: 11; grid-row: 1;">FOSP</div>
       <div class="sponsor" style="grid-column: 11; grid-row: 2;">CAM</div>
       <div class="sponsor" style="grid-column: 11; grid-row: 3;">ENS</div>
       <div class="sponsor" style="grid-column: 11; grid-row: 4;">AGRO</div>
       <div class="sponsor" style="grid-column: 11; grid-row: 5;">DAE</div>
       <div class="sponsor" style="grid-column: 11; grid-row: 6;">DAE</div>
       <div class="sponsor" style="grid-column: 11; grid-row: 7;">DAE</div>
       <div class="sponsor" style="grid-column: 11; grid-row: 8;">DAE</div>

        <!-- Étiquette centrale -->
        <div class="haut">HAUT</div>
    </div>

    <div class="grid-container2">
        <div class="stand" style="grid-column: 1; grid-row: 2;"></div>
       <div class="stand"style="grid-column: 2; grid-row: 1;"></div>
       <div class="stand"style="grid-column: 3; grid-row: 1;"></div>
       <div class="stand"style="grid-column: 4; grid-row: 1;"></div>
       <div class="stand"style="grid-column: 5; grid-row: 1;"></div>
       <div class="stand"style="grid-column: 6; grid-row: 1;"></div>
       <div class="stand"style="grid-column: 7; grid-row: 1;"></div>
       <div class="stand"style="grid-column: 8; grid-row: 1;"></div>
       <div class="stand"style="grid-column: 9; grid-row: 1;"></div>
       <div class="stand"style="grid-column: 10; grid-row: 1;"></div>


       <!-- Stands verticaux gauche -->
       <div class="stand" style="grid-column: 1; grid-row: 1;"></div>
       <div class="stand" style="grid-column: 1; grid-row: 2;"></div>
       <div class="stand" style="grid-column: 1; grid-row: 3;"></div>
       <div class="stand" style="grid-column: 1; grid-row: 4;"></div>
       <div class="stand" style="grid-column: 1; grid-row: 5;"></div>
       <div class="stand" style="grid-column: 1; grid-row: 6;"></div>
       <div class="stand" style="grid-column: 1; grid-row: 7"></div>
       <div class="stand" style="grid-column: 1; grid-row: 8"></div>


       <!-- Dernière ligne de stands -->
       <div class="stand" style="grid-column: 2; grid-row: 8;"></div>
       <div class="stand" style="grid-column: 3; grid-row: 8;"></div>
       <div class="stand" style="grid-column: 4; grid-row: 8;"></div>
       <div class="stand" style="grid-column: 5; grid-row: 8;"></div>
       <div class="stand" style="grid-column: 6; grid-row: 8;"></div>
       <div class="stand" style="grid-column: 7; grid-row: 8;"></div>
       <div class="stand" style="grid-column: 8; grid-row: 8;"></div>
       <div class="stand" style="grid-column: 9; grid-row: 8;"></div>
       <div class="stand" style="grid-column: 10; grid-row: 8;"></div>

       <!-- Stands sponsors à droite -->
       <div class="stand" style="grid-column: 11; grid-row: 1;">FOSP</div>
       <div class="stand" style="grid-column: 11; grid-row: 2;">CAM</div>
       <div class="stand" style="grid-column: 11; grid-row: 3;">ENS</div>
       <div class="stand" style="grid-column: 11; grid-row: 4;">AGRO</div>
       <div class="stand" style="grid-column: 11; grid-row: 5;">DAE</div>
       <div class="stand" style="grid-column: 11; grid-row: 6;">DAE</div>
       <div class="stand" style="grid-column: 11; grid-row: 7;">DAE</div>
       <div class="stand" style="grid-column: 11; grid-row: 8;">DAE</div>

    </div>
     <div class="container">
         <div class="side-panel">
             <div>Sponsor</div>
             <div>Medc</div>
             <div>Mudc</div>
             <div>Poly</div>
             <div>E6S</div>
             <div>BAU/CR<br>EF</div>
             <div>IESSI</div>
             <div>ESAV</div>
             <div>STICOM</div>
         </div>
         <div class="main-area"></div>
         <div class="main-area1">Presidence</div>

     </div>
 </body>
 </html>


 --}}


 @extends('parent.parentHome')
 @section('permissionDeFaireUnStandSection')

 {{-- <style>
     .expo-container {
         display: flex;
         flex-wrap: wrap;
         gap: 15px;
         justify-content: center;
         margin-top: 20px;
     }
     .stand {
         width: 120px;
         height: 120px;
         display: flex;
         align-items: center;
         justify-content: center;
         border-radius: 10px;
         font-weight: bold;
         cursor: pointer;
         box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
         transition: transform 0.2s, box-shadow 0.2s;
     }
     .stand:hover {
         transform: scale(1.1);
         box-shadow: 4px 4px 15px rgba(0, 0, 0, 0.2);
     }
     .available {
         background-color: #4CAF50;
         color: white;
     }
     .occupied {
         background-color: #E74C3C;
         color: white;
     }
     .reserved {
         background-color: #F39C12;
         color: white;
     }

     .legend {
         display: flex;
         align-items: center;
         gap: 15px;
         margin-top: 15px;
     }

     .legend div {
         display: flex;
         align-items: center;
         gap: 5px;
     }

     .legend-box {
         width: 20px;
         height: 20px;
         border-radius: 4px;
     }

     .selected {
         transform: scale(1.1);
         box-shadow: 4px 4px 15px rgba(0, 0, 0, 0.3);
     }

     .grid-container {
             display: grid;
             grid-template-columns: repeat(11, 60px);
             grid-template-rows: repeat(8, 60px);
             gap: 2px;
             justify-content: center;
             align-items: center;
             margin: auto;
             padding: 200px;
         }
         .stand {
             background-color: #23b02b;
             border: 1px solid black;
             display: flex;
             align-items: center;
             justify-content: center;
             width: 60px;
             height: 60px;
         }
         .sponsor {
             background-color: #d8c7e8;
             font-weight: bold;
             border: 1px solid black;
             display: flex;
             align-items: center;
             justify-content: center;
             width: 60px;
             height: 60px;
         }
         .haut {
             grid-column: 3 / span 3;
             grid-row: 4;
             text-align: center;
             font-weight: bold;
             border: 1px solid black;
             padding: 10px;
         }
 </style> --}}


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
                             </div>
                             <input type="submit" value="Soumettre" class="btn btn-primary">
                         </form>
                 </div>
             </div>
         </div>
     </div>
 </div>
 {{-- <script>
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
 </script> --}}
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
