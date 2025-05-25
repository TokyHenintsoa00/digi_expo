INSERT INTO organisateur (nom_organisateur)
VALUES ('Organisateur A');

-- Insérer les contacts pour l'organisateur
INSERT INTO contact_organisateur (id_organisateur,type_contact,contact)
VALUES
    (1,'email', 'contact1@example.com'),
    (1,'facebook', 'org123'),
    (1,'numero telephone','0325539338');


INSERT INTO salle_reception (nom_salle_reception)
VALUES
    ('Salle Prestige');

--insert etat
insert into etat(etat) values
('En attente'),
('Employe'),
('Sucess'),
('valide'),
('refuser'),
('admin'),
('directeur_employer'),
('employer_licensier'),
('employer_demissionner'),
('directeur_licensier'),
('Supprimer'),
('occupe'),
('reserve'),
('libre');

--insert admin
INSERT INTO admin(nom, prenom, email, pwd_admin, id_etat, created_at, updated_at)
VALUES
('Toky', 'Ramanalina', 'tokyramanalina@gmail.com', 'password123', 1, NOW(), NOW()),
('Ranomenjanahary', 'Mamy', 'ramanalinarivomamy@gmail.com', 'password123', 1, NOW(), NOW()),
('Toky', 'Ramanalinarivo', 'tokyramanalinarivo@gmail.com', 'password123', 1, NOW(), NOW());




--insert Emp
INSERT INTO emp (nom_emp, prenom_emp, date_naissance, email, id_etat, date_membre)
VALUES
('Randrianantenaina', 'Jean', '1990-05-12', 'jean.randrianantenaina@gmail.com', 1, '2023-08-12 14:00:00'),
('Rasolofonirina', 'Lova', '1985-11-23', 'lova.rasolofonirina@gmail.com', 2, '2021-05-17 09:30:00'),
('Rakotobe', 'Feno', '1992-01-15', 'feno.rakotobe@gmail.com', 1, '2020-02-20 12:45:00'),
('Razafintsalama', 'Tovo', '1998-07-30', 'tovo.razafintsalama@gmail.com', 3, '2022-11-10 08:15:00'),
('Raveloson', 'Hery', '1995-03-18', 'hery.raveloson@gmail.com', 2, '2019-09-23 13:00:00'),
('Ramaroson', 'Tiana', '2000-06-25', 'tiana.ramaroson@gmail.com', 1, '2023-01-01 16:30:00');


--insert categorie
INSERT INTO categorie(nom_categorie)
VALUES
('Etablissement'),
('Ministerielle'),
('Secteur prive'),
('Partenaire et sponsor');
-----------------------------------------------------
insert into type_video(nom_type)VALUES
('Podcast'),
('Streaming'),
('visioConference');

INSERT INTO type_conference(nom_type_conference)VALUES
('Atelier'),
('Salle de conference'),
('galerie');


--stand
INSERT INTO permission_stand
(nom_stand, id_categorie, nom_categorie_stand, description_stand, nom_emp, prenom_emp, date_naissance, email, img_stand, id_etat)
VALUES
('Stand des Arts', 1, 'Artisanat', 'Un stand dédié à lart et à la création.', 'Dupont', 'Marie', '1985-06-15', 'marie.dupont@example.com', 'image1.png', 1),
('Tech Innov', 2, 'Technologie', 'Dernières innovations technologiques.', 'Lemoine', 'Paul', '1990-03-20', 'paul.lemoine@example.com', 'image2.png', 1);

--emp
INSERT INTO permission_recrutement_emp(nom_emp,prenom_emp,email,date_naissance,id_stand,id_etat,id_expediteur)
VALUES
('Jean','Baptiste','jean@gmail.com','1940-01-17',1,1,1),
('Carole','Andrea','andrea@gmail.com','1940-01-17',1,1,1);







