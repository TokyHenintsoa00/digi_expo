@extends('parent.parentHome')
@section('selectPlaceSection')
<style>
   .grid {
  display: grid;
  grid-template-columns: repeat(90, 60px);
  grid-template-rows: repeat(21, 60px);
  gap: 2px;
  /* overflow-x: auto; */
   /* Ajoute un scroll horizontal sur mobile */
}

.cell {
    font-family: 'Poppins', sans-serif;
  background-color: #36c254;
  display: flex;
  justify-content: center;
  align-items: center;
  font-size: 0.8em;
  font-weight: bold;
  text-align: center;
  padding: 5px;
  border: 1px solid #ccc;
  min-width: 60px;
  min-height: 60px;
  color: white;
  transition: transform 0.2s ease;
  cursor: pointer;
  border-radius: 10px;
}

.enter {
    font-weight: bold;
    display: flex;
    align-items: center;
    justify-content: center;
    grid-column: 12 / span 3;
    grid-row: 1 / span 1;
    border: 2px solid black;
    font-size: 1em;
    background-color: transparent;
    color: black;
}

.case1{
    font-weight: bold;
    display: flex;
    align-items: center;
    justify-content: center;
    grid-column: 15 / span 3;
    grid-row: 4 / span 8;
    border: 2px solid black;
    font-size: 1em;
    background-color: transparent;
    color: black;

}
.case2{
    font-weight: bold;
    display: flex;
    align-items: center;
    justify-content: center;
    grid-column: 19 / span 3;
    grid-row: 4 / span 8;
    border: 2px solid black;
    font-size: 1em;
    background-color: transparent;
    color: black;
}


.cell:hover {
  transform: scale(1.1);
}

/* Zoom permanent après clic */
.cell.active {
  transform: scale(1.2);
  z-index: 10;
}


/* Responsive */
@media (max-width: 1000px) {
  .grid {
    grid-template-columns: repeat(21, 60px); /* réduit le nombre de colonnes visibles */
    grid-template-rows: repeat(21, 60px); /* réduit la hauteur des cases */
    overflow-x: auto;
  }

  .cell {
    font-size: 0.9em;
    min-width: 60px;
    min-height: 60px;
    padding: 2px;
  }

    .enter {
    font-size: 0.8em;
  }

}

.cell.bg-danger:hover,
.cell.bg-warning:hover {
  pointer-events: none;       /* Ignore les événements souris */
  transform: none !important; /* Empêche les effets de zoom/scale */
  box-shadow: none !important;
  background-color: inherit;  /* Pas de changement de couleur */
  filter: none !important;
  cursor: not-allowed;
  border: none;

}


</style>
@php
    $row1 = 4;

    $row2 = 3;

    $row3 = 10;

    $row4 = 11;

    $row5 = 13;

    $row6 = 3;

    $row7 = 20;

    $row8 = 3;

    $row9 = 3;

