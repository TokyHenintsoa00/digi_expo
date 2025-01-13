<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Event extends Model
{
    use HasFactory;
    protected $table = 'events'; // Assurez-vous que la table s'appelle 'events'
    protected $fillable = ['title', 'start', 'end', 'importance', 'color','id_emp'];

    public function getAll($id_emp)
    {
        $result = DB::select("SELECT * FROM events WHERE id_emp = ?",[$id_emp]);
        return $result;
    }

    public function getAllEventByAdmin()
    {
        $result = DB::select("SELECT * FROM events WHERE id_emp is null");
        return $result;
    }

    public function recherche($table)
    {
        $result = DB::select("SELECT * FROM" .$table);
        return $result;

    }

}
