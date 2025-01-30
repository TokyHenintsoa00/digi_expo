<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminModel;
use App\Models\StandModel;
use App\Models\LocationModel;
use App\Models\ReceptionModel;
use App\Models\Temoignage;
use App\Models\Event;
use App\Models\VideoModel;
use App\Models\DasboardModel;
use App\Models\EmpModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str; // Assurez-vous d'importer Str
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Notification;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function viewAuthentificationAdmin()
    {
        return view('authentification.authentificationAdmin');
    }

    // public function viewAuthentificationAdmin()
    // {
    //     //Get cookie
    //     $adminId = Cookie::get('remember_admin');

    //     if ($adminId ==TRUE) {
    //         // Récupérer l'administrateur à partir de l'ID stocké dans le cookie
    //         $admin = DB::table('admin')->where('id', $adminId)->first();
    //         if($admin !==null)
    //         {
    //                 // Regénérer la session et stocker l'id_admin
    //             $request->session()->regenerate();
    //             Session::put('id', $admin->id); // Stocker l'id_admin dans la session

    //             // Redirection vers la page admin
    //             return redirect()->route('viewAdminPage');
    //         }
    //     }

    //     return view('authentification.authentificationAdmin');
    // }

    public function getSignOutAdmin(Request $request)
    {
        // Supprimer toutes les sessions
        Session::flush();

        // Regénérer la session pour éviter les attaques par fixation de session
        $request->session()->regenerate();

        // Supprimer le cookie 'remember_admin'
        Cookie::queue(Cookie::forget('remember_admin'));



        // Redirection vers la page de connexion ou une autre page souhaitée
        return redirect()->route('viewAuthentificationAdmin');

    }

    public function logout()
    {
        try {
            $accessToken = Session::get('facebook_token');

            if (!$accessToken) {
                throw new \Exception('Aucun jeton Facebook trouvé.');
            }

            // Requête pour révoquer les permissions de l'application
            $response = Http::delete("https://graph.facebook.com/me/permissions", [
                'access_token' => $accessToken
            ]);

            if ($response->successful()) {
                // Supprimer les sessions et rediriger
                Session::forget('facebook_token');
                Session::forget('admin');
                return redirect()->route('login')->with('success', 'Déconnecté de Facebook.');
            } else {
                throw new \Exception('Erreur lors de la déconnexion.');
            }

        } catch (\Exception $e) {
            return redirect()->route('viewAdminPage')->with('error', $e->getMessage());
        }
    }


    public function getSignInAdmin(Request $request)
    {
        $email = $request->email;
        $pwd = $request->pwd;
        $remember = $request->has('remember');

        $getSignInAdmin = new AdminModel();
        $result = $getSignInAdmin->signInAdminByFormulaire($email,$pwd,$remember);
        $verify = $getSignInAdmin->getAuthAdminFirst($email);

        if ($verify == null)
        {
            # code...
            return redirect()->back()->withErrors(['error' => 'Invalide verifier votre email ou votre mots de passe'])->withInput();
        }

        if ($result != null) {
            $request->session()->regenerate();
            // Stocker l'id_admin dans la session
            Session::put('id', $result->id);
            return redirect()->route('viewCreationSalonAdmin'); // Redirection vers la page admin
        } else {
            return redirect()->back()->withErrors(['error' => 'Invalide verifier votre email ou votre mots de passe'])->withInput();
        }
    }

    public function viewCreationSalonAdmin()
    {
         // Récupérer tous les points existants
         $locations = DB::select("
            SELECT id, name, ST_X(coordinates) AS longitude, ST_Y(coordinates) AS latitude
            FROM locations
        ");
        return view('admin.creationSalonAdmin',['locations' => $locations]);
    }

    public function creationSalon(Request $request)
    {
        $getReceptionModel = new ReceptionModel();


        $nom_salon = $request->nom_salon;
        $nom_organisateur = $request->nom_organisateur;

        // //count de salon
        // $count_salon = $getReceptionModel->countSalon();

        // if ($count_salon >1) {

        //     return redirect()->back()->withErrors(['error' => 'Vous ne pouvez plus creer un autre salon'])->withInput();

        // } else {
        //     # code...
        // }


        //insert salon
        $getReceptionModel->insertSalon($nom_salon);

        //insert organisateur
        $getReceptionModel->insertOrganisateur($nom_organisateur);


        //insert contact
        $getId_organisateur = $getReceptionModel->getOrganisateur($nom_organisateur);
        $id_organisateur = $getId_organisateur[0]->id_organisateur;
        $contacts = $request->contact;

        if (is_array($contacts)) {
            foreach ($contacts as $key => $contactData) {
                $nomcontact = $contactData['nom'];  // Access individual contact's 'nom' field
                $contact = $contactData['contact']; // Access individual contact's 'contact' field
                // Process contact information (e.g., validation, storage)
                // echo "Contact Name: $nomcontact, Contact Info: $contact<br>"; // Example output
                $getReceptionModel->insertContact($id_organisateur,$nomcontact,$contact);
            }
        return redirect()->route('viewCreationSalonAdmin')->with('success', 'Permission valider et mail envoyer a cette personne');

        } else {
            // Handle the case where $contacts is not an array (e.g., error message)
            echo "Error: Contact information not provided in the expected format.";
        }

    }

    public function creationSalonV1(Request $request)
    {
        $getReceptionModel = new ReceptionModel();


        $nom_salon = $request->nom_salon;
        $nom_organisateur = $request->nom_organisateur;
        //NOM DU LIEU
        $name = $request->name;
        $longitude = $request->longitude;
        $latitude = $request->latitude;

        $date_debut = $request->date_debut;
        $date_fin = $request->date_fin;
        // dd($name,$longitude,$latitude);

        $getCountSalon = $getReceptionModel->countSalon();
        $countSalon = $getCountSalon[0]->count;

        if($countSalon >=1)
        {
            return redirect()->back()->withErrors(['error' => 'Vous ne pouvez plus creer un autre salon'])->withInput();
        }

        //insert salon
        $getReceptionModel->insertSalon($nom_salon,$date_debut,$date_fin);

        //insert organisateur
        $getReceptionModel->insertOrganisateur($nom_organisateur);


        //insert contact
        $getId_organisateur = $getReceptionModel->getOrganisateur($nom_organisateur);
        $id_organisateur = $getId_organisateur[0]->id_organisateur;
        $contacts = $request->contact;

        if (is_array($contacts)) {
            foreach ($contacts as $key => $contactData) {
                $nomcontact = $contactData['nom'];  // Access individual contact's 'nom' field
                $contact = $contactData['contact']; // Access individual contact's 'contact' field
                // Process contact information (e.g., validation, storage)
                // echo "Contact Name: $nomcontact, Contact Info: $contact<br>"; // Example output
                $getReceptionModel->insertContact($id_organisateur,$nomcontact,$contact);
            }

        $locationModel = new LocationModel();
        $location = $locationModel->insertLocation($name,$longitude,$latitude);

        return redirect()->route('viewCreationSalonAdmin')->with('success', 'Creation de salon effectuée avec succes');

        } else {
            // Handle the case where $contacts is not an array (e.g., error message)
            echo "Error: Contact information not provided in the expected format.";
        }

    }


    public function viewAdminPage(Request $request)
    {
        // // Vérifiez d'abord si le cookie est présent
        // $adminId = Cookie::get('remember_admin');

        // if ($adminId ==TRUE) {
        //     // Récupérer l'administrateur à partir de l'ID stocké dans le cookie
        //     $admin = DB::table('admin')->where('id', $adminId)->first();
        //     if ($admin) {
        //         // Regénérer la session et stocker l'id_admin
        //         $request->session()->regenerate();
        //         Session::put('id', $admin->id);

        //         return view('admin.AdminPage'); // Redirigez vers la page admin
        //     }



            return view('admin.AdminPage');
    }



        // // Si aucun cookie n'est trouvé, redirigez vers la page d'authentification
        // return redirect()->route('viewAuthentificationAdmin');

//----------------------------------------POUR MOT DE PASSE OUBLIER--------------------------------------------------------
    public function viewForgotPassword()//[etape_1]
    {
        return view('authentification.forgotPassword'); // Vue pour le formulaire de mot de passe oublié
    }

    public function sendResetLink(Request $request)//[etape_2]
    {
        $request->validate(['email' => 'required|email|exists:admin,email']);
        $token = Str::random(60); // Générer un token

        $email = $request->email;


        $getEmpModel = new EmpModel();
        $getInfoByEmail = $getEmpModel->getInfoByEmail($email);
        $id_personne = $getInfoByEmail[0]->id;

        //dd($id_personne);

        // $getEmpModel = new EmpModel();
        // $getEmailPersonne = $getEmpModel->getEmpById($id_personne);
        // $email = $getEmailPersonne[0]->email;
        DB::table('password_resets')->insert([
            'email' =>$email,
            'token' => $token,
            'created_at' => now(),
            'id_emp' =>$id_personne
        ]);

        // // Envoyer l'e-mail via Brevo
        Mail::send('emails.passwordReset', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email)
                    ->subject('Réinitialisation de votre mot de passe');
        });

        return back()->with('status', 'Lien de réinitialisation envoyé à votre adresse e-mail.');
    }

    public function viewResetPassword($token)//[etape_3]
    {
        return view('authentification.resetPassword', ['token' => $token]); // Vue pour réinitialiser le mot de passe
    }

    public function resetPassword(Request $request)//[etape_4]
    {
        $request->validate([
            'password' => 'required|confirmed|min:8',
            'token' => 'required'
        ]);

        // Vérification du token
        $reset = DB::table('password_resets')->where('token', $request->token)->first();



        $id_emp = $reset->id_emp;
        //dd($reset,$id_emp);

        // if (!$reset || $reset->email !== $request->email) {
        //     return back()->withErrors(['email' => 'Le lien de réinitialisation est invalide.']);
        // }

        // Réinitialiser le mot de passe
        $admin = AdminModel::where('id', $id_emp)->first();
        $admin->pwd_admin = bcrypt($request->password);
        $admin->save();

        // // Supprimer le token
        DB::table('password_resets')->where('id_emp', $id_emp)->delete();

        return redirect()->route('viewAuthentificationAdmin')->with('status', 'Votre mot de passe a été réinitialisé avec succès.');
    }
