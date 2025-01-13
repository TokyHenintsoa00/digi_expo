<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CategorieModel extends Model
{
    use HasFactory;

    public function getAllCategorie()
    {
        $result = DB::select("SELECT * FROM categorie");

        return $result;
    }

}
