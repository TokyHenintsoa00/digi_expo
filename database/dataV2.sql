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


CREATE TABLE salon
(
    id_sallon serial primary key,
    nom_du_sallon varchar(50),
    date_creation_salon timestamp(0)
);


--tokyh

create table popo(
    id serial primary key
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


create table categorie
(
    id_categorie serial primary key,
    nom_categorie varchar(60)
);

CREATE TABLE permission_stand
(
    id_permission_stand serial primary key,
    nom_stand varchar(60),
    id_categorie integer references categorie(id_categorie),
    nom_categorie_stand varchar(300),
    description_stand varchar(300),
    nom_emp varchar(30),
    prenom_emp varchar(30),
    date_naissance date,
    email varchar(50),
    img_stand text,
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
    id_categorie integer references categorie(id_categorie),
    nom_categorie_stand varchar(950),
    nom_stand varchar(60),
    description_stand varchar(300),
    img_stand text,
    id_etat integer REFERENCES etat(id_etat),
    date_de_creation_stand timestamp,
    date_debut_stand date,
    date_fin_stand date
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
    id_stand integer references stand(id_stand),
    titre_video varchar(50),
    description_video varchar(300),
    file_video varchar(60),
    date_creation_video timestamp(0)
);

CREATE TABLE type_video
(
    id_type_video serial primary key,
    nom_type varchar(40)
);

CREATE TABLE type_conference
(
    id_type_conference serial primary key,
    nom_type_conference varchar(40)
);

CREATE table video_conference
(
    id_salle_conference serial primary key,
    titre_video varchar(50),
    id_directeur integer references emp(id_emp),
    id_type_video integer references type_video(id_type_video),
    id_type_conference integer references type_conference(id_type_conference),
    date_heure_salle_conference timestamp(0),
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



create table mouvement_personnel(
    id_mouvement_personnel serial primary key,
    id_emp integer references emp(id_emp),
    id_etat integer references etat(id_etat),
    date_mouvement timestamp(0)
);


create table promovoir_personnel(
    id_promouvoir_personnel serial primary key,
    id_personne_enlever_fonction integer references emp(id_emp),
    id_personne_promu integer references emp(id_emp),
    id_stand integer references stand(id_stand),
    date_promouvoir timestamp(0)
);

CREATE TABLE mois (
    id_mois INT PRIMARY KEY,
    nom_mois VARCHAR(20) NOT NULL
);

-- sender_type', 'receiver_id', 'content'
CREATE TABLE messages
(
    id serial primary key,
    sender_id integer references emp(id_emp),
    receiver_id integer references emp(id_emp),
    content text,
    created_at timestamp(0),
    updated_at timestamp(0)
);


CREATE TABLE notification_message
(
    id_notitication_message serial primary key,
    user_id integer references emp(id_emp),
    messages text,
    link text,
    is_read boolean
);


CREATE TABLE temoignage(
    id_temoignage serial primary key,
    id_stand integer references stand(id_stand),
    id_directeur integer references emp(id_emp),
    date_temognage timestamp(0),
    liens_video text
);


CREATE TABLE search(
    id_search serial primary key,
    search text
);


CREATE TABLE video_conference_client
(

    id_video_conference_client serial primary key,
    id_stand integer references stand(id_stand),
    date_debut_conference_client timestamp(0),
    liens_video text
);


-- SELECT distinct(id_stand),id_directeur,nom_stand,description_Stand,
-- img_stand,id_etat,nom_directeur,prenom_directeur,date_de_creation_stand
-- FROM  v_membre_Stand where id_etat = 3 and id_directeur = 1
-- order by date_de_creation_stand desc



--                                 SELECT distinct(id_stand),id_emp,nom_stand,description_Stand,
--                                 img_stand,id_etat,nom_directeur,prenom_directeur,date_de_creation_stand
--                                 FROM  v_membre_Stand where id_etat = 3 and id_emp = ?
--                                 order by date_de_creation_stand desc