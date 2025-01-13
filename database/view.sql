CREATE OR REPLACE VIEW v_permission_stand as
SELECT ps.*,nom_categorie
FROM permission_stand ps
LEFT JOIN stand s ON ps.id_permission_stand = s.id_stand
join categorie
on categorie.id_categorie=ps.id_categorie
WHERE ps.id_etat = 1;



select permission_Stand.*,nom_faculte_stand,permission_stand.img_stand as image_stand
from permission_stand join faculte_Stand
on faculte_Stand.id_faculte_stand=permission_stand.id_faculte_stand;

-----------------------------------------------------------------------

-- CREATE OR REPLACE VIEW v_membre_stand as
-- select membre_stand.*,nom_stand,description_Stand,img_Stand,stand.id_etat,nom_emp,prenom_emp,emp.email as emp_email
-- from membre_Stand
-- join stand on stand.id_stand=membre_stand.id_stand
-- join emp on emp.id_emp = membre_stand.id_directeur;

CREATE OR REPLACE VIEW v_membre_stand as
select membre_stand.*,nom_stand,description_Stand,img_Stand,stand.id_etat,directeur.nom_emp
as nom_directeur, directeur.prenom_emp as prenom_directeur,emp.nom_emp,emp.prenom_emp,emp.id_etat as id_etat_emp,
stand.date_de_creation_stand,emp.date_membre
from membre_Stand
join stand on stand.id_stand=membre_stand.id_stand
join emp as directeur on directeur.id_emp = membre_stand.id_directeur
left join emp as emp on emp.id_emp = membre_stand.id_emp;

--jerena an ilay list an ilay membre de stand any am admin
CREATE OR REPLACE VIEW v_membre_stand_v1 as
select membre_stand.*,nom_stand,description_Stand,img_Stand,stand.id_etat,directeur.nom_emp
as nom_directeur, directeur.prenom_emp as prenom_directeur,emp.nom_emp,emp.prenom_emp,COALESCE(emp.id_etat, directeur.id_etat) AS id_etat_personne,
stand.date_de_creation_stand,emp.date_membre
from membre_Stand
join stand on stand.id_stand=membre_stand.id_stand
join emp as directeur on directeur.id_emp = membre_stand.id_directeur
left join emp as emp on emp.id_emp = membre_stand.id_emp
WHERE stand.id_etat !=11;



---------------------------------------------------------------------------------



-------------------------------------------------------
-- CREATE OR REPLACE VIEW v_nombre_de_emp_par_stand as
-- SELECT
--     stand.id_stand,
--     stand.nom_stand,
--     id_directeur,
--     COUNT(emp.id_emp) AS nombre_emp
-- FROM
--     membre_stand
-- LEFT JOIN
--     emp ON emp.id_emp = membre_stand.id_emp and emp.id_etat = 2
-- JOIN
--     stand ON stand.id_stand = membre_stand.id_stand
-- GROUP BY
--     stand.id_stand,
--     stand.nom_stand,
--     id_directeur;



CREATE OR REPLACE VIEW v_nombre_de_emp_par_stand as
SELECT
    stand.id_stand,
    stand.nom_stand,
    stand.id_etat,
    id_directeur,
    COUNT(emp.id_emp) AS nombre_emp
FROM
    membre_stand
LEFT JOIN
    emp ON emp.id_emp = membre_stand.id_emp and emp.id_etat = 2
JOIN
    stand ON stand.id_stand = membre_stand.id_stand
WHERE stand.id_etat !=11
GROUP BY
    stand.id_stand,
    stand.nom_stand,
    id_directeur;




----------------------------------------------------------
CREATE OR REPLACE VIEW v_permission_recrutement_emp as
select permission_recrutement_emp.*,nom_stand,etat from permission_recrutement_emp
join stand on stand.id_stand = permission_recrutement_emp.id_stand
join etat on etat.id_etat = permission_recrutement_emp.id_etat;
-----------------------------------------------------------------------------

CREATE OR REPLACE VIEW v_list_employer_non_licensier as
SELECT * from v_membre_stand where id_emp is not null and id_etat_emp = 2;

CREATE OR REPLACE VIEW v_list_directeur_non_licensier as
SELECT v_membre_stand.*,directeur.id_etat as id_etat_directeur from v_membre_stand
join emp as directeur on directeur.id_emp = v_membre_stand.id_directeur
where v_membre_stand.id_emp is null and directeur.id_etat = 7;

SELECT * FROM v_membre_stand WHERE id_emp is null;


---select tout les emp de directeur sur tout les etat
SELECT * from v_membre_stand where id_emp is not null and id_directeur = 2;


CREATE OR REPLACE VIEW V_tout_les_employer as
SELECT * from v_membre_stand where id_emp is not null

