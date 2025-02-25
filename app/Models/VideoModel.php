<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class VideoModel extends Model
{
    use HasFactory;

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


    public function reunionPersonne($id_stand,$date_debut_conference_client,$liens_video,$id_max_salon)
    {
        DB::beginTransaction();
        try {
            DB::insert("INSERT INTO video_conference_client(id_stand,date_debut_conference_client,liens_video,id_sallon)VALUES(?,?,?,?)",[$id_stand,$date_debut_conference_client,$liens_video,$id_max_salon]);
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack(); // Annuler si quelque chose échoue
            throw $th; // Renvoyer l'erreur
        }
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



}
