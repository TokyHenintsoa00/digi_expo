<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class VideoModel extends Model
{
    use HasFactory;

    public function insertSalleConferenceWithLink($titre_video,$id_directeur,$id_type_video,$id_type_conference,$date_heure_salle_conference,$liens_Video)
    {
        DB::beginTransaction();
        try {
            //code...
            DB::insert("INSERT INTO video_conference(titre_video,id_directeur,id_type_video,id_type_conference,date_heure_salle_conference,liens_video)VALUES
            (?,?,?,?,?,?)",[$titre_video,$id_directeur,$id_type_video,$id_type_conference,$date_heure_salle_conference,$liens_Video]);
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
            DB::insert("INSERT INTO video_conference(titre_video,id_directeur,id_type_video,id_type_conference,date_heure_salle_conference,liens_video)VALUES
            (?,?,?,?,?,null)",[$titre_video,$id_directeur,$id_type_video,$id_type_conference,$date_heure_salle_conference]);
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


    public function getAllTypeVideo()
    {
        $result = DB::select("SELECT * FROM type_video");

        return $result;
    }

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


    public function viewVideoConferenceByIdDirecteur($id_directeur)
    {
        $result = DB::select("SELECT * FROM v_video_conference WHERE id_directeur =? order by date_heure_salle_conference  DESC",[$id_directeur]);
        return $result;
    }

    public function viewVideoConference()
    {
        $result = DB::select("SELECT * FROM v_video_conference order by date_heure_salle_conference  DESC");
        return $result;
    }


    public function countVideoConference()
    {
        $result = DB::select("SELECT COUNT(*) AS nbr_video FROM video_conference");
        return $result;
    }

}
