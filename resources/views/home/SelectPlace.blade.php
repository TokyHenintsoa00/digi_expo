@extends('parent.parentHome')
@section('selectPlaceSection')
<style>
   .grid {
  display: grid;
  grid-template-columns: repeat(90, 60px);
  grid-template-rows: repeat(23, 60px);
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
    grid-template-rows: repeat(23, 60px); /* réduit la hauteur des cases */
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
@endphp

<div class="container-fluid">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title fw-semibold mb-4">Choisir votre place </h5>
        <div style="overflow-x: auto;">
            <div class="grid">
                <div class="enter">Entrer</div>
                <!-- ligne vertical gauche du premier plan -->
                {{-- <div class="cell" style="grid-column: 2; grid-row: 4;">IESSI</div>
                <div class="cell" style="grid-column: 2; grid-row: 5;">IESSI</div>
                <div class="cell" style="grid-column: 2; grid-row: 6;">IESSI</div>
                <div class="cell" style="grid-column: 2; grid-row: 7;">IESSI</div>
                <div class="cell" style="grid-column: 2; grid-row: 8;">IESSI</div>
                <div class="cell" style="grid-column: 2; grid-row: 9;">IESSI</div>
                <div class="cell" style="grid-column: 2; grid-row: 10;">IESSI</div>
                <div class="cell" style="grid-column: 2; grid-row: 11;">IESSI</div> --}}

                @foreach($placeTopLeftFistPlan as $place)
                    @if($row1 > 11) @break @endif
                    <div class="cell" style="grid-column: 2; grid-row: {{ $row1 }};">
                        {{ $place->nom_place }}
                    </div>
                    @php
                        $row1++;
                    @endphp
                @endforeach

                <!-- ligne horizontal bas du premier plan -->
                    {{-- <div class="cell" style="grid-column: 3; grid-row: 11"></div>
                    <div class="cell" style="grid-column: 4; grid-row: 11"></div>
                    <div class="cell" style="grid-column: 5; grid-row: 11"></div>
                    <div class="cell" style="grid-column: 6; grid-row: 11"></div>
                    <div class="cell" style="grid-column: 7; grid-row: 11"></div>
                    <div class="cell" style="grid-column: 8; grid-row: 11"></div>
                    <div class="cell" style="grid-column: 9; grid-row: 11"></div>
                    <div class="cell" style="grid-column: 10; grid-row: 11"></div>
                    <div class="cell" style="grid-column: 11; grid-row: 11"></div>
                    <div class="cell" style="grid-column: 12; grid-row: 11"></div> --}}

                    @foreach ($placeDownFirstPlan as $plan)
                        @if ($row2 > 12) @break @endif
                        <div class="cell" style="grid-column: {{ $row2 }}; grid-row: 11">
                            {{$plan->nom_place}}
                        </div>
                        @php
                            $row2++;
                        @endphp
                    @endforeach


                <!------------------------------------------->

                <!-----------------Ligne verticale droite du premier plan -------------------------->
            {{--    <div class="cell" style="grid-column: 12; grid-row: 10"></div>
                    <div class="cell" style="grid-column: 12; grid-row: 9"></div>
                    <div class="cell" style="grid-column: 12; grid-row: 8"></div>
                    <div class="cell" style="grid-column: 12; grid-row: 7"></div>
                    <div class="cell" style="grid-column: 12; grid-row: 6"></div>
                    <div class="cell" style="grid-column: 12; grid-row: 5"></div>
                    <div class="cell" style="grid-column: 12; grid-row: 4"></div>
                    <div class="cell" style="grid-column: 12; grid-row: 3"></div> --}}
                        @foreach ($placeRightFirstPlan as $plan)
                            @if ($row3 < 3)
                                @break
                            @endif
                            <div class="cell" style="grid-column: 12; grid-row:{{ $row3 }}">
                                {{$plan->nom_place}}
                            </div>
                            @php
                                $row3--;
                            @endphp
                        @endforeach

                <!------------------------------------------->


                <!-- Ligne horizontal haut du premier plan -->
                {{-- <div class="cell" style="grid-column: 11; grid-row: 4"></div>
                <div class="cell" style="grid-column: 10; grid-row: 4"></div>
                <div class="cell" style="grid-column: 9; grid-row: 4"></div>
                <div class="cell" style="grid-column: 8; grid-row: 4"></div>
                <div class="cell" style="grid-column: 7; grid-row: 4"></div>
                <div class="cell" style="grid-column: 6; grid-row: 4"></div>
                <div class="cell" style="grid-column: 5; grid-row: 4"></div>
                <div class="cell" style="grid-column: 4; grid-row: 4"></div>
                <div class="cell" style="grid-column: 3; grid-row: 4"></div> --}}

                @foreach ($placeUpFirstPlan as $plan)
                        @if ($row4 < 3)
                            @break
                        @endif
                        <div class="cell" style="grid-column: {{ $row4 }}; grid-row: 4">
                            {{$plan->nom_place}}
                        </div>

                        @php
                                $row4--;
                            @endphp
                @endforeach

                <!--------------------------------------------->

                <!-- Ligne verticale gauche du deuxieme plan -->
                <div class="cell" style="grid-column: 2; grid-row: 13"></div>
                <div class="cell" style="grid-column: 2; grid-row: 14"></div>
                <div class="cell" style="grid-column: 2; grid-row: 15"></div>
                <div class="cell" style="grid-column: 2; grid-row: 16"></div>
                <div class="cell" style="grid-column: 2; grid-row: 17"></div>
                <div class="cell" style="grid-column: 2; grid-row: 18"></div>
                <div class="cell" style="grid-column: 2; grid-row: 19"></div>
                <div class="cell" style="grid-column: 2; grid-row: 20"></div>
                <!------------------------------------------>

                <!-- Ligne horizontal bas deuxieme plan  -->
                <div class="cell" style="grid-column: 3; grid-row: 20"></div>
                <div class="cell" style="grid-column: 4; grid-row: 20"></div>
                <div class="cell" style="grid-column: 5; grid-row: 20"></div>
                <div class="cell" style="grid-column: 6; grid-row: 20"></div>
                <div class="cell" style="grid-column: 7; grid-row: 20"></div>
                <div class="cell" style="grid-column: 8; grid-row: 20"></div>
                <div class="cell" style="grid-column: 9; grid-row: 20"></div>
                <div class="cell" style="grid-column: 10; grid-row: 20"></div>
                <div class="cell" style="grid-column: 11; grid-row: 20"></div>
                <div class="cell" style="grid-column: 12; grid-row: 20"></div>
                <!--------------------------------------------->

                <!-- LIGNE VERTICAL DROITE DEUXIEME PLAN -->
                <div class="cell" style="grid-column: 12; grid-row: 20"></div>
                <div class="cell" style="grid-column: 12; grid-row: 19"></div>
                <div class="cell" style="grid-column: 12; grid-row: 18"></div>
                <div class="cell" style="grid-column: 12; grid-row: 17"></div>
                <div class="cell" style="grid-column: 12; grid-row: 16"></div>
                <div class="cell" style="grid-column: 12; grid-row: 15"></div>
                <div class="cell" style="grid-column: 12; grid-row: 14"></div>
                <div class="cell" style="grid-column: 12; grid-row: 13"></div>
                <!----------------------------------------->

                <!-- LIGNE HORIZONTAL HAUT DEUXIEME PLAN -->
                <div class="cell" style="grid-column: 3; grid-row: 13"></div>
                <div class="cell" style="grid-column: 4; grid-row: 13"></div>
                <div class="cell" style="grid-column: 5; grid-row: 13"></div>
                <div class="cell" style="grid-column: 6; grid-row: 13"></div>
                <div class="cell" style="grid-column: 7; grid-row: 13"></div>
                <div class="cell" style="grid-column: 8; grid-row: 13"></div>
                <div class="cell" style="grid-column: 9; grid-row: 13"></div>
                <div class="cell" style="grid-column: 10; grid-row: 13"></div>
                <div class="cell" style="grid-column: 11; grid-row: 13"></div>
                <!----------------------------------------->

                <!-- LIGNE VERTICAL TROISIEME PLAN -->
                <div class="cell" style="grid-column: 14; grid-row: 3"></div>
                <div class="cell" style="grid-column: 14; grid-row: 4"></div>
                <div class="cell" style="grid-column: 14; grid-row: 5"></div>
                <div class="cell" style="grid-column: 14; grid-row: 6"></div>
                <div class="cell" style="grid-column: 14; grid-row: 7"></div>
                <div class="cell" style="grid-column: 14; grid-row: 8"></div>
                <div class="cell" style="grid-column: 14; grid-row: 9"></div>
                <div class="cell" style="grid-column: 14; grid-row: 10"></div>
                <div class="cell" style="grid-column: 14; grid-row: 11"></div>
                <!----------------------------------->

                <div class="case1"></div>
                <div class="case2">Presidence</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    const cells = document.querySelectorAll('.cell');

    cells.forEach(cell => {
      cell.addEventListener('click', () => {
        // Supprimer la classe active de toutes les cellules
        cells.forEach(c => c.classList.remove('active'));

        // Ajouter la classe active uniquement à la cellule cliquée
        cell.classList.add('active');
      });
    });
  </script>

@endsection
