<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
class StandModel extends Model
{
    use HasFactory;

    public function getAllStandPermission()
    {
        return DB::select("SELECT * FROM v_permission_stand");
    }

    // public function getAllViewPermissionStand()
    // {
    //     return DB::select(" SELECT * FROM v_permission_stand");
    // }

    public function getAllViewPermissionStand()
    {
        // Récupérer les données
        $results = DB::select("SELECT * from v_permission_stand");
        return $results;
    }

        //function qui vas creer une permission de stand(Dans l'affichage client)
        public function insertPermissionStand($nom_stand,$id_categorie,$nom_categorie_stand,$description_stand,
        $nom_employe,$prenom_employe,$date_naissace,$email_employe,$img_permission_stand,$date_debut,$date_fin)
        {
            DB::beginTransaction();
            try
            {
                DB::insert('INSERT INTO permission_stand(nom_stand,id_categorie,nom_categorie_stand,description_stand,
                nom_emp,prenom_emp,date_naissance,email,img_stand,id_etat,date_debut_stand,date_fin_stand)VALUES(?,?,?,?,?,?,?,?,?,1,?,?)',[$nom_stand,$id_categorie,$nom_categorie_stand,
                $description_stand,$nom_employe,$prenom_employe,$date_naissace,$email_employe,$img_permission_stand,$date_debut,$date_fin]);
                DB::commit();



            } catch (\Exception $e) {
                DB::rollBack(); // Annuler si quelque chose échoue
                throw $e; // Renvoyer l'erreur
            }
        }



        public function validationPermissionStand($id_permission_Stand,$nom_stand,$id_categorie,
            $description_stand,$nom_emp,$prenom_emp,$date_naissance,$email,$img_permission_stand,$nom_categorie_stand,$date_debut,$date_fin)
        {
            DB::beginTransaction();
            try
            {
                DB::insert("INSERT INTO stand(id_categorie,nom_stand,description_stand,img_stand,id_etat,date_de_creation_stand,nom_categorie_stand,date_debut_stand,date_fin_stand)VALUES
                (?,?,?,?,4,CURRENT_TIMESTAMP,?,?,?)",[$id_categorie,$nom_stand,$description_stand,$img_permission_stand,$nom_categorie_stand,$date_debut,$date_fin]);

                DB::insert("INSERT INTO emp(nom_emp, prenom_emp, date_naissance, email, id_etat, date_membre)VALUES
                (?,?,?,?,7,CURRENT_TIMESTAMP)",[$nom_emp,$prenom_emp,$date_naissance,$email]);

                DB::update("UPDATE permission_stand set id_etat = 4 where id_permission_stand=?",[$id_permission_Stand]);

                DB::commit();
            } catch (\Throwable $e) {
                //throw $th;
                DB::rollBack(); // Annuler si quelque chose échoue
                throw $e; // Renvoyer l'erreur
            }
        }

        public function insertStand($id_categorie,$nom_stand,$description_stand,$img_stand,$nom_categorie_stand)
        {
            DB::beginTransaction();
            try
            {
                DB::insert("INSERT INTO stand(id_categorie,nom_stand,description_stand,img_stand,id_etat,date_de_creation_stand,nom_categorie_stand)VALUES
                (?,?,?,?,4,CURRENT_TIMESTAMP,?)",[$id_categorie,$nom_stand,$description_stand,$img_stand,$nom_categorie_stand]);

                // Retrieve the last inserted id_stand
                $lastInsertId = DB::getPdo()->lastInsertId();

                DB::commit();

                return $lastInsertId;

            } catch (\Throwable $th) {
                //throw $th;
                DB::rollBack(); // Annuler si quelque chose échoue
                throw $e; // Renvoyer l'erreur
            }
        }

        public function membreStand()
        {
            $getStand = DB::select("SELECT MAX(ID_STAND) AS id_stand FROM STAND");
            $getemp = DB::select("SELECT MAX(id_emp) AS id_emp FROM EMP");

            $getId_stand = $getStand[0]->id_stand;
            $getId_directeur = $getemp[0]->id_emp;

            $result = DB::insert("INSERT INTO membre_Stand(id_stand,id_directeur,id_emp)VALUES(?,?,null)",[$getId_stand,$getId_directeur]);
            db::commit();
            return $result;
        }

        public function getMembreStand()
        {
            $result = DB::select("SELECT * FROM membre_stand ");
        }


        //function utiliser a recrutement emp et poster projet espace directeur
        public function getViewMembreStandById($id_directeur)
        {
            $result = DB::select("SELECT distinct(id_stand),nom_stand,id_directeur,description_stand,img_stand,id_etat,nom_directeur,prenom_directeur from v_membre_stand where id_directeur = ? and id_etat !=11 ",[$id_directeur]);
            return $result;
        }



        //fonction utiliser postter projet pour l'espace emp
        public function getViewMembreStandByIdEmp($id_emp)
        {
            $result = DB::select("SELECT distinct(id_stand),nom_stand,id_directeur,description_stand,img_stand,id_etat,nom_directeur,prenom_directeur from v_membre_stand where id_emp = ?",[$id_emp]);
            return $result;
        }



        public function membreStandEmpExiste($id_stand , $id_directeur)
        {
            DB::beginTransaction();
            try
            {
                DB::insert("INSERT INTO membre_stand(id_stand,id_directeur,id_emp)VALUES(?,?,null)",[$id_stand,$id_directeur]);
                db::commit();
            } catch (\Throwable $th) {
                //throw $th;
                DB::rollBack(); // Annuler si quelque chose échoue
                throw $e; // Renvoyer l'erreur
            }
        }

        public function acceptStandExsist($id_stand)
        {
            DB::beginTransaction();
            try {
                //code...
                DB::update("UPDATE permission_stand set id_etat = 4 WHERE id_permission_stand = ?",[$id_stand]);
                DB::commit();
            } catch (\Throwable $th) {
                //throw $th;
                DB::rollBack(); // Annuler si quelque chose échoue
                throw $th; // Renvoyer l'erreur
            }
        }

        public function refuseStand($id_permission_Stand)
        {
            DB::beginTransaction();
            try
            {
                DB::update("UPDATE permission_Stand set id_etat = 5 where id_permission_Stand = ?",[$id_permission_Stand]);
                DB::commit();
            } catch (\Throwable $th) {
                //throw $th;
                //throw $th;
                DB::rollBack(); // Annuler si quelque chose échoue
                throw $e; // Renvoyer l'erreur
            }
        }




    //functionn  qui select les stand des employer en fonction de son id [ID directeur]
    //ilay ampiasana am ilay resaka publier publier
    public function getAllStandEmpByIdEmp($id_directeur)
    {
        $result = db::select("SELECT distinct(id_stand),date_de_creation_stand,nom_stand,id_directeur,description_stand,img_stand,id_etat,nom_directeur,prenom_directeur from v_membre_stand where id_directeur = ? and id_etat IN(3,4)",[$id_directeur]);
        return $result;
    }


    public function getAllStandEmpByIdEmpV1(array $id_directeur)
    {
        return DB::table('v_membre_stand')
        ->select(
            DB::raw('DISTINCT(id_stand) AS id_stand'),
            'date_de_creation_stand',
            'nom_stand',
            'id_directeur',
            'description_stand',
            'img_stand',
            'id_etat',
            'nom_directeur',
            'prenom_directeur'
        )
        ->whereIn('id_etat', [3, 4]) // Clause IN pour `id_etat`
        ->where('id_directeur', $id_directeur) // Condition pour `id_directeur`
        ->get();
    }



    //function qui select les stand am resaka publier publier any am cote employer[ID EMPLOYER]
    public function getAllStandEmpById($id_emp)
    {
        $result = db::select("SELECT distinct(id_stand),nom_stand,id_directeur,description_stand,img_stand,id_etat,nom_directeur,prenom_directeur from v_membre_stand where id_emp = ?",[$id_emp]);
        return $result;
    }

    public function viewModifierByEmp($id_stand)
    {
        $result = db::select("SELECT * FROM stand WHERE id_stand = ?",[$id_stand]);
        return $result;
    }

    //list de membre de stand
    public function getAllMembreStand()
    {
        $result = DB::select("SELECT * FROM v_membre_stand order by id_stand asc");

        return $result;
    }

    //list membre stand avec etat dynamique
    public function getAllMmembreStandV1()
    {
        $result = DB::select("SELECT * FROM v_membre_stand_v1 order by id_stand asc");
        return $result;
    }

    //list de view membre stand v1 par id directeutr =>pour avoir la date d'entrer dans le stand
    public function getAllDateEntrerStandEmpByIdDirecteur($id_directeur)
    {
        $result = DB::select("SELECT * FROM v_membre_stand_v1 where id_directeur = ? and id_etat_personne !=8 order by date_membre desc",[$id_directeur]);
        return $result;
    }

    public function getViewMembreStandV1ByIidStand($id_stand)
    {
        $result = DB::select("SELECT * FROM v_membre_stand_v1 WHERE id_stand = ?",[$id_stand]);
        return $result;
    }


    //valider et publier un stand
    //---UPDATE ETAT------
    public function publierStand($id_stand)
    {
        $result = DB::update("UPDATE stand set id_etat = 3 where id_stand = ?",[$id_stand]);
        return $result;
    }

    //liste des stand success
    public function getAllStandSuccess()
    {
        $result = DB::select("SELECT * FROM stand where id_etat = 3 group by id_stand order by date_de_creation_stand desc");
        return $result;
    }



    //list des stand success by id_directeur
    public function getAllStandSuccessByDirecteur($id_directeur)
    {
        $result = DB::select("SELECT distinct(id_stand),id_directeur,nom_stand,description_Stand,
                                img_stand,id_etat,nom_directeur,prenom_directeur,date_de_creation_stand
                                FROM  v_membre_Stand where id_etat in(3,4) and id_directeur = ?
                                order by date_de_creation_stand desc",[$id_directeur]);

        return $result;
    }


    //list des stand success by id_emp
    public function getAllStandSuccessByEmp($id_emp)
    {
        $result = DB::select("SELECT distinct(id_stand),id_emp,nom_stand,description_Stand,
                                img_stand,id_etat,nom_directeur,prenom_directeur,date_de_creation_stand
                                FROM  v_membre_Stand where id_etat in(3,4) and id_emp = ?
                                order by date_de_creation_stand desc",[$id_emp]);
        return $result;
    }




    //liste des stand en global
    public function getGlobalStand()
    {
        $result = DB::select("SELECT * FROM stand");
        return $result;
    }


    public function viewGetGlobalStand()
    {
        $result = DB::select("SELECT * FROM stand join etat on etat.id_etat = stand.id_etat");
        return $result;
    }



    //modification de stand
    public function modifierStand($id_categorie,$nom_stand,$description_stand,$img_stand,$id_stand,$nom_categorie_stand)
    {
        DB::beginTransaction();
        try
        {
            $result = DB::update("UPDATE stand set id_categorie = ?,nom_stand = ? ,
            description_stand = ? , img_stand = ? ,nom_categorie_stand = ?  where id_stand = ?",[$id_categorie,$nom_stand,$description_stand,$img_stand,$nom_categorie_stand,$id_stand]);
            DB::commit();
        } catch (\Throwable $e) {
            //throw $th;
            DB::rollBack(); // Annuler si quelque chose échoue
            throw $e; // Renvoyer l'erreur
        }

    }

    //liste de type de stand
    //=>utilise dans le formulaire admin
    public function getAllTypeStand()
    {
        $result = DB::select("SELECT * FROM type_stand");
        return $result;
    }


    //insertion du contenue de stand [PHOTO]
    public function insertContenueStand($id_stand,$id_type_stand,$nom_info_type_stand,
    $description_info_type_stand,$img_info_type_stand)
    {
        DB::beginTransaction();
        try
        {
            DB::insert("INSERT INTO info_type_stand(id_stand,id_type_stand,date_creation)
            VALUES(?,?,CURRENT_TIMESTAMP)",[$id_stand,$id_type_stand]);

            $getMaxId_info_Stand = DB::select("SELECT MAX(id_info_type_stand) as id_info_type_stand
            FROM info_type_stand");

            $id_max_info_stand = $getMaxId_info_Stand[0]->id_info_type_stand;

            DB::insert("INSERT INTO info_type_stand_desc(id_info_type_stand,nom_info_type_stand,description_info_type_stand,img_info_type_stand,date_creation)
            VALUES(?,?,?,?,CURRENT_TIMESTAMP)",[$id_max_info_stand,$nom_info_type_stand,
            $description_info_type_stand,json_encode($img_info_type_stand)]);

            DB::commit();

        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function updateContenueStand($id_info_type_stand,$id_info_type_stand_desc, $id_type_stand, $nom_info_type_stand, $description_info_type_stand, $img_info_type_stand)
    {
        DB::beginTransaction();
        try {
            // Update the `info_type_stand` table
            DB::update("UPDATE info_type_stand
                        SET id_type_stand = ?, date_creation = CURRENT_TIMESTAMP
                        WHERE id_info_type_stand = ?", [$id_type_stand, $id_info_type_stand]);

            // Update the `info_type_stand_desc` table
            DB::update("UPDATE info_type_stand_desc
                        SET  id_info_type_stand = ? ,nom_info_type_stand = ?, description_info_type_stand = ?, img_info_type_stand = ?, date_creation = CURRENT_TIMESTAMP
                        WHERE id_info_type_stand_desc = ?",
                        [$id_info_type_stand,$nom_info_type_stand, $description_info_type_stand, json_encode($img_info_type_stand), $id_info_type_stand_desc]);

            DB::commit();
            return true;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function getAllInfoTypeStandCalendar(array $stand_ids)
    {
        return DB::table('info_type_stand')
            ->whereIn('id_stand', $stand_ids)
            ->get();
    }

    //liste de contenue de stand(poster et projet)
    public function viewInfoTypeStandByIdStand($id_stand)
    {
        $result = db::select("SELECT * FROM V_info_type_stand_desc where id_stand = ? order by id_info_type_stand_desc  desc",[$id_stand]);

        return $result;
    }

    public function getViewMembreStandByIdArray(array $id_stand)
    {
        // v_membre_stand_v1
        return DB::table('v_membre_stand_v1')
            ->whereIn('id_stand',$id_stand)
            ->get();
    }

    public function viewInfoTypeStandByIdStandCalendar(array $stand_ids)
    {
        return DB::table('v_info_type_stand_desc')
            ->whereIn('id_stand', $stand_ids)
            ->get();
    }

    public function viewInfoTypeStand()
    {
        $result = DB::select("SELECT * FROM V_info_type_stand_desc");
        return $result;
    }

    public function insertVideoContenue($id_stand,$description_video,$titre_video,$file_video)
    {
        DB::beginTransaction();
        try {
            //code...
            DB::insert("INSERT INTO video_contenue(id_stand,description_video,titre_video,file_video,date_creation_video)VALUES(?,?,?,?,CURRENT_TIMESTAMP)",
           [$id_stand,$description_video,$titre_video,$file_video]);
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            throw $th;
        }
    }

    //select contenue video
    public function getAllContenueVideo($id_stand)
    {
        $result = DB::select("SELECT * FROM video_contenue WHERE id_stand = ?",[$id_stand]);
        return $result;
    }

    public function getAllVideoContenue()
    {
        $result = DB::select("SELECT * FROM video_contenue");
        return $result;
    }

    public function getAllContenueVideoCalendar(array $stand_ids)
    {
        return DB::table('video_contenue')
            ->whereIn('id_stand', $stand_ids)
            ->get();
    }

    public function modifiyVideo($titre_video,$description_video,$file_video,$id_video_contenue)
    {
        DB::beginTransaction();
        try {
            //code...
            DB::update("UPDATE video_contenue set titre_video = ?,description_video = ?,file_video = ? WHERE id_video_contenue = ?",[$titre_video,$description_video,$file_video,$id_video_contenue]);
            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            throw $th;
        }
    }



    //get all brochure
    public function getAllBrochureContenue($id_info_type_stand)
    {
        $result = DB::select("SELECT * FROM brochure_contenue WHERE id_info_type_stand = ?",[$id_info_type_stand]);

        return $result;
    }


    //insert brochure
    public function insertBrochure($id_info_type_stand,$nom_brochure,$fichier)
    {
        DB::beginTransaction();
        try {
            //code...
            DB::insert("INSERT INTO brochure_contenue(id_info_type_stand,nom_brochure_stand,img_brochure,date_ajout_brochure)
            VALUES(?,?,?,CURRENT_TIMESTAMP)",[$id_info_type_stand,$nom_brochure,$fichier]);

            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            throw $th;
        }
    }

    //modification de brochure
    public function modifieBrochure($id_info_type_stand,$nom_brochure,$fichier)
    {

        DB::beginTransaction();
        try {
            //code...
            DB::update("UPDATE brochure_contenue set nom_brochure_stand = ? ,img_brochure = ?,date_ajout_brochure = CURRENT_TIMESTAMP
            where id_info_type_stand = ?",[$nom_brochure,$fichier,$id_info_type_stand]);

            DB::commit();

        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            throw $th;
        }
    }

    //getBrochureBy id_info_type_stand

    public function getFichierPdf($id_info_type_stand)
    {
        $result = DB::select("SELECT * FROM brochure_contenue WHERE id_info_type_stand = ?",[$id_info_type_stand]);

        return $result;
    }

    public function getBrochureCalendar($id_info_type_stand)
    {
        return DB::table('brochure_contenue')
            ->whereIn('id_info_type_stand', $id_info_type_stand)
            ->get();
    }

    // public function downloadPdf($id_info_type_stand)
    // {
    //     DB::beginTransaction();
    //     try {
    //         // Récupérer le fichier PDF lié à l'ID donné
    //         $result = $this->getFichierPdf($id_info_type_stand);

    //         // Vérifier si le résultat n'est pas vide et que le fichier PDF existe
    //         if (!empty($result) && isset($result[0]->img_brochure)) {
    //             $filePath = public_path('assets/pdf/' . $result[0]->img_brochure);

    //             if (file_exists($filePath)) {
    //                 DB::commit();

    //                 // Configurer les en-têtes pour le téléchargement manuel
    //                 header('Content-Description: File Transfer');
    //                 header('Content-Type: application/pdf');
    //                 header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
    //                 header('Expires: 0');
    //                 header('Cache-Control: must-revalidate');
    //                 header('Pragma: public');
    //                 header('Content-Length: ' . filesize($filePath));

    //                 // Lire le fichier et envoyer son contenu au navigateur
    //                 readfile($filePath);
    //                 exit;
    //             } else {
    //                 throw new \Exception("Fichier PDF non trouvé à l'emplacement : " . $filePath);
    //             }
    //         } else {
    //             throw new \Exception("Aucun fichier PDF associé à cet ID");
    //         }
    //     } catch (\Throwable $th) {
    //         DB::rollBack();
    //         return response()->json(['message' => 'Erreur lors du téléchargement : ' . $th->getMessage()], 500);
    //     }
    // }
    public function downloadPdf($id_info_type_stand)
    {
        DB::beginTransaction();
        try {
            // Récupérer le fichier lié à l'ID donné
            $result = $this->getFichierPdf($id_info_type_stand);

            // Vérifier si le résultat n'est pas vide et que le fichier existe
            if (!empty($result) && isset($result[0]->img_brochure)) {
                $filePath = public_path('assets/pdf/' . $result[0]->img_brochure);

                // Vérifier si le fichier existe
                if (file_exists($filePath)) {
                    DB::commit();

                    // Récupérer l'extension du fichier pour définir le type MIME
                    $fileExtension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

                    // Définir le type MIME en fonction de l'extension du fichier
                    if ($fileExtension == 'pdf') {
                        $mimeType = 'application/pdf';
                    } elseif (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'])) {
                        $mimeType = 'image/' . $fileExtension;
                    } else {
                        $mimeType = 'application/octet-stream'; // Type générique pour les autres fichiers
                    }

                    // Définir les en-têtes pour le téléchargement manuel
                    header('Content-Description: File Transfer');
                    header('Content-Type: ' . $mimeType);
                    header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
                    header('Expires: 0');
                    header('Cache-Control: must-revalidate');
                    header('Pragma: public');
                    header('Content-Length: ' . filesize($filePath));

                    // Lire le fichier et envoyer son contenu au navigateur
                    readfile($filePath);
                    exit;
                } else {
                    throw new \Exception("Fichier non trouvé à l'emplacement : " . $filePath);
                }
            } else {
                throw new \Exception("Aucun fichier associé à cet ID");
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['message' => 'Erreur lors du téléchargement : ' . $th->getMessage()], 500);
        }
    }

    public function nombreTotalStand()
    {
        $result = DB::select("SELECT count(id_stand) AS nombre_Stand FROM stand where id_etat = 3");

        return $result;
    }


    public function suppressionStand($id_stand)
    {
        DB::beginTransaction();
        try {
            //code...
            DB::update("UPDATE stand set id_etat = 11 where id_stand = ?",[$id_stand]);

            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
             //throw $th;
             DB::rollBack();
             throw $th;
        }
    }


}

