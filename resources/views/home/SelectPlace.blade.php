{{--

<style>
    .grid {
      display: grid;
      grid-template-columns: repeat(90, 60px);
      grid-template-rows: repeat(15, 60px);
      gap: 2px;
    }

    .cell {
      background-color: #36c254;
      display: flex;
      justify-content: center;
      align-items: center;
      font-size: 0.7em;
      font-weight: bold;
      text-align: center;
      padding: 5px;
      border: 1px solid #ccc;
    }

    .fond {
        grid-column:3 / span 3;
        grid-row:3 / span 1;
        background-color: white;
        border:2px solid black;
        font-size: 2em;
    }

    .enter{
        grid-column: 10 / span 2;
        grid-row: 1 / span 1;
        background-color: white;
        border: 2px solid black;
        font-size: 1em;
    }
</style>


<div class="grid">
    <div class=" cell enter">Entrer</div>
    <!-- ligne vertical gauche du premier plan -->
    <div class="cell" style="grid-column: 2; grid-row: 4;">IESSI</div>
    <div class="cell" style="grid-column: 2; grid-row: 5;">IESSI</div>
    <div class="cell" style="grid-column: 2; grid-row: 6;">IESSI</div>
    <div class="cell" style="grid-column: 2; grid-row: 7;">IESSI</div>
    <div class="cell" style="grid-column: 2; grid-row: 8;">IESSI</div>
    <div class="cell" style="grid-column: 2; grid-row: 9;">IESSI</div>
    <div class="cell" style="grid-column: 2; grid-row: 10;">IESSI</div>
    <div class="cell" style="grid-column: 2; grid-row: 11;">IESSI</div>
    <!-------------------------------------------->

    <!-- ligne horizontal bas du premier plan -->
    <div class="cell" style="grid-column: 3; grid-row: 11"></div>
    <div class="cell" style="grid-column: 4; grid-row: 11"></div>
    <div class="cell" style="grid-column: 5; grid-row: 11"></div>
    <div class="cell" style="grid-column: 6; grid-row: 11"></div>
    <div class="cell" style="grid-column: 7; grid-row: 11"></div>
    <div class="cell" style="grid-column: 8; grid-row: 11"></div>
    <div class="cell" style="grid-column: 9; grid-row: 11"></div>
    <div class="cell" style="grid-column: 10; grid-row: 11"></div>
    <div class="cell" style="grid-column: 11; grid-row: 11"></div>
    <div class="cell" style="grid-column: 12; grid-row: 11"></div>
    <!------------------------------------------->

    <!-----------------Ligne verticale droite du premier plan -------------------------->
    <div class="cell" style="grid-column: 12; grid-row: 10"></div>
    <div class="cell" style="grid-column: 12; grid-row: 9"></div>
    <div class="cell" style="grid-column: 12; grid-row: 8"></div>
    <div class="cell" style="grid-column: 12; grid-row: 7"></div>
    <div class="cell" style="grid-column: 12; grid-row: 6"></div>
    <div class="cell" style="grid-column: 12; grid-row: 5"></div>
    <div class="cell" style="grid-column: 12; grid-row: 4"></div>
    <div class="cell" style="grid-column: 12; grid-row: 3"></div>
    <!------------------------------------------->


    <!-- Ligne horizontal haut du premier plan -->
    <div class="cell" style="grid-column: 11; grid-row: 4"></div>
    <div class="cell" style="grid-column: 10; grid-row: 4"></div>
    <div class="cell" style="grid-column: 9; grid-row: 4"></div>
    <div class="cell" style="grid-column: 8; grid-row: 4"></div>
    <div class="cell" style="grid-column: 7; grid-row: 4"></div>
    <div class="cell" style="grid-column: 6; grid-row: 4"></div>
    <div class="cell" style="grid-column: 5; grid-row: 4"></div>
    <div class="cell" style="grid-column: 4; grid-row: 4"></div>
    <div class="cell" style="grid-column: 3; grid-row: 4"></div>
    <!------------------------------------------->

</div> --}}
{{-- @extends('parent.parentHome')
@section('selectPlaceSection')
<style>
    .grid {
      display: grid;
      grid-template-columns: repeat(90, 60px);
      grid-template-rows: repeat(15, 60px);
      gap: 2px;
    }

    .cell {
      background-color: #36c254;
      display: flex;
      justify-content: center;
      align-items: center;
      font-size: 0.7em;
      font-weight: bold;
      text-align: center;
      padding: 5px;
      border: 1px solid #ccc;
    }

    .fond {
        grid-column:3 / span 3;
        grid-row:3 / span 1;
        background-color: white;
        border:2px solid black;
        font-size: 2em;
    }

    .enter{
        grid-column: 10 / span 2;
        grid-row: 1 / span 1;
        background-color: white;
        border: 2px solid black;
        font-size: 1em;
    }
</style>
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Choisir votre place </h5>

            <div class="grid">
                <div class=" cell enter">Entrer</div>
                <!-- ligne vertical gauche du premier plan -->
                <div class="cell" style="grid-column: 2; grid-row: 4;">IESSI</div>
                <div class="cell" style="grid-column: 2; grid-row: 5;">IESSI</div>
                <div class="cell" style="grid-column: 2; grid-row: 6;">IESSI</div>
                <div class="cell" style="grid-column: 2; grid-row: 7;">IESSI</div>
                <div class="cell" style="grid-column: 2; grid-row: 8;">IESSI</div>
                <div class="cell" style="grid-column: 2; grid-row: 9;">IESSI</div>
                <div class="cell" style="grid-column: 2; grid-row: 10;">IESSI</div>
                <div class="cell" style="grid-column: 2; grid-row: 11;">IESSI</div>
            </div>
        </div>
    </div>
</div>

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
@endsection --}}

