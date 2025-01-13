<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DirecteurModel extends Model
{
    use HasFactory;

    public function getStandDirecteur()
    {
        $result = DB::select("SELECT * FROM v_membre_stand");
        return $result;
    }


}
