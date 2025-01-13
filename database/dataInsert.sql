--insert etat
insert into etat(etat) values
('En attente'),
('Employe'),
('Sucess'),
('valide'),
('admin'),
('directeur_employer'),
('employer_licensier'),
('employer_demissionner');

--insert admin
INSERT INTO admin (id_facebook, nom, prenom, email, pwd_admin,id_etat)
VALUES
('admin_facebook_123', 'Dupont', 'Jean',  'jean.dupont@example.com', 'password1',5),
('admin_facebook_456', 'Martin', 'Sophie', 'sophie.martin@example.com', 'password2',5),
('admin_facebook_789', 'Leroy', 'Paul', 'paul.leroy@example.com', 'password3',5);

--insertion emp
INSERT INTO emp (nom, prenom, date_naissance, email,  id_etat)
VALUES
('Durand', 'Alice', '1992-01-25', 'alice.durand@example.com', 1),
('Bernard', 'Lucas', '1988-12-30', 'lucas.bernard@example.com', 2),
('Moreau', 'Clara', '1995-06-18', 'clara.moreau@example.com', 1);

--insert genre_Stand
insert into faculte_stand(nom_faculte_stand) values
('Faculté des Sciences(FSc)'),
('Faculté de Medecine'),
('Faculté de droit,Economie,Gestion,et de Sociologie(FDEGS)'),
('Faculté des Lettres et des Sciences Humaines(FLSH)'),
('Faculté des Sciences Economique'),
('Faculté des Sciences Agronomiques');

--insert stand
insert into stand(id_faculte_Stand,nom_stand,description_stand)values
(2,'Stand de la physique quantique','blablabla');

--insert membre stand
insert into membre_stand(id_stand,id_emp)values
(1,2);

--insert info stand => io ilay hoe poster etc.....
insert into info_stand(nom_info_stand)values
('Poster'),
('Projet');

--insert into info_stand_emp_projet



SELECT distinct(id_stand),id_emp,nom_stand,description_Stand,
img_stand,id_etat,nom_directeur,prenom_directeur,date_de_creation_stand
FROM  v_membre_Stand where id_etat = 3 and id_emp = 3
order by date_de_creation_stand desc