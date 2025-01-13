BEGIN;

-- Première mise à jour
UPDATE faculte_stand
SET nom_faculte_stand = 'Faculte des Sciences(FSc)'
WHERE id_faculte_stand = 1;

-- Première mise à jour
UPDATE faculte_stand
SET nom_faculte_stand = 'Faculte de Medecine'
WHERE id_faculte_stand = 2;


-- Première mise à jour
UPDATE faculte_stand
SET nom_faculte_stand = 'Faculte de droit ,Economie,Gestion,et de Sociologie(FDEGS)'
WHERE id_faculte_stand = 3;


-- Première mise à jour
UPDATE faculte_stand
SET nom_faculte_stand = 'Faculte des Lettres et des Sciences Humaines(FLSH)'
WHERE id_faculte_stand = 4;


-- Première mise à jour
UPDATE faculte_stand
SET nom_faculte_stand = 'Faculte des Sciences Economique'
WHERE id_faculte_stand = 5;


-- Première mise à jour
UPDATE faculte_stand
SET nom_faculte_stand = 'Faculte des Sciences Agronomiques'
WHERE id_faculte_stand = 6;
COMMIT;