--------------------------------------------------------------
CREATE OR REPLACE VIEW v_info_type_stand_desc as
select info_type_stand_desc.*,nom_type_stand,info_type_stand.id_stand
from info_type_stand_desc
join info_type_stand on info_type_stand.id_info_type_stand=info_type_stand_desc.id_info_type_stand
join type_stand on type_stand.id_type_Stand = info_type_stand.id_type_stand;

CREATE OR replace view v_info_type_Stand_desc_v1 as
select info_type_stand_desc.*,nom_type_stand,info_type_stand.id_stand,info_type_stand.id_type_stand
from info_type_stand_desc
join info_type_stand on info_type_stand.id_info_type_stand=info_type_stand_desc.id_info_type_stand
join type_stand on type_stand.id_type_Stand = info_type_stand.id_type_stand;

-----------------------------------------------------------------------
CREATE OR REPLACE VIEW v_permission_demission_employer as
select permission_demission_employer.*,nom_emp,prenom_emp,email,emp.id_etat as id_etat_emp
from permission_demission_employer
join emp on emp.id_emp = permission_demission_employer.id_emp;
-----------------------------------------------------------------------
CREATE OR REPLACE VIEW v_video_conference as
select video_conference.*,nom_type,nom_type_conference from video_conference
join type_video on type_video.id_type_video=video_conference.id_type_video
join type_conference on type_conference.id_type_conference=video_conference.id_type_Conference;
-------------------------------------------------------------------------
CREATE OR REPLACE VIEW v_mouvememt_personnel as
select mouvement_personnel.*,nom_emp,prenom_emp,etat from mouvement_personnel
join emp on emp.id_emp=mouvement_personnel.id_emp
join etat on etat.id_etat = mouvement_personnel.id_etat;
















----------------------------------------------------------------------------------------
--nombre stand par jour
CREATE OR REPLACE VIEW v_nombre_stand_by_day as
SELECT
    DATE(date_de_creation_stand) AS date_creation,
     TO_CHAR(DATE(date_de_creation_stand), 'Dy') AS nom_jour,
    COUNT(*) AS nombre_stands
FROM
    stand
GROUP BY
    DATE(date_de_creation_stand)
ORDER BY
    date_creation DESC;


--nombre stand par mois
CREATE OR REPLACE VIEW V_nombre_Stand_by_month_number as
SELECT
    EXTRACT(YEAR FROM date_de_creation_stand) AS annee,
    EXTRACT(MONTH FROM date_de_creation_stand) AS mois,
    COUNT(*) AS nombre_stands
FROM
    stand
GROUP BY
    EXTRACT(YEAR FROM date_de_creation_stand),
    EXTRACT(MONTH FROM date_de_creation_stand)
ORDER BY
    annee DESC, mois DESC;


CREATE OR REPLACE VIEW V_nombre_Stand_by_month as
select V_nombre_Stand_by_month_number.*,nom_mois from V_nombre_Stand_by_month_number
join mois on mois.id_mois = V_nombre_Stand_by_month_number.mois;


--nombre de stand par annee
CREATE OR REPLACE VIEW  V_nombre_Stand_by_year as
SELECT
    EXTRACT(YEAR FROM date_de_creation_stand) AS annee,
    COUNT(*) AS nombre_stands
FROM
    stand
GROUP BY
    EXTRACT(YEAR FROM date_de_creation_stand)
ORDER BY
    annee DESC;


-----------------------------------------------------------------------
CREATE OR REPLACE VIEW V_emp as
SELECT emp.*,etat from emp join etat on etat.id_Etat = emp.id_etat WHERE etat.id_etat IN (7, 2);

--nombre de personnel non licensier ni demissionner by day
CREATE OR REPLACE VIEW v_nombre_emp_by_day as
SELECT
    id_etat,
    DATE(date_membre) AS date_membre,
    TO_CHAR(DATE(date_membre), 'Dy') AS nom_jour,
    COUNT(*) AS nombre_de_personnel
FROM v_emp
GROUP BY id_etat, DATE(date_membre)
ORDER BY date_membre, id_etat DESC;


--nombre de personnel non licensier ni demissionner by month
CREATE OR REPLACE VIEW v_nombre_emp_by_month_number as
select
    EXTRACT(YEAR FROM date_membre) AS annee,
    EXTRACT(MONTH FROM date_membre) AS mois,
    count(*) as nombre_de_personnel
from v_emp
GROUP BY
    EXTRACT(YEAR FROM date_membre),
    EXTRACT(MONTH FROM date_membre)
 ORDER BY
    annee DESC, mois DESC;

CREATE OR REPLACE VIEW v_nombre_emp_by_month as
select * from v_nombre_emp_by_month_number join mois on mois.id_mois = v_nombre_emp_by_month_number.mois;


