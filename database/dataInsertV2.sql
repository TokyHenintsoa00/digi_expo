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
('Supprimer');

--insert admin
INSERT INTO admin (id_facebook, nom, prenom, email, pwd_admin, id_etat)
VALUES
('fb_admin1', 'Randrianarison', 'Andry', 'andry.randrianarison@gmail.com', 'password123', 6),
('fb_admin2', 'Rasoanaivo', 'Tahina', 'tahina.rasoanaivo@gmail.com', 'adminpass456', 6),
('fb_admin3', 'Rakotovao', 'Heriniaina', 'heriniaina.rakotovao@gmail.com', 'heripass789', 6),
('fb_admin4', 'Ramanana', 'Lalao', 'lalao.ramanana@gmail.com', 'lalaopass101', 6),
('fb_admin5', 'Razafimahaleo', 'Mialy', 'mialy.razafimahaleo@gmail.com', 'mialypass202', 6),
('fb_admin6', 'Rakotonirina', 'Solo', 'solo.rakotonirina@gmail.com', 'solopass303', 6);


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