@endphp
<div class="container-fluid">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title fw-semibold mb-4">Choisir votre place</h5>
        <form action="/insertPemissionExposition" id="permissionForm" method="POST" onsubmit="event.preventDefault(); sendNotificationDirecteurToAdmin();">
            @csrf
          <input type="hidden" name="place_id" id="selectedPlaceId">
          <div style="overflow-x: auto;">
            <div class="grid">
              <div class="enter">Entrer</div>

              <!-- Ligne verticale gauche du premier plan -->
              @foreach($placeTopLeftFistPlan as $place)
                @if($row1 > 11)
                    @break
                @endif
                @switch($place->id_etat)
                    @case(13)
                        <div class="cell bg-warning" style="grid-column: 2; grid-row: {{ $row1 }};" data-id="{{ $place->id_place }}">
                            {{ $place->nom_place }}
                        </div>
                    @break

                    @case(12)
                        <div class="cell bg-danger" style="grid-column: 2; grid-row: {{ $row1 }};" data-id="{{ $place->id_place }}">
                            {{ $place->nom_place }}
                        </div>
                    @break

                    @default
                    <div class="cell" style="grid-column: 2; grid-row: {{ $row1 }};" data-id="{{ $place->id_place }}">
                        {{ $place->nom_place }}
                    </div>

                @endswitch
                @php $row1++; @endphp
              @endforeach

              <!-- Ligne horizontale bas du premier plan -->
              @foreach ($placeDownFirstPlan as $plan)
                @if ($row2 > 12) @break @endif
                @switch($plan->id_etat)
                    @case(13)
                    <div class="cell bg-warning" style="grid-column: {{ $row2 }}; grid-row: 11" data-id="{{ $plan->id_place }}">
                        {{ $plan->nom_place }}
                    </div>
                    @break

                    @case(12)
                    <div class="cell bg-danger" style="grid-column: {{ $row2 }}; grid-row: 11" data-id="{{ $plan->id_place }}">
                        {{ $plan->nom_place }}
                    </div>
                    @break

                    @default
                    <div class="cell" style="grid-column: {{ $row2 }}; grid-row: 11" data-id="{{ $plan->id_place }}">
                        {{ $plan->nom_place }}
                    </div>
                @endswitch

                @php $row2++; @endphp
              @endforeach

              <!-- Ligne verticale droite du premier plan -->
              @foreach ($placeRightFirstPlan as $plan)
                @if ($row3 < 3) @break @endif

                @switch($plan->id_etat)
                    @case(13)
                    <div class="cell bg-warning" style="grid-column: 12; grid-row: {{ $row3 }}" data-id="{{ $plan->id_place }}">
                        {{ $plan->nom_place }}
                    </div>
                    @break

                    @case(12)
                    <div class="cell bg-danger" style="grid-column: 12; grid-row: {{ $row3 }}" data-id="{{ $plan->id_place }}">
                        {{ $plan->nom_place }}
                    </div>
                    @break

                    @default
                    <div class="cell" style="grid-column: 12; grid-row: {{ $row3 }}" data-id="{{ $plan->id_place }}">
                        {{ $plan->nom_place }}
                    </div>
                @endswitch

                {{-- @if ($plan->id_etat == 13)
                <div class="cell bg-warning" style="grid-column: 12; grid-row: {{ $row3 }}" data-id="{{ $plan->id_place }}">
                    {{ $plan->nom_place }}
                </div>
                @elseif ($plan->id_etat == 12)
                <div class="cell bg-danger" style="grid-column: 12; grid-row: {{ $row3 }}" data-id="{{ $plan->id_place }}">
                    {{ $plan->nom_place }}
                </div>
                @else
                    <div class="cell" style="grid-column: 12; grid-row: {{ $row3 }}" data-id="{{ $plan->id_place }}">
                        {{ $plan->nom_place }}
                    </div>
                @endif --}}

                @php $row3--; @endphp
              @endforeach

              <!-- Ligne horizontale haut du premier plan -->
              @foreach ($placeUpFirstPlan as $plan)
                @if ($row4 < 3) @break @endif
                @switch($plan->id_etat)
                    @case(13)
                    <div class="cell bg-warning" style="grid-column: {{ $row4 }}; grid-row: 4" data-id="{{ $plan->id_place }}">
                        {{ $plan->nom_place }}
                    </div>
                    @break

                    @case(12)
                    <div class="cell bg-danger" style="grid-column: {{ $row4 }}; grid-row: 4" data-id="{{ $plan->id_place }}">
                        {{ $plan->nom_place }}
                    </div>
                    @break

                    @default
                    <div class="cell" style="grid-column: {{ $row4 }}; grid-row: 4" data-id="{{ $plan->id_place }}">
                        {{ $plan->nom_place }}
                    </div>

                @endswitch
                {{-- @if ($plan->id_etat == 13)
                <div class="cell bg-warning" style="grid-column: {{ $row4 }}; grid-row: 4" data-id="{{ $plan->id_place }}">
                    {{ $plan->nom_place }}
                  </div>
                @elseif ($plan->id_etat == 12)
                <div class="cell bg-danger" style="grid-column: {{ $row4 }}; grid-row: 4" data-id="{{ $plan->id_place }}">
                    {{ $plan->nom_place }}
                  </div>
                @else
                <div class="cell" style="grid-column: {{ $row4 }}; grid-row: 4" data-id="{{ $plan->id_place }}">
                    {{ $plan->nom_place }}
                  </div>
                @endif --}}

                @php $row4--; @endphp
              @endforeach

              <!-- Ligne verticale gauche du deuxième plan -->
              @foreach ($placeGaucheVerticalSecondPlan as $plan)
                @if ($row5 > 20) @break @endif

                  @switch($plan->id_etat)
                      @case(13)
                        <div class="cell bg-warning" style="grid-column: 2; grid-row: {{ $row5 }}" data-id="{{ $plan->id_place }}">
                        {{ $plan->nom_place }}
                        </div>
                        @break

                        @case(12)
                        <div class="cell bg-danger" style="grid-column: 2; grid-row: {{ $row5 }}" data-id="{{ $plan->id_place }}">
                            {{ $plan->nom_place }}
                        </div>
                        @break
                      @default
                      <div class="cell" style="grid-column: 2; grid-row: {{ $row5 }}" data-id="{{ $plan->id_place }}">
                        {{ $plan->nom_place }}
                      </div>
                  @endswitch
                @php $row5++; @endphp
              @endforeach

              <!-- Ligne horizontale bas deuxième plan -->
              @foreach ($placeStandWherePlaceDownSecondPlan as $plan)
                @if ($row6 > 12) @break @endif

                @switch($plan->id_etat)
                    @case(13)
                    <div class="cell bg-warning" style="grid-column: {{ $row6 }}; grid-row: 20" data-id="{{ $plan->id_place }}">
                        {{ $plan->nom_place }}
                    </div>
                    @break

                    @case(12)
                    <div class="cell bg-danger" style="grid-column: {{ $row6 }}; grid-row: 20" data-id="{{ $plan->id_place }}">
                        {{ $plan->nom_place }}
                      </div>
                    @break

                    @default
                    <div class="cell" style="grid-column: {{ $row6 }}; grid-row: 20" data-id="{{ $plan->id_place }}">
                        {{ $plan->nom_place }}
                    </div>

                @endswitch
                @php $row6++; @endphp
              @endforeach

              <!-- Ligne verticale droite deuxième plan -->
              @foreach ($placeStandWherePlaceRightSecondPlan as $plan)
                @if ($row7 < 13) @break @endif

                @switch($plan->id_etat)
                    @case(13)
                    <div class="cell bg-warning" style="grid-column: 12; grid-row: {{ $row7 }}" data-id="{{ $plan->id_place }}">
                        {{ $plan->nom_place }}
                    </div>
                    @break

                    @case(12)
                    <div class="cell bg-danger" style="grid-column: 12; grid-row: {{ $row7 }}" data-id="{{ $plan->id_place }}">
                        {{ $plan->nom_place }}
                    </div>

                    @break

                    @default
                    <div class="cell" style="grid-column: 12; grid-row: {{ $row7 }}" data-id="{{ $plan->id_place }}">
                        {{ $plan->nom_place }}
                    </div>
                @endswitch
                @php $row7--; @endphp
              @endforeach

              <!-- Ligne horizontale haut deuxième plan -->
              @foreach ($placeWherePlaceUpSecondPlan as $plan)
                @if ($row8 > 11) @break @endif
                @switch($plan->id_etat)
                    @case(13)
                    <div class="cell bg-warning" style="grid-column: {{ $row8 }}; grid-row: 13" data-id="{{ $plan->id_place }}">
                        {{ $plan->nom_place }}
                      </div>
                    @break

                    @case(12)
                    <div class="cell bg-danger" style="grid-column: {{ $row8 }}; grid-row: 13" data-id="{{ $plan->id_place }}">
                        {{ $plan->nom_place }}
                      </div>
                    @break

                    @default
                    <div class="cell" style="grid-column: {{ $row8 }}; grid-row: 13" data-id="{{ $plan->id_place }}">
                        {{ $plan->nom_place }}
                    </div>
                @endswitch

                @php $row8++; @endphp
              @endforeach

              <!-- Ligne verticale troisième plan -->
              @foreach ($placeStandWherePlaceRightThirdPlan as $plan)
                @if ($row9 > 11) @break @endif
                @switch($plan->id_etat)
                    @case(13)
                    <div class="cell bg-warning" style="grid-column: 14; grid-row: {{ $row9 }}" data-id="{{ $plan->id_place }}">
                        {{ $plan->nom_place }}
                      </div>
                    @break

                    @case(12)
                    <div class="cell bg-danger" style="grid-column: 14; grid-row: {{ $row9 }}" data-id="{{ $plan->id_place }}">
                        {{ $plan->nom_place }}
                      </div>
                    @break

                    @default
                    <div class="cell" style="grid-column: {{ $row8 }}; grid-row: 13" data-id="{{ $plan->id_place }}">
                        {{ $plan->nom_place }}
                      </div>
                @endswitch
                <div class="cell" style="grid-column: 14; grid-row: {{ $row9 }}" data-id="{{ $plan->id_place }}">
                  {{ $plan->nom_place }}
                </div>
                @php $row9++; @endphp
              @endforeach

              <!-- Cases spéciales -->
              <div class="case1"></div>
              <div class="case2">Presidence</div>

            </div>
          </div>
          <input type="hidden" name="nom_stand" value="{{ session('nom_stand') }}">
          <input type="hidden" name="id_categorie" value="{{ session('id_categorie') }}">
          <input type="hidden" name="description_stand" value="{{ session('description_stand') }}">
          <input type="hidden" name="nom_categorie_stand" value="{{ session('nom_categorie_stand')}}">
          <input type="hidden" name="date_debut" value="{{ session('date_debut')}}">
          <input type="hidden" name="date_fin" value="{{ session('date_fin')}}">
          <input type="hidden" name="img_stand_name" value="{{ session('img_stand_name')}}">
          <input type="hidden" name="id_max_salon" value="{{ session('id_max_id_salon')}}">
          <input type="hidden" name="nom_employe" value="{{ session('nom_employe')}}">
          <input type="hidden" name="prenom_employe" value="{{ session('prenom_employe')}}">
          <input type="hidden" name="date_naissance" value="{{ session('date_naissance')}}">
          <input type="hidden" name="email_employe" value="{{ session('email_employe')}}">
          <button type="submit" class="btn btn-primary mt-3">Valider votre choix</button>
        </form>
      </div>
    </div>
  </div>

  <script>
    const cells = document.querySelectorAll('.cell');
    const selectedPlaceInput = document.getElementById('selectedPlaceId');
    cells.forEach(cell => {
      cell.addEventListener('click', () => {

        if (cell.classList.contains('bg-danger') || cell.classList.contains('bg-warning')) {

            return; // Ne rien faire si la cellule est rouge ou jaune
        }

        // Supprimer la classe active de toutes les cellules
        cells.forEach(c => c.classList.remove('active'));

        // Ajouter la classe active uniquement à la cellule cliquée
        cell.classList.add('active');

        const placeId = cell.dataset.id;
        selectedPlaceInput.value = placeId;
      });
    });


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
