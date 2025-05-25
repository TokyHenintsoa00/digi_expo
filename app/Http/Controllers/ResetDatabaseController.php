<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResetDatabaseController extends Controller
{
    // public function reset()
    // {
    //     // Désactiver temporairement les triggers (qui incluent les vérifications de clé étrangère) pour PostgreSQL
    //     $tables = DB::select('SELECT tablename FROM pg_tables WHERE schemaname = ?', ['public']);

    //     foreach ($tables as $table)
    //     {
    //         if ($table->tablename === 'admin' || $table->tablename === 'etat' || $table->tablename === 'categorie' ||
    //         $table->tablename === 'type_stand' || $table->tablename === 'mois' || $table->tablename === 'type_video' || $table->tablename === 'type_conference') {
    //             continue;
    //         }



    //         // Désactiver les triggers (contraintes) avant de tronquer la table
    //         DB::statement('ALTER TABLE ' . $table->tablename . ' DISABLE TRIGGER ALL');
    //         DB::table($table->tablename)->truncate();
    //         // Réactiver les triggers (contraintes) après avoir tronqué la table
    //         DB::statement('ALTER TABLE ' . $table->tablename . ' ENABLE TRIGGER ALL');
    //     }

    //     return redirect()->back()->with('success', 'La base de données a été réinitialisée avec succès.');
    // }


    public function reset()
    {
        // Désactiver temporairement les triggers pour PostgreSQL
        $tables = DB::select('SELECT tablename FROM pg_tables WHERE schemaname = ?', ['public']);

        foreach ($tables as $table) {
            $tableName = $table->tablename;

            // Exclure certaines tables
            if (in_array($tableName, ['admin', 'etat', 'categorie', 'type_stand', 'mois', 'type_video', 'type_conference'])) {
                continue;
            }

            DB::statement("ALTER TABLE {$tableName} DISABLE TRIGGER ALL");

            if ($tableName === 'salon') {
                // Supprimer tout sauf la ligne avec id_salon = 1
                DB::table($tableName)->where('id_sallon', '!=', 1)->delete();
            } else {
                DB::table($tableName)->truncate();
            }

            DB::statement("ALTER TABLE {$tableName} ENABLE TRIGGER ALL");
        }

        return redirect()->back()->with('success', 'La base de données a été réinitialisée avec succès.');
    }

}
