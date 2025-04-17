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
    font-size: 0.5em;
    min-width: 60px;
    min-height: 60px;
    padding: 2px;
  }

    .enter {
    font-size: 0.8em;
  }

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
        <form action="#" method="GET">
          <input type="hidden" name="place_id" id="selectedPlaceId">
          <div style="overflow-x: auto;">
            <div class="grid">
              <div class="enter">Entrer</div>

              <!-- Ligne verticale gauche du premier plan -->
              @foreach($placeTopLeftFistPlan as $place)
                @if($row1 > 11) @break @endif
                <div class="cell" style="grid-column: 2; grid-row: {{ $row1 }};" data-id="{{ $place->id_place }}">
                  {{ $place->nom_place }}
                </div>
                @php $row1++; @endphp
              @endforeach

              <!-- Ligne horizontale bas du premier plan -->
              @foreach ($placeDownFirstPlan as $plan)
                @if ($row2 > 12) @break @endif
                <div class="cell" style="grid-column: {{ $row2 }}; grid-row: 11" data-id="{{ $plan->id_place }}">
                  {{ $plan->nom_place }}
                </div>
                @php $row2++; @endphp
              @endforeach

              <!-- Ligne verticale droite du premier plan -->
              @foreach ($placeRightFirstPlan as $plan)
                @if ($row3 < 3) @break @endif
                <div class="cell" style="grid-column: 12; grid-row: {{ $row3 }}" data-id="{{ $plan->id_place }}">
                  {{ $plan->nom_place }}
                </div>
                @php $row3--; @endphp
              @endforeach

              <!-- Ligne horizontale haut du premier plan -->
              @foreach ($placeUpFirstPlan as $plan)
                @if ($row4 < 3) @break @endif
                <div class="cell" style="grid-column: {{ $row4 }}; grid-row: 4" data-id="{{ $plan->id_place }}">
                  {{ $plan->nom_place }}
                </div>
                @php $row4--; @endphp
              @endforeach

              <!-- Ligne verticale gauche du deuxième plan -->
              @foreach ($placeGaucheVerticalSecondPlan as $plan)
                @if ($row5 > 20) @break @endif
                <div class="cell" style="grid-column: 2; grid-row: {{ $row5 }}" data-id="{{ $plan->id_place }}">
                  {{ $plan->nom_place }}
                </div>
                @php $row5++; @endphp
              @endforeach

              <!-- Ligne horizontale bas deuxième plan -->
              @foreach ($placeStandWherePlaceDownSecondPlan as $plan)
                @if ($row6 > 12) @break @endif
                <div class="cell" style="grid-column: {{ $row6 }}; grid-row: 20" data-id="{{ $plan->id_place }}">
                  {{ $plan->nom_place }}
                </div>
                @php $row6++; @endphp
              @endforeach

              <!-- Ligne verticale droite deuxième plan -->
              @foreach ($placeStandWherePlaceRightSecondPlan as $plan)
                @if ($row7 < 13) @break @endif
                <div class="cell" style="grid-column: 12; grid-row: {{ $row7 }}" data-id="{{ $plan->id_place }}">
                  {{ $plan->nom_place }}
                </div>
                @php $row7--; @endphp
              @endforeach

              <!-- Ligne horizontale haut deuxième plan -->
              @foreach ($placeWherePlaceUpSecondPlan as $plan)
                @if ($row8 > 11) @break @endif
                <div class="cell" style="grid-column: {{ $row8 }}; grid-row: 13" data-id="{{ $plan->id_place }}">
                  {{ $plan->nom_place }}
                </div>
                @php $row8++; @endphp
              @endforeach

              <!-- Ligne verticale troisième plan -->
              @foreach ($placeStandWherePlaceRightThirdPlan as $plan)
                @if ($row9 > 11) @break @endif
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
        // Supprimer la classe active de toutes les cellules
        cells.forEach(c => c.classList.remove('active'));

        // Ajouter la classe active uniquement à la cellule cliquée
        cell.classList.add('active');

        const placeId = cell.dataset.id;
        selectedPlaceInput.value = placeId;
      });
    });
  </script>


@endsection