--nombre personnel nom licensier ni demmissionner by year
CREATE OR REPLACE VIEW v_nombre_emp_by_year as
select
    EXTRACT(YEAR FROM date_membre) AS annee,

    count(*) as nombre_de_personnel
from v_emp
GROUP BY
    EXTRACT(YEAR FROM date_membre)
 ORDER BY
    annee DESC;


------------------------------------------------------------------------------


select * from v_info_type_stand_desc_v1;
--nombre de contenue by day
CREATE OR REPLACE VIEW v_nombre_contenue_photo_by_day as
SELECT
    id_type_stand,
    nom_type_stand,

   EXTRACT(YEAR FROM date_creation) AS date_creation,
    TO_CHAR(DATE(date_creation), 'Dy') AS nom_jour,
    count(*) AS nombre_Contenue,
    ROUND((count(*) * 100.0) / SUM(count(*)) OVER (PARTITION BY EXTRACT(YEAR FROM date_creation),id_type_stand), 2) AS pourcentage
FROM v_info_type_stand_desc_v1
GROUP BY  id_type_stand, nom_type_stand, EXTRACT(YEAR FROM date_creation), nom_jour
ORDER BY date_creation, id_type_stand DESC;



--nombre de contenue by month
-- CREATE OR REPLACE VIEW v_nombre_contenue_photo_by_month_number as
-- select
--     id_type_stand,
--     EXTRACT(YEAR FROM date_creation) AS annee,
--     EXTRACT(MONTH FROM date_creation) AS mois,
--     count(*) nombre_contenue,
--     ROUND((count(*) * 100.0) / SUM(count(*)) OVER (PARTITION BY EXTRACT(YEAR FROM date_creation),id_type_stand), 2) AS pourcentage
--     from v_info_type_stand_desc_v1
-- GROUP BY
--     id_type_stand,
--     EXTRACT(YEAR FROM date_creation),
--     EXTRACT(MONTH FROM date_creation)
--  ORDER BY
--     annee DESC, mois DESC;

CREATE OR REPLACE VIEW v_nombre_contenue_photo_by_month_number as
select
    id_type_stand,
    EXTRACT(YEAR FROM date_creation) AS annee,
    EXTRACT(MONTH FROM date_creation) AS mois,
     SUM(json_array_length(img_info_type_stand::json)) AS nombre_contenue,
    ROUND((count(*) * 100.0) / SUM(count(*)) OVER (PARTITION BY EXTRACT(YEAR FROM date_creation),id_type_stand), 2) AS pourcentage
    from v_info_type_stand_desc_v1
GROUP BY
    id_type_stand,
    EXTRACT(YEAR FROM date_creation),
    EXTRACT(MONTH FROM date_creation)
 ORDER BY
    annee DESC, mois DESC;




CREATE OR REPLACE VIEW v_nombre_contenue_photo_by_month as
select * from v_nombre_contenue_photo_by_month_number
join mois on mois.id_mois=v_nombre_contenue_photo_by_month_number.mois;


CREATE OR REPLACE VIEW v_nombre_contenue_photo_by_year as
select
id_type_stand,
EXTRACT(YEAR FROM date_creation) AS annee,
count(*) as nombre_de_personnel,
ROUND((count(*) * 100.0) / SUM(count(*)) OVER (PARTITION BY EXTRACT(YEAR FROM date_creation),id_type_stand), 2) AS pourcentage
from v_info_type_stand_desc_v1
GROUP BY
    id_type_stand,
    EXTRACT(YEAR FROM date_creation)
 ORDER BY
    annee DESC;



--nombre contenue
---------------------------------------------
select * from video_contenue;

--pourcentage et nombre de video contenue by day par rapport a l'annee
CREATE OR REPLACE VIEW V_nombre_video_contenue_by_day as
SELECT
EXTRACT(YEAR FROM date_creation_video) AS date_creation_video,
TO_CHAR(DATE(date_creation_video), 'Dy') AS nom_jour,
count(*) AS nombre_Contenue,
ROUND((count(*) * 100.0) / SUM(count(*)) OVER (PARTITION BY EXTRACT(YEAR FROM date_creation_video)), 2) AS pourcentage
FROM video_contenue
GROUP BY  EXTRACT(YEAR FROM date_creation_video),nom_jour
ORDER BY date_creation_video DESC;



CREATE OR REPLACE VIEW v_nombre_video_contenue_by_month_number as
SELECT
EXTRACT(YEAR FROM date_creation_video) AS annee,
EXTRACT(MONTH FROM date_creation_video) AS mois,
count(*) nombre_contenue,
ROUND((count(*) * 100.0) / SUM(count(*)) OVER (PARTITION BY EXTRACT(YEAR FROM date_creation_video)), 2) AS pourcentage
FROM video_contenue
GROUP BY
    EXTRACT(YEAR FROM date_creation_video),
    EXTRACT(MONTH FROM date_creation_video)
 ORDER BY
    annee DESC, mois DESC;

