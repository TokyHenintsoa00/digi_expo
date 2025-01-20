<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Temoignage extends Model
{
    use HasFactory;

    protected $fillable = ['id_stand', 'id_directeur', 'date_temoignage', 'liens_video'];

    public function insertTemoignage($id_stand,$id_directeur,$date_temoignage,$liens_video,$titre)
    {
        DB::beginTransaction();
        try {
            //code...
            DB::insert("INSERT INTO temoignage(id_stand,id_directeur,date_temoignage,liens_video,titre)
                VALUES(?,?,?,?,?)",[$id_stand,$id_directeur,$date_temoignage,$liens_video,$titre]);
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack(); // Annuler si quelque chose échoue
            throw $th; // Renvoyer l'erreur
        }
    }

    public function getAllTemoignage()
    {
        $temoignage = DB::table('v_temoignage')->get();
        return $temoignage;
    }

    public function countTemoignage()
    {
        $result = DB::select("SELECT COUNT(*) AS nbr_temoignage FROM V_TEMOIGNAGE");
        return $result;
    }


    public function modificationTemoignageWithLink($id_stand,$date_temoignage,$liens_video,$titre,$id_temoignage)
    {
        DB::beginTransaction();
        try
        {
            DB::update("UPDATE temoignage set id_stand = ?, date_temoignage = ?, liens_video = ?, titre = ? WHERE id_temoignage=?",[$id_stand,$date_temoignage,$liens_video,$titre,$id_temoignage]);
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack(); // Annuler si quelque chose échoue
            throw $th; // Renvoyer l'erreur
        }
    }


    public function modificationTemoignageWithoutLink($id_stand,$date_temoignage,$titre,$id_temoignage)
    {
        DB::beginTransaction();
        try
        {
            DB::update("UPDATE temoignage set id_stand = ?, date_temoignage = ?, titre = ? WHERE id_temoignage=?",[$id_stand,$date_temoignage,$titre,$id_temoignage]);
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack(); // Annuler si quelque chose échoue
            throw $th; // Renvoyer l'erreur
        }
    }

    public function addLinkTemoignage($link_video,$id_temoignage)
    {
        DB::beginTransaction();
        try
        {
            DB::update("UPDATE temoignage set liens_video = ? where id_temoignage = ?",[$link_video,$id_temoignage]);
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack(); // Annuler si quelque chose échoue
            throw $th; // Renvoyer l'erreur
        }
    }

}
