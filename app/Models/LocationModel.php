<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class LocationModel extends Model
{
    //

    public function insertLocation($name,$longitude,$latitude)
    {
        DB::beginTransaction();
        try {
            //code...
            db::insert("INSERT INTO LOCATIONS(name,coordinates)
            VALUES (?, ST_SetSRID(ST_MakePoint(?, ?), 4326))",[$name,$longitude,$latitude]);
            DB::commit();
        } catch (\Throwable $e) {
            //throw $th;
            DB::rollBack(); // Annuler si quelque chose échoue
            throw $e; // Renvoyer l'erreur
        }
    }
}
