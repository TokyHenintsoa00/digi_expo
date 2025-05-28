<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class VideoModel extends Model
{
    use HasFactory;

    public function permissionVideoConference($titre_video,$id_directeur,$id_type_video,
    $id_type_conference,$date_heure_salle_conference,$liens_Video)
    {
        DB::beginTransaction();
        try {
            //code...
            $getReceptionModel = new ReceptionModel();
            $maxSalon = $getReceptionModel->maxSalon();
            $id_sallon = $maxSalon[0]->id_sallon;

            DB::insert("INSERT INTO permission_video_conference(titre_video,id_directeur,id_type_video,id_type_conference,date_heure_salle_conference,liens_video,id_sallon,id_etat)VALUES
            (?,?,?,?,?,?,?,1)",[$titre_video,$id_directeur,$id_type_video,
            $id_type_conference,$date_heure_salle_conference,$liens_Video,$id_sallon]);
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack(); // Annuler si quelque chose échoue
            throw $th; // Renvoyer l'erreur
        }
    }

    public function permissionVideoConferenceModification($titre_video,$id_directeur,$id_type_video,
    $id_type_conference,$date_heure_salle_conference,$liens_Video,$id_salle_conference)
    {
        DB::beginTransaction();
        try {
            //code...
            $getReceptionModel = new ReceptionModel();
            $maxSalon = $getReceptionModel->maxSalon();
            $id_sallon = $maxSalon[0]->id_sallon;

            DB::insert("INSERT INTO permission_video_conference(titre_video,id_directeur,id_type_video,id_type_conference,
            date_heure_salle_conference,liens_video,id_sallon,id_salle_conference,id_etat)VALUES
            (?,?,?,?,?,?,?,?,15)",[$titre_video,$id_directeur,$id_type_video,
            $id_type_conference,$date_heure_salle_conference,$liens_Video,$id_sallon,$id_salle_conference]);
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack(); // Annuler si quelque chose échoue
            throw $th; // Renvoyer l'erreur
        }
    }

    public function viewPermissionConfenrence()
    {
       $result = DB::select("SELECT * FROM v_permission_video_confenrence");

        return $result;
    }

    public function updateEtatPermissionConfenrence($id_permission_video_conference )
    {
        $result = DB::update("UPDATE permission_video_conference SET id_etat = 4 where id_permission_video_conference  = ?",[$id_permission_video_conference ]);

        return $result;
    }

    public function insertSalleConferenceWithLink($titre_video,$id_directeur,$id_type_video,
    $id_type_conference,$date_heure_salle_conference,$liens_Video)
    {
        DB::beginTransaction();
        try {
            //code...
            $getReceptionModel = new ReceptionModel();
            $maxSalon = $getReceptionModel->maxSalon();
            $id_sallon = $maxSalon[0]->id_sallon;

            DB::insert("INSERT INTO video_conference(titre_video,id_directeur,id_type_video,id_type_conference,date_heure_salle_conference,liens_video,id_sallon)VALUES
            (?,?,?,?,?,?,?)",[$titre_video,$id_directeur,$id_type_video,$id_type_conference,$date_heure_salle_conference,$liens_Video,$id_sallon]);
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack(); // Annuler si quelque chose échoue
            throw $th; // Renvoyer l'erreur
        }
    }

    public function insertSalleConferenceWithoutLink($titre_video,$id_directeur,$id_type_video,$id_type_conference,$date_heure_salle_conference)
    {
        DB::beginTransaction();
        try {
            //code...

            $getReceptionModel = new ReceptionModel();
            $maxSalon = $getReceptionModel->maxSalon();
            $id_sallon = $maxSalon[0]->id_sallon;

            DB::insert("INSERT INTO video_conference(titre_video,id_directeur,id_type_video,id_type_conference,date_heure_salle_conference,liens_video,id_sallon)VALUES
            (?,?,?,?,?,null,?)",[$titre_video,$id_directeur,$id_type_video,$id_type_conference,$date_heure_salle_conference,$id_sallon]);
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack(); // Annuler si quelque chose échoue
            throw $th; // Renvoyer l'erreur
        }
    }


    public function getAllTypeConference()
    {
        $result = DB::select("SELECT * FROM type_conference");

        return $result;
    }

    public function typeConferenceWithAlterlierAndSalleConf()
    {
        $result = DB::select("SELECT * FROM type_conference WHERE id_type_conference IN(1,2)");
        return $result;
    }

    // public function typeConferenceWithGalerie()
    // {
    //     $result = DB::select("SELECT * FROM type_conference WHERE id_type_conference = 3");
    //     return $result;
    // }


    public function getAllTypeVideo()
    {
        $result = DB::select("SELECT * FROM type_video");

        return $result;
    }

    public function typeVideoWithAtelierandSalleConf()
    {
        $result = DB::select("SELECT * FROM type_video WHERE id_type_video in(2,3)");

        return $result;
    }

    // public function typeVideoWithGalerie()
    // {
    //     $result = DB::select("SELECT * FROM type_video WHERE id_type_video = 1");

    //     return $result;
    // }

    public function modificationVideoConferenceWithLink($titre_video,$id_type_video,$id_type_conference,$date_heure_salle_conference,$liens_Video,$id_salle_conference)
    {
        DB::beginTransaction();
        try {
            //code...
            DB::update("UPDATE video_conference SET titre_video = ?,id_type_video=?,id_type_conference=?,date_heure_salle_conference=?,liens_video=? WHERE id_salle_conference=?",
            [$titre_video,$id_type_video,$id_type_conference,$date_heure_salle_conference,$liens_Video,$id_salle_conference]);
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack(); // Annuler si quelque chose échoue
            throw $th; // Renvoyer l'erreur
        }
    }


    public function modificationVideoConferenceWithoutLink($titre_video,$id_type_video,$id_type_conference,$date_heure_salle_conference,$id_salle_conference)
    {
        DB::beginTransaction();
        try {
            //code...
            DB::update("UPDATE video_conference SET titre_video = ?,id_type_video=?,id_type_conference=?,date_heure_salle_conference=? WHERE id_salle_conference=?",
            [$titre_video,$id_type_video,$id_type_conference,$date_heure_salle_conference,$id_salle_conference]);
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack(); // Annuler si quelque chose échoue
            throw $th; // Renvoyer l'erreur
        }
    }


    public function AddLink($liens_Video,$id_salle_conference)
    {
        DB::beginTransaction();
        try
        {
            DB::update("UPDATE video_conference set liens_video = ? WHERE id_salle_conference = ?", [$liens_Video,$id_salle_conference]);
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack(); // Annuler si quelque chose échoue
            throw $th; // Renvoyer l'erreur
        }
    }

    //cote directeur
    public function viewVideoConferenceByIdDirecteur($id_directeur)
    {
        $result = DB::select("SELECT * FROM v_video_conference WHERE id_directeur =? order by date_heure_salle_conference  DESC",[$id_directeur]);
        return $result;
    }
    //cote client
    public function viewVideoConference()
    {
        $getReceptionModel = new ReceptionModel();
        $max_salon = $getReceptionModel->maxSalon();
        $id_salon = $max_salon[0]->id_sallon;
        $result = DB::select("SELECT * FROM v_video_conference where id_sallon = ? order by date_heure_salle_conference  DESC",[$id_salon]);
        return $result;
    }


    public function countVideoConference()
    {
        $result = DB::select("SELECT COUNT(*) AS nbr_video FROM video_conference");
        return $result;
    }




    public function reunionPersonne($id_stand,$date_debut_conference_client,$liens_video,$id_max_salon,$id_directeur)
    {
        DB::beginTransaction();
        try {
            DB::insert("INSERT INTO video_conference_client(id_stand,date_debut_conference_client,liens_video,id_sallon,id_directeur)VALUES(?,?,?,?,?)",[$id_stand,$date_debut_conference_client,$liens_video,$id_max_salon,$id_directeur]);
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack(); // Annuler si quelque chose échoue
            throw $th; // Renvoyer l'erreur
        }
    }

    public function permissionConferenceClient($id_stand,$date_debut_conference_client,$liens_video,$id_max_salon,$id_directeur)
    {
       DB::beginTransaction();
        try {
            DB::insert("INSERT INTO permission_video_conference_client(id_stand,
                date_debut_conference_client,liens_video,id_sallon,id_etat,id_directeur)
                VALUES(?,?,?,?,1,?)",[$id_stand,$date_debut_conference_client,
                $liens_video,$id_max_salon,$id_directeur]);
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack(); // Annuler si quelque chose échoue
            throw $th; // Renvoyer l'erreur
        }
    }



    public function viewPermissionConferenceClient()
    {
        $result = DB::select("SELECT * FROM v_permission_video_conference_client");
        return $result;
    }

    public function getAllReunionPersonne()
    {
        $salon = new ReceptionModel();
        $getMaxSalon = $salon->maxSalon();

        $max_salon = $getMaxSalon[0]->id_sallon;

        $result = DB::select("SELECT video_conference_client.*,nom_Stand from video_conference_client
                                join stand on video_conference_client.id_stand = stand.id_Stand where video_conference_client.id_sallon = ?",[$max_salon]);
        return $result;
    }


    public function updateEtatPermissionVideoConferenceClientModifier($id_permission_video_conferece_client)
    {
        $result = DB::update("UPDATE permission_video_conference_client set id_etat = 4 where id_permission_video_conferece_client = ?",[$id_permission_video_conferece_client]);
        return $result;
    }


    public function viewListVideoConferenceClient($id_directeur)
    {
        $result = DB::select("SELECT * FROM VIDEO_CONFERENCE_cLIENT WHERE id_directeur = ? order by date_debut_conference_client desc",[$id_directeur]);

        return $result;
    }

}
