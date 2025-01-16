<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class EmpModel extends Model
{
    use HasFactory;

    protected $table = 'emp'; // Nom de votre table
    protected $primaryKey = 'id_emp'; // Clé primaire

     // Colonnes autorisées pour l'authentification
     protected $fillable = [
        'nom_emp',
        'prenom_emp',
        'date_naissance',
        'email',
        'id_etat',
        'date_membre',
        'matricule_emp',
        'remember_tokoen',
    ];

    //cette fonction va prendre la matricule de emp
     //cette fonction est utilise par l'admin



     public function getAllEmpById($nom_emp,$prenom_emp,$email)
     {
        $result = DB::select("SELECT  * FROM EMP where nom_emp = ? and prenom_emp = ? and email = ?",[$nom_emp,$prenom_emp,$email]);
        return $result;
     }

    public function getAuthEmp($email,$matricule_emp)
    {
        $result  = DB::select("SELECT * FROM emp Where email=? and matricule_emp=?",[$email,$matricule_emp]);
        return $result;
    }

    public function getInfoByEmail($email)
    {
        return DB::table('admin')
                ->where('email',$email)
                ->get();
    }



    //  //function se connecter
    //  public function authentificationEmp($email,$matricule_emp,$remember)
    //  {
    //     $authEmp  = $this->getAuthEmp($email,$matricule_emp);
    //      if ($remember ==TRUE) {
    //         # code...
    //          // Créer un cookie pour se souvenir de l'utilisateur pendant 7 jours
    //          Cookie::queue('remembre_emp', $authEmp[0]->id_emp, 60 * 24 * 7); // 7 jours


    //          Session::put('id_emp', $authEmp[0]->id_emp);
    //          return $authEmp;
    //      }
    //      else
    //      {
    //         Session::put('id_emp', $authEmp[0]->id_emp);
    //         return $authEmp;
    //      }
    //  }


         //function se connecter
         public function authentificationEmp($email,$matricule_emp,$remember)
         {
            $authEmp  = $this->getAuthEmp($email,$matricule_emp);
            $cookieName = 'id_emp_' . $authEmp[0]->id_emp; // Utilisation d'un nom de cookie unique
             if ($remember ==TRUE) {
                # code...
                 // Créer un cookie pour se souvenir de l'utilisateur pendant 7 jours
                 $cookie = Cookie::make($cookieName, $authEmp[0]->id_emp, 60 * 24 * 7); // 7 jours
                 Cookie::queue($cookie);
                 Session::put('id_emp', $authEmp[0]->id_emp);
                 return $authEmp;
             }
             else
             {
                Session::put($cookieName, $authEmp[0]->id_emp);
                return $authEmp;
             }
         }

         //function se connecter
         public function authentificationEmpV1($email,$matricule_emp,$remember)
         {
            $authEmp  = $this->getAuthEmp($email,$matricule_emp);
            $cookieName = 'id_emp_' . $authEmp[0]->id_emp; // Utilisation d'un nom de cookie unique
            Session::put('id_emp', $authEmp[0]->id_emp);
            return $authEmp;
         }


     public function getEmpById($id_emp)
     {
        $result = DB::select("SELECT * FROM emp where id_emp=?",[$id_emp]);
        return $result;
     }

     public function MaxIdEmp()
     {
        $result = DB::select("SELECT MAX(id_emp) as id_emp from emp");
        return $result;
     }


    //function insertion de permission pour le recrutement de l'employer
    public function insertPermissionEmployer($nom_emp,$prenom_emp,
        $email,$date_naissace,$id_stand,$id_expediteur)
    {
        DB::beginTransaction();
        try
        {
            DB::insert("INSERT INTO permission_recrutement_emp(nom_emp,prenom_emp,email,date_naissance,id_stand,id_etat,id_expediteur)
                VALUES(?,?,?,?,?,1,?)",[$nom_emp,$prenom_emp,$email,$date_naissace,$id_stand,$id_expediteur]);
            Db::commit();
        } catch (\Throwable $e) {
            //throw $th;
            //throw $th;
            DB::rollBack(); // Annuler si quelque chose échoue
            throw $e; // Renvoyer l'erreur
        }
    }


    //list dde permission de recrutement "en attente" a valider
    public function getAllPermissionRecrutementEmp()
    {
        $result = DB::select("SELECT * FROM v_permission_recrutement_emp where id_etat = 1");

        return $result;
    }

    //validation de permission de recrutement
    public function validePermissionRecrutement($nom_emp,$prenom_emp,$date_naissance,$email,$id_stand,$id_permission_recrutement_emp,$id_directeur)
    {

        DB::beginTransaction();

        try
        {
            DB::insert("INSERT INTO emp(nom_emp,prenom_emp,date_naissance,email,id_etat,date_membre)
            VALUES(?,?,?,?,2,CURRENT_TIMESTAMP)",[$nom_emp,$prenom_emp,$date_naissance,$email]);
            $getemp = DB::select("SELECT MAX(ID_EMP) AS id_emp FROM EMP");
            $id_emp = $getemp[0]->id_emp;
            DB::insert("INSERT INTO membre_stand(id_stand,id_directeur,id_emp)VALUES(?,?,?)",[$id_stand,$id_directeur,$id_emp]);
            DB::update("UPDATE permission_recrutement_emp set id_etat = 4 where id_permission_recrutement_emp = ?",[$id_permission_recrutement_emp]);

            DB::commit();
        } catch (\Throwable $e) {

            //throw $th;
             //throw $th;
             DB::rollBack(); // Annuler si quelque chose échoue
             throw $e; // Renvoyer l'erreur
        }
    }

    //refus de recrutement
    public function refusRecrutement($id_permission_recrutement_emp)
    {
        DB::beginTransaction();
        try
        {
            DB::update("UPDATE permission_recrutement_emp set id_etat = 5 where id_permission_recrutement_emp = ?",[$id_permission_recrutement_emp]);
            db::commit();

        } catch (\Throwable $e) {
            //throw $th;
            DB::rollBack(); // Annuler si quelque chose échoue
            throw $e; // Renvoyer l'erreur
        }
    }


    //liste des employer a licensier
    public function getAllEmployerDirecteur($id_directeur)
    {
        $result = DB::select("SELECT * from v_membre_stand where id_emp is not null and id_directeur = ? and id_etat_emp = 2 ",[$id_directeur]);
        return $result;
    }

    public function verifyDirecteur($id_directeur)
    {
        $result = DB::select("SELECT * FROM membre_stand where id_directeur = ? and id_emp is null");
    }

    public function licensiment($id_emp)
    {
        $result = DB::update("UPDATE emp set id_etat = 8 where id_emp = ?",[$id_emp]);
        return $result;
    }

    public function licensimentDirecteur($id_directeur)
    {
        $result = DB::update("UPDATE emp set id_etat = 10 where id_emp = ?",[$id_directeur]);
        return $result;
    }



    public function promouvoirEmployer($id_emp)
    {
        DB::beginTransaction();
        try {
            //code...
            DB::update("UPDATE emp set id_etat = 7 where id_emp = ?",[$id_emp]);
            DB::update("UPDATE membre_stand
            SET id_directeur = id_emp,  -- Déplacer la valeur de id_emp vers id_directeur
            id_emp = NULL           -- Mettre id_emp à NULL
            WHERE id_emp =?",[$id_emp]);


                DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack(); // Annuler si quelque chose échoue
            throw $th; // Renvoyer l'erreur
        }
    }

    public function promouvoirEmployerV1($id_emp,$id_directeur,$id_membre_stand)
    {
        DB::beginTransaction();
        try {
            //code...
            //[1]
            DB::update("UPDATE emp set id_etat = 7 where id_emp = ?",[$id_emp]);

            //[2]
            DB::update("UPDATE membre_stand
            SET id_directeur = id_emp,  -- Déplacer la valeur de id_emp vers id_directeur
            id_emp = NULL           -- Mettre id_emp à NULL
            WHERE id_emp =?",[$id_emp]);

            //[3]
            DB::update("UPDATE membre_stand
            SET
                id_directeur = ?
            WHERE id_directeur =? AND id_emp IS NOT NULL", [$id_emp,$id_directeur]);
            db::delete("DELETE FROM membre_stand where id_membre_stand = ?",[$id_membre_stand]);

            DB::commit();

        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack(); // Annuler si quelque chose échoue
            throw $th; // Renvoyer l'erreur
        }
    }

    public function resteStandDirecteur($id_directeur)
    {
        $result = DB::select("SELECT * FROM membre_stand where id_directeur = ? and id_emp is null",[$id_directeur]);
        return $result;
    }

    public function verifyStandByIdDirecteur($id_directeur,$id_emp,$id_stand)
    {
        $restStandDirecteur = $this->resteStandDirecteur($id_directeur);
        if ($restStandDirecteur !=null) {
            # code...
            $promouvoir = $this->insertPromouvoirPersonnel($id_directeur,$id_emp,$id_stand);
        }
        else{
            $licensimentDirecteur = $this->licensimentDirecteur($id_directeur);
            $mouvementPersonnel = $this->insertMouvementPersonnelLicensimentDirecteur($id_directeur);
            $promouvoir = $this->insertPromouvoirPersonnel($id_directeur,$id_emp,$id_stand);
        }
    }


    //liste de toute les directeur non licensier
    public function getAllDirecteur()
    {
        $result = DB::select("SELECT * from v_list_directeur_non_licensier");
        return $result;
    }

    //list de toute les employer non licensier
    public function getAllEmployer()
    {
        $result = DB::select("SELECT * from v_list_employer_non_licensier");
        return $result;
    }



    //liste des employer non licensier
    //BY ID DIRECTEUR
    public function getAllEmployerByIdDirecteur($id_directeur)
    {
        $result = DB::select("SELECT * from v_list_employer_non_licensier where id_directeur = ?",[$id_directeur]);

        return $result;
    }

    //list des employer non licensier
    //BY ID DIRECTEUR ET BY ID STAND
    public function getAllEmployerByIdDirecteurAndByIdStand($id_directeur,$id_stand)
    {
        $result = DB::select("SELECT * from v_list_employer_non_licensier where id_directeur = ? and id_stand = ?",[$id_directeur,$id_stand]);
        return $result;
    }

    //cette fonction va selecter tous les employer des directeur meme si y sont demissionner ou licensier
    public function getAllEmployerDirecteurByAllEtat($id_directeur)
    {
        $result = DB::select("SELECT * from v_membre_stand where id_emp is not null and id_directeur = ?",[$id_directeur]);
        return $result;
    }

    //cette fonction va selecter TOUT LES MOUVEMENT DES EMP DES DIRECTEUR
    public function getAllMouvementPersonneByIdEmp(array $id_emp)
    {
        return DB::table('v_mouvememt_personnel')
            ->whereIn('id_emp', $id_emp)
            ->get();
    }


    //geter employer qui n'est pas encore licecier par leur id =>id_employer
    public function getEmpDemandeDemission($id_emp)
    {
        $result = DB::select("SELECT * FROM v_list_employer_non_licensier WHERE id_emp = ?",[$id_emp]);

        return $result;
    }

    //list de tout les employer sans exception
    public function getAllEmployer1ByIdDirecteur($id_directeur)
    {
        $result = DB::select("SELECT * FROM V_tout_les_employer WHERE id_directeur = ?",[$id_directeur]);
        return $result;
    }




    public function permissionDemissionEmployer($justification_demission,$id_emp,$id_directeur,$id_stand)
    {
        DB::beginTransaction();
        try {
            //code...
            DB::insert("INSERT INTO permission_demission_employer(justification_demission,id_emp,
            id_directeur,id_stand,date_permission_demission,date_demission,id_etat)VALUES(?,?,?,?,CURRENT_TIMESTAMP,null,1)",[$justification_demission,$id_emp,$id_directeur,$id_stand]);

            DB::commit();

        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack(); // Annuler si quelque chose échoue
            throw $e; // Renvoyer l'erreur
        }
    }

    public function validationPermissionDemission($id_emp)
    {
        DB::beginTransaction();
        try {
            //code...
            DB::update("UPDATE permission_demission_employer set id_etat = 4, date_demission=CURRENT_TIMESTAMP  WHERE id_emp = ?",[$id_emp]);
            DB::update("UPDATE emp set id_etat = 9 WHERE id_emp = ?",[$id_emp]);

            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack(); // Annuler si quelque chose échoue
            throw $e; // Renvoyer l'erreur
        }
    }

    public function getAllPermissionDemissionEmployerByIdDirecteur($id_directeur)
    {
        $result = DB::select("SELECT * FROM v_permission_demission_employer WHERE id_directeur = ?",[$id_directeur]);

        return $result;
    }

    public function getJustificationDemission($id_demission_employer)
    {
        $justification = DB::select("SELECT * FROM v_permission_demission_employer WHERE id_demission_employer = ?",[$id_demission_employer]);
        return $justification;
    }


    //les nombre des employer par stand
    public function countEmpStandByDirecteur($id_directeur)
    {
        $result = DB::select("SELECT * FROM v_nombre_de_emp_par_stand where id_directeur = ?",[$id_directeur]);
        return $result;
    }

    //infotmation de tout les personnel
    //=>UTILISER SEUKEMENT POUR ADMUI

    public function getAllInfoEmpByAdmin()
    {
        $result = DB::select("SELECT * from emp join etat on etat.id_Etat = emp.id_etat");

        return $result;
    }


    public function insertMouvementPersonnelLicensimentEmp($id_emp)
    {
        DB::beginTransaction();
        try {
            //code...
            DB::insert("INSERT INTO mouvement_personnel(id_emp,id_etat,date_mouvement)VALUES(?,8,CURRENT_TIMESTAMP)",[$id_emp]);
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack(); // Annuler si quelque chose échoue
            throw $th; // Renvoyer l'erreur

        }
    }

    public function insertMouvementPersonnelLicensimentDirecteur($id_directeur)
    {
        DB::beginTransaction();
        try {
            //code...
            DB::insert("INSERT INTO mouvement_personnel(id_emp,id_etat,date_mouvement)VALUES(?,10,CURRENT_TIMESTAMP)",[$id_directeur]);
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack(); // Annuler si quelque chose échoue
            throw $th; // Renvoyer l'erreur


        }
    }

    public function insertMouvementPersonneDemissionEmployer($id_emp)
    {
        DB::beginTransaction();
        try {
            //code...
            DB::insert("INSERT INTO mouvement_personnel(id_emp,id_etat,date_mouvement)VALUES(?,9,CURRENT_TIMESTAMP)",[$id_emp]);
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
              //throw $th;
              DB::rollBack(); // Annuler si quelque chose échoue
              throw $th; // Renvoyer l'erreur
        }
    }

    public function getAllMouvementPersonnel()
    {
        $result = DB::select("SELECT * FROM v_mouvememt_personnel");

        return $result;
    }

    public function insertPromouvoirPersonnel($id_pers1,$id_pers2,$id_stand)
    {
        DB::beginTransaction();
        try {
            //code...
            DB::insert("INSERT INTO promouvoir_personnel(id_personne_enlever_fonction,id_personne_promu,id_stand,date_promouvoir) VALUES(?,?,?,CURRENT_TIMESTAMP)",
            [$id_pers1,$id_pers2,$id_stand]);
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack(); // Annuler si quelque chose échoue
            throw $th; // Renvoyer l'erreur
        }
    }


    public function searchEmp($prenom_emp)
{
    DB::beginTransaction();
    try {
        // Effectuer la recherche avec un modèle
        $result = DB::select("
            SELECT *
            FROM emp
            JOIN etat ON etat.id_etat = emp.id_etat
            WHERE emp.prenom_emp ILIKE ?
        ", ["$prenom_emp%"]);

        DB::commit();

        return $result; // Retourner les résultats de la recherche
    } catch (\Throwable $th) {
        DB::rollBack(); // Annuler si une erreur se produit
        throw $th; // Propager l'exception
    }
}

}
