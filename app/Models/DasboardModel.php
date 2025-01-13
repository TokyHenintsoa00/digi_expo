<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class DasboardModel extends Model
{
    use HasFactory;

    public function nombreStandByDay()
    {
        return DB::table('v_nombre_stand_by_day')->get();
    }

    public function nombreStandByMonth()
    {
        return DB::table('v_nombre_stand_by_month')->get();
    }

    public function nombreStandByYear()
    {
        return DB::table('v_nombre_stand_by_year')->get();
    }



    public function nombreEmpByDay()
    {
        return DB::table('v_nombre_emp_by_day')->get();
    }

    public function nombreEmpByMonth()
    {
        return DB::table('v_nombre_emp_by_month')->get();
    }

    public function nombreEmpByYear()
    {
        return DB::table('v_nombre_emp_by_year')->get();
    }




    public function mouvementPersonnelByDay()
    {
        return DB::table('v_mouvement_personnel_by_day')->get();
    }

    public function mouvementPersonnelByMonth()
    {
        return DB::table('v_mouvement_personnel_by_month')->get();
    }

    public function mouvementPersonnelByYear()
    {
        return DB::table('v_mouvememt_personnel_by_year')->get();
    }




    public function nombreContenuePhotoByDay()
    {
        return DB::table('v_nombre_contenue_photo_by_day')->get();
    }

    public function nombreContenuePhotoByMonth()
    {
        return DB::table('v_nombre_contenue_photo_by_month')->get();
    }

    public function nombreContenuePhotoByYear()
    {
        return DB::table('v_nombre_contenue_photo_by_year')->get();
    }



    public function nombreContenueVideoByDay()
    {
        return DB::table('v_nombre_video_contenue_by_day')->get();
    }

    public function nombreContenueVideoByMonth()
    {
        return DB::table('v_nombre_video_contenue_by_month')->get();
    }

    public function nombreContenueVideoByYear()
    {
        return DB::table('v_nombre_video_contenue_by_year')->get();
    }


}
