CREATE DATABASE digi_tech;
CREATE TABLE etat
(
    id_etat serial primary key,
    etat varchar(40)
);

CREATE TABLE admin
(
    id_Admin serial primary key,
    id_facebook_admin varchar(200),
    nom varchar(30),
    prenom varchar(30),
    date_naissance date,
    email varchar(50),
    pwd_admin varchar(50) not null,
    id_etat integer references etat(id_etat)
);

CREATE TABLE emp
(
    id_emp serial PRIMARY KEY,
    nom varchar(30),
    prenom varchar(30),
    date_naissance date,
    email varchar(50),
    id_etat integer REFERENCES etat(id_etat),
    matricule_emp varchar(50) -- Matricule sera calculé lors de l'insertion
);

create table faculte_stand
(
    id_faculte_Stand serial primary key,
    nom_faculte_stand varchar(40)
);

create table stand
(
    id_stand serial primary key,
    id_faculte_Stand integer references faculte_stand(id_faculte_Stand),
    nom_stand varchar(40),
    description_stand varchar(200)
);

create table membre_Stand
(
    id_membre_stand serial primary key,
    id_stand integer references stand(id_stand),
    id_emp integer references emp(id_emp)
);

create table info_stand
(
    id_info_stand serial primary key,
    nom_info_stand varchar(40)
);

create table info_Stand_emp_projet
(
    id_info_stand_emp_projet serial primary key,
    id_stand integer references stand(id_stand),
    id_info_stand integer references info_stand(id_info_stand),
    nom_projet varchar(50),
    description_projet varchar(900),
    date_ajout_projet timestamp
);

create table info_Stand_emp_poster
(
    id_info_stand_emp_poster serial primary key,
    id_stand integer references stand(id_stand),
    id_info_stand integer references info_stand(id_info_stand),
    img_postger text,
    date_ajout_postger timestamp
);

create table brochure_Stand
(
    id_brochure_stand serial primary key,
    id_stand integer references stand(id_stand),
    nom_brochure_stand varchar(40),
    img_brochure text,
    date_ajout_brochure timestamp
);