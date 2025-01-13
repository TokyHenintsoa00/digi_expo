<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class FaculteModel extends Model
{
    use HasFactory;

    public function getAllFaculteStand()
    {
        return DB::select('SELECT * FROM faculte_stand');
    }
}