('Gastronomie Delice', 3, 'Gastronomie', 'Stand culinaire avec des dégustations.', 'Moreau', 'Clara', '1987-11-10', 'clara.moreau@example.com', 'image3.png', 1),
('Nature Passion', 4, 'Écologie', 'Promouvoir des solutions écologiques.', 'Roche', 'Lucas', '1992-02-18', 'lucas.roche@example.com', 'image4.png', 1),
('Mode Chic', 5, 'Mode', 'Vêtements et accessoires tendances.', 'Girard', 'Sophie', '1995-08-25', 'sophie.girard@example.com', 'image5.png', 1),
('Sport et Bien-être', 6, 'Sport', 'Équipements sportifs et bien-être.', 'Bernard', 'Julien', '1988-01-14', 'julien.bernard@example.com', 'image6.png', 1),
('Jeux et Loisirs', 7, 'Loisirs', 'Divertissements pour tous les âges.', 'Durand', 'Emma', '1993-09-30', 'emma.durand@example.com', 'image7.png', 1),
('Livres et Culture', 8, 'Culture', 'Éditeurs et librairies réunis.', 'Martin', 'Thomas', '1989-04-12', 'thomas.martin@example.com', 'image8.png', 1),
('Startup Zone', 9, 'Entrepreneuriat', 'Présentation de startups innovantes.', 'Petit', 'Alice', '1991-07-05', 'alice.petit@example.com', 'image9.png', 1),
('Artisanat Local', 10, 'Artisanat', 'Produits locaux et faits main.', 'Robin', 'Nathan', '1996-12-21', 'nathan.robin@example.com', 'image10.png', 1);



INSERT INTO mois (id_mois, nom_mois) VALUES
(1, 'Janvier'),
(2, 'Fevrier'),
(3, 'Mars'),
(4, 'Avril'),
(5, 'Mai'),
(6, 'Juin'),
(7, 'Juillet'),
(8, 'Aout'),
(9, 'Septembre'),
(10, 'Octobre'),
(11, 'Novembre'),
(12, 'Decembre');


            -- Insertion des mvts personnels
            INSERT INTO mouvement_personnel (id_emp, id_etat, date_mouvement)
            VALUES
            (1, 10, '2024-01-01 00:00:00'),
            (5, 8, '2024-02-15 00:00:00'),
            (6, 10, '2024-03-31 00:00:00'),
            (6, 8, '2024-05-15 00:00:00'),
            (4, 10, '2024-07-01 00:00:00'),
            (2, 8, '2024-08-15 00:00:00'),
            (2, 10, '2024-10-01 00:00:00'),
            (3, 8, '2024-11-15 00:00:00'),
            (4, 10, '2024-12-31 00:00:00'),
            (5, 10, '2024-01-15 00:00:00');


insert into search(search)VALUES
('stand'),
('v_info_type_stand_Desc'),
('video_contenue'),
('video_conference'),
('temoignage');





SELECT distinct(id_stand),id_directeur,nom_stand,description_Stand,
img_stand,id_etat,nom_directeur,prenom_directeur,date_de_creation_stand
FROM  v_membre_Stand where id_etat in(3,4) and id_directeur = ?
order by date_de_creation_stand desc

SELECT *
FROM stand s
left JOIN v_info_type_stand_desc vtsd ON s.id_stand = vtsd.id_info_type_stand_desc
left join video_contenue vid_cont on s.id_stand = vid_cont.id_stand;


SELECT distinct(id_stand),id_directeur,nom_stand,description_Stand,
                                img_stand,id_etat,nom_directeur,prenom_directeur,date_de_creation_stand
                                FROM  v_membre_Stand where id_etat in(3,4) and id_directeur = 118
                                order by date_de_creation_stand desc