//-------------------------------------------------------------------------------


    public function viewValidationPermissionStand()
    {
        $permissionStand = new StandModel();
        $permission = $permissionStand->getAllViewPermissionStand();
        //   dd($permission); // Pour inspecter les données avant affichage
        return view('admin.validationPermissionStand',compact('permission'));
    }


        //fonction en cas de validation de l'admin
        public function validePermissionByAdmin(Request $request)
        {
            //--------------request categorie
            $id_categorie = $request->id_categorie;
            $nom_categorie_stand = $request->nom_categorie_stand;
            //----------------request id permission stand
            $id_permission_stand = $request->id_permission_stand;
            //----------request de stand---------------
            $nom_stand = $request->nom_stand;
            $description_stand = $request->description_stand;
            $img_stand = $request->image_stand;
            $date_debut_stand = $request->date_debut_stand;
            $date_fin_stand = $request->date_fin_stand;
            //-----------request de emp------------------------------------
            $nom_emp = $request->nom_emp;
            $prenom_emp = $request->prenom_emp;
            $email = $request->email;
            $date_naissance = $request->date_naissance;
            //-------------------------------------------------------------
            $getStandModel = new StandModel();
            $getEmpModel = new EmpModel();
            $getAllEmp = $getEmpModel->getAllEmpById($nom_emp,$prenom_emp,$email);

            if($getAllEmp ==null)
            {
                $validate = $getStandModel->validationPermissionStand($id_permission_stand,$nom_stand,$id_categorie,
                $description_stand, $nom_emp,$prenom_emp,$date_naissance,$email,$img_stand,$nom_categorie_stand,$date_debut_stand,$date_fin_stand);
                //appele de la fonction getallemp pour geter le pmatricule de emp
                $getAllEmp = $getEmpModel->getAllEmpById($nom_emp,$prenom_emp,$email);
                //appelle de la fonction insert membre stand
                $membre_stand = $getStandModel->membreStand();

                $matricule_emp =$getAllEmp[0]->matricule_emp;
                // Envoi de l'email avec une vue Blade
                Mail::send('emails.sentMailAcceptStand', [
                'nom_emp' => $nom_emp,
                'prenom_emp' => $prenom_emp,
                'nom_stand' => $nom_stand,
                'description_stand' => $description_stand,
                'matricule_emp' =>$matricule_emp
                ], function ($message) use ($email, $nom_emp, $prenom_emp,$matricule_emp) {
                $message->to($email)
                        ->subject('Validation de votre exposition');
                });

                return redirect()->route('viewValidationPermissionStand')->with('success', 'Permission valider et mail envoyer a cette personne');
            }
            else
            {

                $lastInsertId = $getStandModel->insertStand($id_categorie,$nom_stand,$description_stand,$img_stand,$nom_categorie_stand);
                // $session_emp = Session::get('id_emp');
                $session_emp = $getAllEmp[0]->id_emp;
                $getStandModel->membreStandEmpExiste($lastInsertId,$session_emp);
                $getStandModel->acceptStandExsist($id_permission_stand);
                Mail::send('emails.sentMailAcceptNewStand',[
                        'prenom_emp' =>$prenom_emp
                    ],function($message) use($email,$prenom_emp){
                        $message->to($email)
                                ->subject('Validation de nouveau stand');
                });

                return redirect()->route('viewValidationPermissionStand')->with('success', 'Permission valider et mail envoyer a cette personne');

            }

        }





    //function en cas de refus
    public function refusePermissiontandByAdmin(Request $request)
    {
        $id_permission_stand = $request->id_permission_stand;
        $prenom_emp = $request->prenom_emp;
        $email = $request->email;
        $getRefusePermission = new StandModel();
        $getRefusePermission->refuseStand($id_permission_stand);
        $error = 'Mail envoyer pour la refus de permission';

        //enmvoi de refus de stand par mail
        Mail::send('emails.sentMailRefuseStand',[
            'email' =>$email,
            'prenom_emp' => $prenom_emp
        ],function($message)use($prenom_emp,$email){
            $message->to($email)
                    ->subject('Refus de permission de stand');
        });

        return redirect()->back()->withErrors(['error' => $error])->withInput();

    }

    //view list recrutement
    public function viewValidationRecrutementEmp()
    {
        $getEmpModel = new EmpModel();
        $recrutement = $getEmpModel->getAllPermissionRecrutementEmp();
        return view('admin.validationPermissionRecrutementEmployer',compact('recrutement'));
    }


    //FONCTION en cas de validation de recrutement
    public function validationRecrutement(Request $request)
    {
        $nom_emp = $request->nom_emp;
        $prenom_emp = $request->prenom_emp;
        $date_naissance = $request->date_naissance;
        $email = $request->email;
        $id_stand = $request->id_stand;
        $id_permission_recrutement_emp = $request->id_permission_recrutement_emp;
        $id_expediteur = $request->id_expediteur;
        $nom_stand = $request->nom_stand;

        $getEmpModel = new EmpModel();
        $getEmpModel->validePermissionRecrutement($nom_emp,$prenom_emp,$date_naissance,$email,$id_stand,$id_permission_recrutement_emp,$id_expediteur);
        $maxEmpId = $getEmpModel->MaxIdEmp();
        $id_emp = $maxEmpId[0]->id_emp;
        $emp = $getEmpModel->getEmpById($id_emp);
        $matricule_emp = $emp[0]->matricule_emp;

        //------pour avoir le nom et prenom du directeir

        $getInfoDirecteur = $getEmpModel->getEmpById($id_expediteur);
        $prenom_directeur = $getInfoDirecteur[0]->prenom_emp;

        //-----------------------------------------------------------------------------------------

         // Créer une notification pour le directeur
        Notification::create([
            'user_id' => $id_expediteur,
            'title' => 'Validation de recrutement acceptée',
            'message' => 'Votre recrutement a été validé. Cliquez ici pour plus de détails.',
            'link' => route('viewListEmpAndNombreEmpParStand')
        ]);

        Mail::send('emails.sentMailAcceptRecrutement',[
            'prenom_emp' => $prenom_emp,
            'prenom_directeur' => $prenom_directeur,
            'nom_stand' => $nom_stand,
            'matricule_emp' => $matricule_emp
        ],function($message) use($email,$prenom_emp,$prenom_directeur,$nom_stand,$matricule_emp){
            $message->to($email)
                    ->subject('Validation de recrutement par l administrateur');
        });



        return redirect()->route('viewValidationRecrutementEmp')->with('success', 'Permission recrutement valider');
    }

    //fonction en cas de refus de recrutement
    public function refusDeRecrutement(Request $request)
    {
        $id_permission_recrutement_emp = $request->id_permission_recrutement_emp;
        $id_expediteur = $request->id_expediteur;
        $prenom_emp = $request->prenom_emp;
        //insertion avec etat de refus
        $getEmpModel = new EmpModel();
        $getEmpModel->refusRecrutement($id_permission_recrutement_emp);
        $error = 'Recrutement refuser';

        //creation de notification
        Notification::create([
            'user_id' => $id_expediteur,
            'title' => 'Validation de recrutement refuser',
            'message' => 'Votre recrutement a été refuser.',
            'link' => route('viewListEmpAndNombreEmpParStand')
        ]);

        return redirect()->back()->withErrors(['error' => $error])->withInput();
    }


    //view gestion personnel
    public function viewGestionPersonnelByAdmin()
    {
        return view('admin.gestionPersonneByAdmin');
    }

    // view licensiment des employer
    public function viewLicensimentEmpByAdmin()
    {
        $getEmpModel = new EmpModel();
        $employer = $getEmpModel->getAllEmployer();
        $directeur = $getEmpModel->getAllDirecteur();
        return view('admin.licensimentEmpByAdmin',compact('employer','directeur'));
    }



    //si licensiment directeur
    //le directeur doit etre remplacer si il y a encore de employer
    //sinon on ne peut pas le licensier
    public function viewPromouvoirEmpEnDirecteur(Request $request)
    {
        $id_directeur = $request->id_directeur;
        $id_stand = $request->id_stand;
        $id_membre_stand = $request->id_membre_stand;
        $getEmpModel = new EmpModel();
        // $getEmpByIdDirecteur = $getEmpModel->getAllEmployerByIdDirecteur($id_directeur);
        $getEmpByIdDirecteur = $getEmpModel->getAllEmployerByIdDirecteurAndByIdStand($id_directeur,$id_stand);

        if ($getEmpByIdDirecteur != null)
        {
            return view('admin.promouvoirEmpEnDirecteur',compact('id_directeur','getEmpByIdDirecteur','id_membre_stand','id_stand'));
        }
        else{
            $error = 'Erreur vous ne pouvez pas licensier ce directeur
            car il a pas employer pour le promouvoir.';
            return redirect()->back()->withErrors(['error' => $error])->withInput();

        }
    }


    public function licensimentDirecteurByAdmin(Request $request)
    {
        try
        {
            //code...
            if (isset($request->id_directeur)) {
                $id_directeur = $request->id_directeur;
                $id_emp = $request->id_emp;
                $id_membre_stand = $request->id_membre_stand;
                $id_stand= $request->id_stand;
                $getEmpModel = new EmpModel();
                //$licensier = $getEmpModel->licensimentDirecteur($id_directeur);
                $promouvoir = $getEmpModel->promouvoirEmployerV1($id_emp,$id_directeur,$id_membre_stand);
                // $mouvement_personnel = $getEmpModel->insertMouvementPersonnelLicensimentDirecteur($id_directeur);
                // $verify =
                // return view('admin.gestionPersonneByAdmin');

                $verify = $getEmpModel->verifyStandByIdDirecteur($id_directeur,$id_emp,$id_stand);
                                //return redirect()->route('viewLicensimentEmpByAdmin');
            }
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack(); // Annuler si quelque chose échoue
            throw $th; // Renvoyer l'erreur
        }

    }



    public function licensimentEmployerByAdmin(Request $request)
    {
        $id_emp = $request->id_emp;
        $getEmpModel = new EmpModel();
        $licensier = $getEmpModel->licensiment($id_emp);
        $mvt_personnel = $getEmpModel->insertMouvementPersonnelLicensimentEmp($id_emp);
        return redirect()->route('viewLicensimentEmpByAdmin');
    }

    public function viewListStandAndEmpAndNombreStand()
    {
        $getStandModel = new StandModel();
        $nombre_stand = $getStandModel->nombreTotalStand();

        $getEmpModel = new EmpModel();
        $infoEmp = $getEmpModel->getAllInfoEmpByAdmin();

        return view('admin.allList',compact('infoEmp','nombre_stand'));
    }

    public function viewInfoStand()
    {
        $getStandModel = new StandModel();
        $stand = $getStandModel->getAllStandSuccess();

        return view('admin.informationDeStand',compact('stand'));
    }

    public function viewListMembreStand()
    {
        $getStandModel = new StandModel();
        $membre_stand = $getStandModel->getAllMmembreStandV1();
        return view('admin.listMembreStand',compact('membre_stand'));
    }

    public function viewCalendrierSuiviAdmin()
    {
        $getEventModel = new Event();
        $getStandModel = new StandModel();
        $getEmpModel = new EmpModel();
        $getVideoModel = new VideoModel();
        // $getAllStand = $getStandModel->getGlobal();
        $events = $getEventModel->getAllEventByAdmin();
        $globalStand = $getStandModel->viewGetGlobalStand();
        $allEmp = $getEmpModel->getAllEmployer();
        $getMouvementPersonnel = $getEmpModel->getAllMouvementPersonnel();
        $contenue_photo = $getStandModel->viewInfoTypeStand();
        $contenue_video = $getStandModel->getAllVideoContenue();
        $video_conference = $getVideoModel->viewVideoConference();

        $getAllDirecteur = $getEmpModel->getAllDirecteur();

        $id_directeur = collect($getAllDirecteur)->pluck('id_directeur')->toArray();

        $stand_directeur = $getStandModel->getAllStandEmpByIdEmpV1($id_directeur);
        $stand_ids = collect($stand_directeur)->pluck('id_stand')->toArray();

        $contenue_info = $getStandModel->getAllInfoTypeStandCalendar($stand_ids);
        $id_info_type_stand = collect($contenue_info)->pluck('id_info_type_stand')->toArray();
        $contenue_brochure = $getStandModel->getBrochureCalendar($id_info_type_stand);


        return view('admin.viewCalendrierSuiviAdmin',compact('events','globalStand','allEmp',
        'getMouvementPersonnel','contenue_photo','contenue_video','video_conference','contenue_brochure'));
    }



    // public function dasboardAdmin()
    // {
    //     $getDashBoardModel = new DasboardModel();

    //     $standByDay = $getDashBoardModel->nombreStandByDay();
    //     $standByMonth = $getDashBoardModel->nombreStandByMonth();
    //     $standByYear = $getDashBoardModel->nombreStandByYear();

    //      // Transformer les données en format utilisable dans les graphiques
    //     $standData = [
    //         'day' => $standByDay->pluck('nombre_stands')->toArray(),
    //         'month' => $standByMonth->pluck('nombre_stands')->toArray(),
    //         'year' => $standByYear->pluck('nombre_stands')->toArray(),
    //     ];

    //     $categories = [
    //         'day' => $standByDay->pluck('nom_jour')->toArray(),
    //         'month' => $standByMonth->pluck('nom_mois')->toArray(),
    //         'year' => $standByYear->pluck('annee')->toArray(),
    //     ];

    //     //---------------------------------------------------------------------
    //     $empByDay = $getDashBoardModel->nombreEmpByDay();
    //     $empByMonth = $getDashBoardModel->nombreEmpByMonth();
    //     $empByYear = $getDashBoardModel->nombreEmpByYear();

    //     $empData = [
    //         'day' =>$empByDay->pluck('nombre_de_personnel')->toArray(),
    //         'month' =>$empByMonth->pluck('nombre_de_personnel')->toArray(),
    //         'year' =>$empByYear->pluck('nombre_de_personnel')->toArray(),
    //     ];

    //     $categoriesEmp = [
    //         'day' => $empByDay->pluck('nom_jour')->toArray(),
    //         'month' => $empByMonth->pluck('nom_mois')->toArray(),
    //         'year' => $empByYear->pluck('annee')->toArray(),
    //     ];
    //     //----------------------------------------------------------------------
    //     $mouvementByDay = $getDashBoardModel->mouvementPersonnelByDay();
    //     $mouvementByMonth = $getDashBoardModel->mouvementPersonnelByMonth();
    //     $mouvementByYear = $getDashBoardModel->mouvementPersonnelByYear();



    //     $mouvementData = [
    //         'day' =>$mouvementByDay->pluck('nombre_mouvement')->toArray(),
    //         'month' =>$mouvementByMonth->pluck('nombre_mouvement')->toArray(),
    //         'year' =>$mouvementByYear->pluck('nombre_mouvement')->toArray(),
    //     ];

    //     $categoriesMouvement = [
    //         'day' => $mouvementByDay->pluck('nom_jour')->toArray(),
    //         'month' => $mouvementByMonth->pluck('nom_mois')->toArray(),
    //         'year' => $mouvementByYear->pluck('annee')->toArray(),
    //     ];

    //     $categoriesUnified = [
    //         'day' => array_map(function ($day, $mouvementDay) {
    //             return "{$day} / {$mouvementDay}";
    //         }, $categoriesEmp['day'], $categoriesMouvement['day']),

    //         'month' => array_map(function ($month, $mouvementMonth) {
    //             return "{$month} / {$mouvementMonth}";
    //         }, $categoriesEmp['month'], $categoriesMouvement['month']),

    //         'year' => array_map(function ($year, $mouvementYear) {
    //             return "{$year} / {$mouvementYear}";
    //         }, $categoriesEmp['year'], $categoriesMouvement['year']),
    //     ];



    //     $contenuePhotoByDay = $getDashBoardModel->nombreContenuePhotoByDay();
    //     $contenuePhotoByMonth = $getDashBoardModel->nombreContenuePhotoByMonth();
    //     $contenuePhotoByYear = $getDashBoardModel->nombreContenuePhotoByYear();

    //     $contenueVideoByDay = $getDashBoardModel->nombreContenueVideoByDay();
    //     $contenueVideoByMonth = $getDashBoardModel->nombreContenueVideoByMonth();
    //     $contenueVideoByYear = $getDashBoardModel->nombreContenueVideoByYear();


    //     return view('admin.dashboardAdmin',compact('standData','categories','empData','categoriesEmp','mouvementData',
    //     'categoriesMouvement','categoriesUnified'));

    // }


    // public function getDataByYear(Request $request)
    // {
    //     $year = $request->input('year');
    //     $standData = DB::table('v_nombre_stand_by_month')
    //         ->where('annee', $year)
    //         ->get();

    //     return response()->json($standData);
    // }
    public function dasboardAdmin()
    {
        $getDashBoardModel = new DasboardModel();
        $getVideoModel = new VideoModel();
        $getTemoignageModel = new Temoignage();


        $temoignage = $getTemoignageModel->countTemoignage();
        $video = $getVideoModel->countVideoConference();

        $countTemoignage = $temoignage[0]->nbr_temoignage;
        $countVideo = $video[0]->nbr_video;


        $standByDay = $getDashBoardModel->nombreStandByDay();
        $standByMonth = $getDashBoardModel->nombreStandByMonth();
        $standByYear = $getDashBoardModel->nombreStandByYear();

        $standData = [
            'day' => $standByDay->pluck('nombre_stands')->toArray(),
            'month' => $standByMonth->pluck('nombre_stands')->toArray(),
            'year' => $standByYear->pluck('nombre_stands')->toArray(),
        ];

        $categories = [
            'day' => $standByDay->pluck('nom_jour')->toArray(),
            'month' => $standByMonth->pluck('nom_mois')->toArray(),
            'year' => $standByYear->pluck('annee')->toArray(),
        ];

        return view('admin.dashboardAdmin', compact('standData', 'categories','countTemoignage','countVideo'));
    }

    public function getDataByYear(Request $request)
    {
        $year = $request->input('year');

        // Vérification de la validité de l'année
        if (!$year || !is_numeric($year)) {
            return response()->json([]);
        }

        $standData = DB::table('v_nombre_stand_by_month')
            ->where('annee', $year)
            ->select('nom_mois', 'nombre_stands')
            ->orderBy('mois')
            ->get();

        if ($standData->isEmpty()) {
            return response()->json([]);
        }

        return response()->json($standData);
    }

    public function getDataUtilisateur(Request $request)
    {
        $year = $request->input('year');

        // Vérification de la validité de l'année
        if (!$year || !is_numeric($year)) {
            return response()->json([]);
        }

        $standData = DB::table('v_nombre_emp_by_month')
            ->where('annee', $year)
            ->select('nom_mois', 'nombre_de_personnel')
            ->orderBy('mois')
            ->get();

        if ($standData->isEmpty()) {
            return response()->json([]);
        }

        return response()->json($standData);
    }

    public function getMouvementPersonnel(Request $request)
    {
        $year = $request->input('year');

        // Vérification de la validité de l'année
        if (!$year || !is_numeric($year)) {
            return response()->json([]);
        }

        $standData = DB::table('v_mouvement_personnel_by_month')
            ->where('annee', $year)
            ->select('nom_mois', 'nombre_mouvement')
            ->orderBy('mois')
            ->get();

        if ($standData->isEmpty()) {
            return response()->json([]);
        }

        return response()->json($standData);
    }

    public function getVideoContenueVideo(Request $request)
    {
        $year = $request->input('year');

        if (!$year || !is_numeric($year)) {
            return response()->json([]);
        }

        $standData = DB::table('v_nombre_video_contenue_by_month')
            ->where('annee', $year)
            ->select('nom_mois', 'nombre_contenue')
            ->orderBy('mois')
            ->get();

        if ($standData->isEmpty()) {
            return response()->json([]);
        }

        // Debug des données avant de les retourner
        logger()->info('Donut Chart Data:', $standData->toArray());

        return response()->json($standData);
    }

    public function getContenuePhoto(Request $request)
    {
        $year = $request->input('year');

        if (!$year || !is_numeric($year)) {
            return response()->json([]);
        }

        $standData = DB::table('v_nombre_contenue_photo_by_month')
            ->where('annee', $year)
            ->select('nom_mois', 'nombre_contenue')
            ->orderBy('mois')
            ->get();

        if ($standData->isEmpty()) {
            return response()->json([]);
        }

        // Debug des données avant de les retourner
        logger()->info('Donut Chart Data:', $standData->toArray());

        return response()->json($standData);
    }



    public function search(Request $request)
    {
        $search = $request->search;

        $getEmpModel = new EmpModel();
        $results = $getEmpModel->searchEmp($search);

        // Retourne les résultats au format JSON
        return response()->json($results);
    }




}
