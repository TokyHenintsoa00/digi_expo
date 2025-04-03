{{--


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Disposition en Grid</title>
    <style>
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
            background-color: #f4dfc8;
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


    </style>
</head>
<body>
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

    <div class="grid-container">
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
</body>
</html>
 --}}


 <!DOCTYPE html>
 <html lang="fr">
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Structure avec CSS Grid</title>
        <style>
            .container {
    display: flex; /* Utilisation de flexbox pour positionner Sponsor et le conteneur grid */
    flex-direction: column; /* Les éléments sont disposés en colonne */
    align-items: flex-start; /* Alignement à gauche */
    width: 200px; /* Largeur du conteneur principal */
}

.sponsor {
    background-color: lightgray;
    padding: 10px; /* Ajout d'un peu d'espace autour du texte */
    border: 1px solid gray; /* Bordure */
    margin-bottom: 2px; /* Espacement entre Sponsor et le conteneur grid */
    width: 180px; /* Légèrement moins large que le conteneur grid */
}

.grid-container {
    display: grid;
    grid-template-columns: 1fr 2fr;
    grid-template-rows: repeat(10, 50px);
    gap: 2px;
    border: 1px solid black;
}

.grid-item {
    background-color: lightgray;
    display: flex;
    justify-content: center;
    align-items: center;
    border: 1px solid gray;
}

.grid-item.empty {
    grid-column: 2;
    grid-row: 1 / 11;
    background-color: transparent;
    border: 1px solid black;
}
        </style>
 </head>
 <body>
     <div class="container">
         <div class="sponsor">Sponsor</div>
         <div class="grid-container">
             <div class="grid-item medc">Medc</div>
             <div class="grid-item müdc">Müdc</div>
             <div class="grid-item poly">Poly</div>
             <div class="grid-item egs">EGS</div>
             <div class="grid-item bau-cr">BAU/CR</div>
             <div class="grid-item ef">EF</div>
             <div class="grid-item iessi">IESSI</div>
             <div class="grid-item esav">ESAV</div>
             <div class="grid-item sticom">STICOM</div>
         
         </div>
     </div>
 </body>
 </html>