INSERT INTO temoignage (id_stand, id_directeur, date_temoignage, liens_video, titre,id_sallon) VALUES
(1, 1, '2025-02-25 10:30:00', 'https://pro.zoom.us/j/9876543210', 'Temoignage 1 : Introduction',1),
(1, 1, '2025-02-28 14:45:00', 'https://pro.zoom.us/j/8765432109', 'Temoignage 2 : Retour d experience',1),
(1, 1, '2025-03-03 09:00:00', 'https://pro.zoom.us/j/7654321098', 'Temoignage 3 : Innovation et technologie',1),
(1, 1, '2025-03-10 11:15:00', 'https://pro.zoom.us/j/6543210987', 'Temoignage 5 : Perspectives d avenir',1),
(1, 1, '2025-03-14 13:45:00', 'https://pro.zoom.us/j/5432109876', 'Temoignage 6 : Defis rencontres',1),
(1, 1, '2025-03-18 17:30:00', 'https://pro.zoom.us/j/4321098765', 'Temoignage 7 : Opportunites a saisir',1),
(1, 1, '2025-03-22 08:30:00', 'https://pro.zoom.us/j/3210987654', 'Temoignage 8 : Avis des visiteurs',1),
(1, 1, '2025-03-25 15:00:00', 'https://pro.zoom.us/j/2109876543', 'Temoignage 9 : Cloture de l evenement',1),
(1, 1, '2025-03-27 18:45:00', 'https://pro.zoom.us/j/1098765432', 'Temoignage 10 : Bilan et remerciements',1);

-- insert into place(nom_place,etat_place) values
--     ('A1',14),
--     ('A2',14),
--     ('A3',14),
--     ('A4',14),
--     ('A5',14),
--     ('B1',14),
--     ('B2',14),
--     ('B3',14),
--     ('B4',14),
--     ('B5',14),
--     ('C1',14),
--     ('C2',14),
--     ('C3',14),
--     ('C4',14),
--     ('C5',14),
--     ('D1',14),
--     ('D2',14),
--     ('D3',14),
--     ('D4',14),
--     ('D5',14);

INSERT INTO place (nom_place, id_etat) VALUES
('A1', 14), ('A2', 14), ('A3', 14), ('A4', 14), ('A5', 14), ('A6', 14), ('A7', 14), ('A8', 14), ('A9', 14), ('A10', 14),
('B1', 14), ('B2', 14), ('B3', 14), ('B4', 14), ('B5', 14), ('B6', 14), ('B7', 14), ('B8', 14), ('B9', 14), ('B10', 14),
('C1', 14), ('C2', 14), ('C3', 14), ('C4', 14), ('C5', 14), ('C6', 14), ('C7', 14), ('C8', 14), ('C9', 14), ('C10', 14),
('D1', 14), ('D2', 14), ('D3', 14), ('D4', 14), ('D5', 14), ('D6', 14), ('D7', 14), ('D8', 14), ('D9', 14), ('D10', 14),
('E1', 14), ('E2', 14), ('E3', 14), ('E4', 14), ('E5', 14), ('E6', 14), ('E7', 14), ('E8', 14), ('E9', 14), ('E10', 14),
('F1', 14), ('F2', 14), ('F3', 14), ('F4', 14), ('F5', 14), ('F6', 14), ('F7', 14), ('F8', 14), ('F9', 14), ('F10', 14),
('G1', 14), ('G2', 14), ('G3', 14), ('G4', 14), ('G5', 14), ('G6', 14), ('G7', 14), ('G8', 14), ('G9', 14), ('G10', 14),
('H1', 14), ('H2', 14), ('H3', 14), ('H4', 14), ('H5', 14), ('H6', 14), ('H7', 14), ('H8', 14), ('H9', 14);


insert into salon(nom_du_sallon,date_creation_salon,date_debut,date_fin)VALUES
('SALON TEST','2020-01-01','2020-01-01','2020-01-01');


INSERT INTO place_stand (id_place,id_stand,id_salon) VALUES
(1,1,2),
(3,1,2);




SELECT * FROM place
WHERE nom_place ILIKE 'A%';



SELECT distinct(id_stand),date_de_creation_stand,nom_stand,id_directeur,
description_stand,img_stand,id_etat,nom_directeur,prenom_directeur,nom_du_sallon,id_sallon
from v_membre_stand where id_directeur = 13
and id_etat IN(3,4)