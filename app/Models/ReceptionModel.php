<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class ReceptionModel extends Model
{
    use HasFactory;

    //count le salon pour verifier si il dep de 1

    public function countSalon()
    {
        $result = DB::select("SELECT COUNT(*) from salon");
        return $result;
    }

    public function verifySalon()
    {
        $count = $this->countSalon();
        if ($count >=2) {
            # code...
            return redirect()->back()->withErrors(['error' => 'Invalide verifier votre email ou votre mots de passe'])->withInput();
        }
    }

    
    public function getOrganisateur($nom_organisateur)
    {
        $result = DB::select("SELECT * FROM organisateur WHERE nom_organisateur = ?",[$nom_organisateur]);
        return $result;
    }

    public function getAllOranisateur()
    {
        $result = DB::select("SELECT * FROM ORGANISATEUR");
        return $result;
    }

    public function getAllContactOrganisateur()
    {
        $result = DB::select("SELECT * FROM contact_organisateur");
        return $result;
    }

    public function getAllSalon()
    {
        $result = DB::select("SELECT * FROM salon");
        return $result;
    }


    public function insertSalon($nom_sallon,$date_debut,$date_fin)
    {
        DB::beginTransaction();
        try {
            //code...
            DB::insert("INSERT INTO salon(nom_du_sallon,date_creation_salon,date_debut,date_fin)values(?,CURRENT_TIMESTAMP,?,?)",[$nom_sallon,$date_debut,$date_fin]);
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack(); // Annuler si quelque chose échoue
            throw $th; // Renvoyer l'erreur
        }
    }

    public function insertOrganisateur($nom_organisateur)
    {
        DB::beginTransaction();
        try {
            //code...
            DB::insert("INSERT INTO organisateur(nom_organisateur) VALUES(?)",[$nom_organisateur]);
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack(); // Annuler si quelque chose échoue
            throw $th; // Renvoyer l'erreur
        }
    }


    public function insertContact($id_organisateur,$type_contact,$contact)
    {
        DB::beginTransaction();
        try
        {
            //code...
            DB::insert("INSERT INTO contact_organisateur(id_organisateur,type_contact,contact)VALUES(?,?,?)",[$id_organisateur,$type_contact,$contact]);
            DB::commit();

        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack(); // Annuler si quelque chose échoue
            throw $th; // Renvoyer l'erreur
        }
    }
}
