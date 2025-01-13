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
('employer_licensier');


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


--insert categorie stand


--insert stand
INSERT INTO stand (id_faculte_stand, nom_stand, description_stand, img_stand, id_etat, date_de_creation_stand)
VALUES
(1, 'Stand de Biologie', 'Ce stand presente les recherches en biologie de la Faculte des Sciences. Venez decouvrir des specimens rares et discuter avec les chercheurs.', 'img_biologie.jpg', 1, '2024-10-13 09:00:00'),
(2, 'Stand de Medecine Generale', 'Un espace dedie a la presentation des differentes branches de la medecine avec des conferences et des demonstrations en direct.', 'img_medecine.jpg', 2, '2024-10-13 10:00:00'),
(3, 'Stand de Droit et Gestion', 'Venez decouvrir les offres de formation en droit, economie, gestion, et sociologie avec des professionnels du secteur.', 'img_droit.jpg', 1, '2024-10-13 11:00:00'),
(4, 'Stand de Lettres Modernes', 'Decouvrez la richesse des etudes litteraires et des sciences humaines a travers des expositions et des presentations interactives.', 'img_lettres.jpg', 3, '2024-10-13 12:00:00'),
(5, 'Stand de Sciences Economiques', 'Un stand consacre a la presentation des programmes en sciences economiques et aux debouches professionnels.', 'img_economiques.jpg', 2, '2024-10-13 13:00:00'),
(6, 'Stand d''Agronomie', 'Decouvrez l''agronomie et les nouvelles techniques agricoles a travers des demonstrations pratiques et des echanges avec des experts.', 'img_agronomie.jpg', 1, '2024-10-13 14:00:00');

--insert type stand
insert into type_stand(nom_type_stand)
VALUES
('Projet'),
('Poster');



INSERT INTO permission_stand (nom_stand, id_faculte_stand, description_stand, nom_emp, prenom_emp, date_naissance, email, img_stand, id_etat) VALUES
('Stand de directeur1', 1, 'Description du stand 1', 'nom1', 'prenom1', '1980-01-01', 'email1@example.com', '5f62e4121617983.60c9971ce795e.jpg', 1),
('Stand de directeur2', 1, 'Description du stand 2', 'nom2', 'prenom2', '1981-02-02', 'email2@example.com', 'pizza.png', 1),
('Stand de directeur3', 1, 'Description du stand 3', 'nom3', 'prenom3', '1982-03-03', 'email3@example.com', 'image3.jpg', 1),
('Stand de directeur4', 1, 'Description du stand 4', 'nom4', 'prenom4', '1983-04-04', 'email4@example.com', 'image4.jpg', 1),
('Stand de directeur5', 1, 'Description du stand 5', 'nom5', 'prenom5', '1984-05-05', 'email5@example.com', 'image5.jpg', 1),
('Stand de directeur6', 1, 'Description du stand 6', 'nom6', 'prenom6', '1985-06-06', 'email6@example.com', 'image6.jpg', 1),
('Stand de directeur7', 1, 'Description du stand 7', 'nom7', 'prenom7', '1986-07-07', 'email7@example.com', 'image7.jpg', 1),
('Stand de directeur8', 1, 'Description du stand 8', 'nom8', 'prenom8', '1987-08-08', 'email8@example.com', 'image8.jpg', 1),
('Stand de directeur9', 1, 'Description du stand 9', 'nom9', 'prenom9', '1988-09-09', 'email9@example.com', 'image9.jpg', 1),
('Stand de directeur10', 1, 'Description du stand 10', 'nom10', 'prenom10', '1989-10-10', 'email10@example.com', 'image10.jpg', 1),
('Stand de directeur11', 1, 'Description du stand 11', 'nom11', 'prenom11', '1990-11-11', 'email11@example.com', 'image11.jpg', 1),
('Stand de directeur12', 1, 'Description du stand 12', 'nom12', 'prenom12', '1991-12-12', 'email12@example.com', 'image12.jpg', 1),
('Stand de directeur13', 1, 'Description du stand 13', 'nom13', 'prenom13', '1992-01-13', 'email13@example.com', 'image13.jpg', 1),
('Stand de directeur14', 1, 'Description du stand 14', 'nom14', 'prenom14', '1993-02-14', 'email14@example.com', 'image14.jpg', 1),
('Stand de directeur15', 1, 'Description du stand 15', 'nom15', 'prenom15', '1994-03-15', 'email15@example.com', 'image15.jpg', 1),
('Stand de directeur16', 1, 'Description du stand 16', 'nom16', 'prenom16', '1995-04-16', 'email16@example.com', 'image16.jpg', 1),
('Stand de directeur17', 1, 'Description du stand 17', 'nom17', 'prenom17', '1996-05-17', 'email17@example.com', 'image17.jpg', 1),
('Stand de directeur18', 1, 'Description du stand 18', 'nom18', 'prenom18', '1997-06-18', 'email18@example.com', 'image18.jpg', 1),
('Stand de directeur19', 1, 'Description du stand 19', 'nom19', 'prenom19', '1998-07-19', 'email19@example.com', 'image19.jpg', 1),
('Stand de directeur20', 1, 'Description du stand 20', 'nom20', 'prenom20', '1999-08-20', 'email20@example.com', 'image20.jpg', 1);
