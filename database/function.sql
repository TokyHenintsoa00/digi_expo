CREATE OR REPLACE FUNCTION generate_emp_matricule()
RETURNS TRIGGER AS $$
BEGIN
    NEW.matricule_emp := 'p' || LPAD(NEW.id_emp::text, 3, '0');  -- Concaténation avec remplissage de zéros
    RETURN NEW;
END;
$$ LANGUAGE plpgsql;


CREATE TRIGGER emp_matricule_trigger
BEFORE INSERT ON emp
FOR EACH ROW
EXECUTE FUNCTION generate_emp_matricule();



-- Voici une série d'instructions SQL générant 50 lignes aléatoires pour la table stand, avec un id_etat de 4 et des dates de création réparties entre janvier 2024 et décembre 2024. Les valeurs des champs comme nom_stand, description_stand, et img_stand seront générées aléatoirement, tandis que les catégories seront choisies parmi celles existantes.

DO $$
DECLARE
    i INT;
    date_creation DATE;
    categorie_id INT;
BEGIN
    FOR i IN 1..50 LOOP
        -- Générer une date aléatoire entre janvier 2024 et décembre 2024
        date_creation := DATE '2024-01-01' + (random() * 364)::INT;

        -- Choisir une catégorie aléatoire existante
        SELECT id_categorie INTO categorie_id FROM categorie ORDER BY random() LIMIT 1;

        -- Insérer une nouvelle ligne dans la table stand
        INSERT INTO stand (id_categorie, nom_stand, description_stand, img_stand, id_etat, date_de_creation_stand, nom_categorie_stand)
        VALUES (
            categorie_id,
            'Stand ' || i || ' de ' || (SELECT nom_categorie FROM categorie WHERE id_categorie = categorie_id),
            'Description du stand ' || i,
            'image' || i || '.jpg',
            4,
            date_creation,
            (SELECT nom_categorie FROM categorie WHERE id_categorie = categorie_id)
        );
    END LOOP;
END $$;


DO $$
DECLARE
    i INT;
    date_membre DATE;
    etat_id INT;
    nom_emp TEXT;
    prenom_emp TEXT;
    email TEXT;
    matricule TEXT;
BEGIN
    FOR i IN 1..50 LOOP
        -- Générer une date aléatoire entre janvier 2024 et décembre 2024
        date_membre := DATE '2024-01-01' + (random() * 364)::INT;

        -- Alterner les états entre 2 et 7
        etat_id := CASE WHEN i % 2 = 0 THEN 2 ELSE 7 END;

        -- Générer un nom, prénom et e-mail fictifs
        nom_emp := 'Nom' || i;
        prenom_emp := 'Prenom' || i;
        email := LOWER(prenom_emp || '.' || nom_emp || '@example.com');

        -- Générer un matricule unique
        matricule := 'M' || LPAD(i::TEXT, 3, '0');

        -- Insérer une nouvelle ligne dans la table emp
        INSERT INTO emp (nom_emp, prenom_emp, date_naissance, email, id_etat, date_membre, matricule_emp)
        VALUES (
            nom_emp,
            prenom_emp,
            DATE '1980-01-01' + (random() * 15000)::INT, -- Date de naissance aléatoire entre 1980 et 2021
            email,
            etat_id,
            date_membre,
            matricule
        );
    END LOOP;
END $$;


DO $$
DECLARE
    i INT;
    date_mouvement DATE;
    etat_emp INT;
    etat_mouvement INT;
BEGIN
    FOR i IN 1..30 LOOP
        -- Récupérer l'état de l'employé
        SELECT id_etat INTO etat_emp FROM emp WHERE id_emp = i;

        -- Déterminer l'état du mouvement basé sur l'état de l'employé
        IF etat_emp = 2 THEN
            etat_mouvement := 8;
        ELSIF etat_emp = 7 THEN
            etat_mouvement := 10;
        ELSE
            etat_mouvement := 0; -- Si nécessaire, vous pouvez ajouter un état par défaut.
        END IF;

        -- Générer une date aléatoire entre janvier 2024 et décembre 2024
        date_mouvement := DATE '2024-01-01' + (random() * 364)::INT;

        -- Insérer une nouvelle ligne dans la table mouvement_personnel
        INSERT INTO mouvement_personnel (id_emp, id_etat, date_mouvement)
        VALUES (i, etat_mouvement, date_mouvement);
    END LOOP;
END $$;



x



DO $$
DECLARE
    i INT;
    id_stand INT;
    id_type_stand INT;
    date_creation DATE;
BEGIN
    FOR i IN 1..50 LOOP
        -- Générer un id_stand aléatoire entre 1 et 101
        id_stand := (floor(random() * 101) + 1)::INT;

        -- Générer un id_type_stand aléatoire entre 1 et 2
        id_type_stand := (floor(random() * 2) + 1)::INT;

        -- Générer une date aléatoire entre le 1er janvier 2024 et le 31 décembre 2024
        date_creation := DATE '2024-01-01' + (random() * 364)::INT;

        -- Insérer une ligne dans la table info_type_stand
        INSERT INTO info_type_stand (id_stand, id_type_stand, date_creation)
        VALUES (id_stand, id_type_stand, date_creation);
    END LOOP;
END $$;


DO $$
DECLARE
    i INT;
    id_info_type_stand INT;
    nom_info_type_stand TEXT;
    description_info_type_stand TEXT;
    img_info_type_stand JSONB;
    date_creation DATE;
BEGIN
    FOR i IN 1..50 LOOP
        -- Générer un id_info_type_stand aléatoire entre 1 et 50
        id_info_type_stand := (floor(random() * 50) + 1)::INT;

        -- Générer un nom aléatoire pour le type de stand
        nom_info_type_stand := 'Type Stand ' || i;

        -- Générer une description aléatoire
        description_info_type_stand := 'Description du type de stand ' || i;

        -- Générer un JSON pour l'image
        img_info_type_stand := jsonb_build_object(
            'url', 'https://example.com/images/img' || i || '.png',
            'alt', 'Image pour le type de stand ' || i,
            'size', jsonb_build_object('width', 800, 'height', 600)
        );

        -- Générer une date aléatoire entre le 1er janvier 2024 et le 31 décembre 2024
        date_creation := DATE '2024-01-01' + (random() * 364)::INT;

        -- Insérer une ligne dans la table info_type_stand_Desc
        INSERT INTO info_type_stand_Desc (id_info_type_stand, nom_info_type_stand, description_info_type_stand, img_info_type_stand, date_creation)
        VALUES (id_info_type_stand, nom_info_type_stand, description_info_type_stand, img_info_type_stand, date_creation);
    END LOOP;
END $$;


DO $$
BEGIN
    FOR i IN 1..20 LOOP
        INSERT INTO video_Conference (titre_video, id_directeur, id_type_video, id_type_conference, date_heure_salle_conference, liens_video)
        VALUES (
            'Titre Video ' || i, -- Exemple de titre vidéo, vous pouvez modifier cela
            (SELECT id_emp FROM emp WHERE id_etat = 7 ORDER BY RANDOM() LIMIT 1), -- Sélectionne un directeur aléatoire dans la table emp
            (i % 2) + 1, -- Alternance entre 1 et 2 pour id_type_video
            1, -- Exemple d'id_type_conference, modifiez selon vos besoins
            NOW() + (i * INTERVAL '1 hour'), -- Exemple d'horodatage, ajoute 1 heure à chaque itération
            'http://exemple.com/video_' || i -- Exemple de lien vidéo
        );
    END LOOP;
END $$;