CREATE OR REPLACE VIEW v_nombre_video_contenue_by_month as
SELECT * FROM v_nombre_video_contenue_by_month_number
JOIN mois on mois.id_mois = v_nombre_video_contenue_by_month_number.mois;


CREATE OR REPLACE VIEW v_nombre_video_contenue_by_year as
SELECT
EXTRACT(YEAR FROM date_creation_video) AS date_creation_video,
count(*) AS nombre_Contenue,
ROUND((count(*) * 100.0) / SUM(count(*)) OVER (PARTITION BY EXTRACT(YEAR FROM date_creation_video)), 2) AS pourcentage
FROM video_contenue
GROUP BY  EXTRACT(YEAR FROM date_creation_video)
ORDER BY date_creation_video DESC;
------------------------------------------------------------

select * from v_mouvememt_personnel;

CREATE OR REPLACE VIEW v_mouvement_personnel_by_day as
    SELECT
    EXTRACT(YEAR FROM date_mouvement) AS date_mouvement,
    TO_CHAR(DATE(date_mouvement), 'Dy') AS nom_jour,
    count(*) AS nombre_mouvement,
    ROUND((count(*) * 100.0) / SUM(count(*)) OVER (PARTITION BY EXTRACT(YEAR FROM date_mouvement)), 2) AS pourcentage
    FROM v_mouvememt_personnel
    GROUP BY  EXTRACT(YEAR FROM date_mouvement),nom_jour
    ORDER BY date_mouvement DESC;
-- select
-- EXTRACT(YEAR FROM date_mouvement) AS annee,
-- TO_CHAR(DATE(date_mouvement), 'Dy') AS nom_jour,
-- count(*) as nombre_mouvement,
-- ROUND((count(*) * 100.0) / SUM(count(*)) OVER (PARTITION BY EXTRACT(YEAR FROM date_mouvement)), 2) AS pourcentage
-- from v_mouvememt_personnel
-- GROUP BY  EXTRACT(YEAR FROM date_mouvement),nom_jour
-- ORDER BY date_mouvement DESC;

CREATE OR REPLACE VIEW v_mouvement_personnel_by_month_number as
SELECT
EXTRACT(YEAR FROM date_mouvement) AS annee,
EXTRACT(MONTH FROM date_mouvement) AS mois,
count(*) nombre_mouvement,
ROUND((count(*) * 100.0) / SUM(count(*)) OVER (PARTITION BY EXTRACT(YEAR FROM date_mouvement)), 2) AS pourcentage
FROM v_mouvememt_personnel
GROUP BY
    EXTRACT(YEAR FROM date_mouvement),
    EXTRACT(MONTH FROM date_mouvement)
 ORDER BY
    annee DESC, mois DESC;

CREATE OR REPLACE VIEW v_mouvement_personnel_by_month as
SELECT * FROM v_mouvement_personnel_by_month_number
JOIN MOIS ON MOIS.ID_MOIS = v_mouvement_personnel_by_month_number.MOIS;


CREATE OR REPLACE VIEW v_mouvememt_personnel_by_year as
SELECT
EXTRACT(YEAR FROM date_mouvement) AS annee,
count(*) AS nombre_mouvement,
ROUND((count(*) * 100.0) / SUM(count(*)) OVER (PARTITION BY EXTRACT(YEAR FROM date_mouvement)), 2) AS pourcentage
FROM v_mouvememt_personnel
GROUP BY  EXTRACT(YEAR FROM date_mouvement)
ORDER BY annee DESC;

-- SELECT
-- EXTRACT(YEAR FROM date_mouvement) AS annee,
-- count(*) AS nombre_Contenue,
-- ROUND((count(*) * 100.0) / SUM(count(*)) OVER (PARTITION BY EXTRACT(YEAR FROM date_mouvement)), 2) AS pourcentage
-- FROM v_mouvememt_personnel
-- GROUP BY  EXTRACT(YEAR FROM date_mouvement)
-- ORDER BY date_mouvement DESC;


CREATE OR REPLACE VIEW v_temoignage as
select temoignage.*,nom_stand
from temoignage
join stand on  stand.id_stand = temoignage.id_stand;




SELECT *
FROM emp
JOIN etat ON etat.id_etat = emp.id_etat
WHERE emp.prenom_emp LIKE 'p%';


SELECT *
FROM emp
JOIN etat ON etat.id_etat = emp.id_etat
WHERE emp.nom_emp ILIKE 'rama%';