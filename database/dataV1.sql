CREATE DATABASE digi_expo;
\c digi_expo;

create table organisateur
(
    id_organisateur serial primary key,
    nom_organisateur varchar(50)
);

create table contact_organisateur
(
    id_contact_organisateur serial primary key,
    id_organisateur integer references organisateur(id_organisateur),
    type_contact varchar(40),
    contact varchar(50)
);


CREATE TABLE salle_reception
(
    id_salle_reception serial primary key,
    nom_salle_reception varchar(50)
);



CREATE TABLE etat
(
    id_etat serial primary key,
    etat varchar(40)
);

CREATE TABLE admin
(
    id serial primary key,
    id_facebook varchar(200),
    nom varchar(30),
    prenom varchar(30),
    email varchar(50),
    pwd_admin varchar(500) not null,
    id_etat integer references etat(id_etat),
    created_at timestamp,
    updated_at timestamp,
);



        CREATE TABLE emp
        (
            id_emp serial primary key,
            nom_emp varchar(30),
            prenom_emp varchar(30),
            date_naissance date,
            email varchar(50),
            id_etat integer REFERENCES etat(id_etat),
            date_membre timestamp,
            matricule_emp varchar(50),
            date_de_creation timestamp(0)
        );


create table faculte_stand
(
    id_faculte_stand serial primary key,
    nom_faculte_stand varchar(60)
);

CREATE TABLE permission_stand
(
    id_permission_stand serial primary key,
    nom_stand varchar(60),
    id_faculte_stand integer references faculte_stand(id_faculte_stand),
    description_stand varchar(300),
    nom_emp varchar(30),
    prenom_emp varchar(30),
    date_naissance date,
    email varchar(50),
    img_stand bytea,
     id_etat integer REFERENCES etat(id_etat)
);

CREATE TABLE permission_recrutement_emp
(
    id_permission_recrutement_emp serial primary key,
    nom_emp varchar(40),
    prenom_emp varchar(40),
    email varchar(50),
    date_naissance date,
    id_stand integer references stand(id_stand),
   id_etat integer REFERENCES etat(id_etat)
);


CREATE TABLE stand
(
    id_stand serial primary key,
    id_faculte_stand integer references faculte_stand(id_faculte_stand),
    nom_stand varchar(60),
    description_stand varchar(300),
    img_stand text,
    id_etat integer REFERENCES etat(id_etat),
    date_de_creation_stand timestamp
);

CREATE TABLE type_stand
(
    id_type_stand serial primary key,
    nom_type_stand varchar(40)
);



CREATE TABLE info_type_stand
(
    id_info_type_stand serial primary key,
    id_stand integer references stand(id_stand),
    id_type_stand integer references type_stand(id_type_stand),
    date_creation timestamp(0)
);

CREATE TABLE info_type_stand_desc
(
    id_info_type_stand_desc serial primary key,
    id_info_type_stand integer references info_type_stand(id_info_type_stand),
    nom_info_type_stand varchar(50),
    description_info_type_stand varchar(300),
    img_info_type_stand text,
    date_creation timestamp(0)
);


CREATE TABLE membre_stand
(
    id_membre_stand serial primary key,
    id_stand integer references stand(id_stand),
    id_directeur integer references emp(id_emp),
    id_emp integer references emp(id_emp)
);


create table brochure_contenue
(
    id_brochure_stand serial primary key,
    id_info_type_stand integer references info_type_stand(id_info_type_stand),
    nom_brochure_stand varchar(40),
    img_brochure text,
    date_ajout_brochure timestamp
);

create table video_contenue
(
    id_video_contenue serial primary key,
    id_info_type_stand integer references info_type_stand(id_info_type_stand),
    nom_video varchar(40),
    video_brochure text,
    date_ajout_video timestamp
);

CREATE TABLE type_video
(
    id_type_video serial primary key,
    nom_type varchar(40)
);

CREATE table salle_conference
(
    id_salle_conference serial primary key,
    id_type_video integer references type_video(id_type_video),
    date_heure_salle_conference timestamp(0),
    liens_video text
);

CREATE table atelier
(
    id_atelier serial primary key,
    id_type_video integer references type_video(id_type_video),
    date_heure_atelier timestamp(0),
    liens_video text
);


create table permission_demission_employer
(
    id_demission_employer serial primary key,
    justification_demission varchar(300),
    id_emp integer references emp(id_emp),
    id_directeur integer references emp(id_emp),
    id_stand integer references stand(id_stand),
    date_permission_demission timestamp(0),
    date_demission timestamp(0),
    id_etat integer references etat(id_etat)
);