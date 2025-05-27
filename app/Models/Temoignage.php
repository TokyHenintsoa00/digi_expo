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
            $getReception = new ReceptionModel();
            $maxSalon = $getReception->maxSalon();
            $id_salon = $maxSalon[0]->id_sallon;

            DB::insert("INSERT INTO temoignage(id_stand,id_directeur,date_temoignage,liens_video,titre,id_sallon)
                VALUES(?,?,?,?,?,?)",[$id_stand,$id_directeur,$date_temoignage,$liens_video,$titre,$id_salon]);
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

    //cote DIRECTEUR => by id_directeur
    public function getTemoignageByDirecteur($id_directeur)
    {
        $temoignage = DB::table('v_temoignage')
                    ->where('id_directeur',$id_directeur)
                    ->get();
        return $temoignage;
    }

    //cote client => by max salon
    public function getTemoignageBySalon()
    {
        $getReceptionModel = new ReceptionModel();
        $maxSalon = $getReceptionModel->maxSalon();

        $id_salon = $maxSalon[0]->id_sallon;

        $temoignage = DB::table('v_temoignage')
                    ->where('id_sallon',$id_salon)
                    ->get();
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

    public function viewPermissionTemoigange()
    {
        $result = DB::select("select * from V_permission_temoignage");
        return $result;
    }

    public function permissionTemoignage($id_stand,$date_temoigange,$liens_video,$titre,
        $id_sallon,$id_directeur)
    {
        DB::beginTransaction();
        try {
            //code...
            DB::insert("INSERT INTO permission_temoignage(id_stand,date_temoignage,liens_video,titre,
                id_sallon,id_etat,id_directeur)VALUES(?,?,?,?,?,1,?)",[$id_stand,$date_temoigange,$liens_video,
                    $titre,$id_sallon,$id_directeur]);

            DB::commit();

        } catch (\Throwable $th) {
            //throw $th;
             DB::rollBack(); // Annuler si quelque chose échoue
            throw $th; // Renvoyer l'erreur
        }
    }
}