@extends('parent.parentHome')
@section('selectPlaceSection')
<style>
   .grid {
  display: grid;
  grid-template-columns: repeat(90, 60px);
  grid-template-rows: repeat(30, 60px);
  gap: 2px;
  overflow-x: auto; /* Ajoute un scroll horizontal sur mobile */
}

.cell {
  background-color: #36c254;
  display: flex;
  justify-content: center;
  align-items: center;
  font-size: 0.7em;
  font-weight: bold;
  text-align: center;
  padding: 5px;
  border: 1px solid #ccc;
  min-width: 60px;
  min-height: 60px;
}

.enter {
  display: flex;
  align-items: center;
  justify-content: center;
  grid-column: 12 / span 2;
  grid-row: 1 / span 1;
  border: 2px solid black;
  font-size: 1em;
  background-color: transparent;
}
/* Responsive */
@media (max-width: 768px) {
  .grid {
    grid-template-columns: repeat(45, 40px); /* réduit le nombre de colonnes visibles */
    grid-template-rows: repeat(15, 40px); /* réduit la hauteur des cases */
  }

  .cell {
    font-size: 0.5em;
    min-width: 40px;
    min-height: 40px;
    padding: 2px;
  }

  .fond, .enter {
    font-size: 0.8em;
  }
}

</style>
<div class="container-fluid">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title fw-semibold mb-4">Choisir votre place </h5>
        <div style="overflow-x: auto;">
            <div class="grid">
                <div class=" cell enter">Entrer</div>
                <!-- ligne vertical gauche du premier plan -->
                <div class="cell" style="grid-column: 2; grid-row: 4;">IESSI</div>
                <div class="cell" style="grid-column: 2; grid-row: 5;">IESSI</div>
                <div class="cell" style="grid-column: 2; grid-row: 6;">IESSI</div>
                <div class="cell" style="grid-column: 2; grid-row: 7;">IESSI</div>
                <div class="cell" style="grid-column: 2; grid-row: 8;">IESSI</div>
                <div class="cell" style="grid-column: 2; grid-row: 9;">IESSI</div>
                <div class="cell" style="grid-column: 2; grid-row: 10;">IESSI</div>
                <div class="cell" style="grid-column: 2; grid-row: 11;">IESSI</div>

                <!-- ligne horizontal bas du premier plan -->
                <div class="cell" style="grid-column: 3; grid-row: 11"></div>
                <div class="cell" style="grid-column: 4; grid-row: 11"></div>
                <div class="cell" style="grid-column: 5; grid-row: 11"></div>
                <div class="cell" style="grid-column: 6; grid-row: 11"></div>
                <div class="cell" style="grid-column: 7; grid-row: 11"></div>
                <div class="cell" style="grid-column: 8; grid-row: 11"></div>
                <div class="cell" style="grid-column: 9; grid-row: 11"></div>
                <div class="cell" style="grid-column: 10; grid-row: 11"></div>
                <div class="cell" style="grid-column: 11; grid-row: 11"></div>
                <div class="cell" style="grid-column: 12; grid-row: 11"></div>
                <!------------------------------------------->

                <!-----------------Ligne verticale droite du premier plan -------------------------->
                <div class="cell" style="grid-column: 12; grid-row: 10"></div>
                <div class="cell" style="grid-column: 12; grid-row: 9"></div>
                <div class="cell" style="grid-column: 12; grid-row: 8"></div>
                <div class="cell" style="grid-column: 12; grid-row: 7"></div>
                <div class="cell" style="grid-column: 12; grid-row: 6"></div>
                <div class="cell" style="grid-column: 12; grid-row: 5"></div>
                <div class="cell" style="grid-column: 12; grid-row: 4"></div>
                <div class="cell" style="grid-column: 12; grid-row: 3"></div>
                <!------------------------------------------->


                <!-- Ligne horizontal haut du premier plan -->
                <div class="cell" style="grid-column: 11; grid-row: 4"></div>
                <div class="cell" style="grid-column: 10; grid-row: 4"></div>
                <div class="cell" style="grid-column: 9; grid-row: 4"></div>
                <div class="cell" style="grid-column: 8; grid-row: 4"></div>
                <div class="cell" style="grid-column: 7; grid-row: 4"></div>
                <div class="cell" style="grid-column: 6; grid-row: 4"></div>
                <div class="cell" style="grid-column: 5; grid-row: 4"></div>
                <div class="cell" style="grid-column: 4; grid-row: 4"></div>
                <div class="cell" style="grid-column: 3; grid-row: 4"></div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
