<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\EmpModel;
use App\Models\StandModel;
use App\Models\FaculteModel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;
class EmpController extends Controller
{

    //afficher le login
    public function viewAuthentificationEmp()
    {
        return view('authentification.authentificationEmp');
    }




 //function authentification de l'employer
 public function signInEmp(Request $request)
 {
     $email = $request->email;
     $matricule_emp = $request->matricule_emp;
     $remember = $request->has('remember');

    $getSignEmp = new EmpModel();
    $verifyEtat = $getSignEmp->getAuthEmp($email,$matricule_emp);

    if ($verifyEtat !=null) {
            # code...
            $cookieName = 'id_emp_' . $verifyEtat[0]->id_emp;

        $result = $getSignEmp->authentificationEmp($email,$matricule_emp,$remember);

        if ($verifyEtat !=null) {

            if ($verifyEtat[0]->id_etat !=8 && $verifyEtat[0]->id_etat !=9 && $verifyEtat[0]->id_etat !=10) {
                if ($result[0]->id_etat == 7) {
                    return redirect()->route('viewDirecteurEmpPage');
                }
                else{
                    return redirect()->route('viewEmpPage');
                }
            }
            else {
                $error = 'Erreur vous avez ete licensier ou bien demessionner';
                return redirect()->back()->withErrors(['error' => $error])->withInput();

            }

        } else {
            # code...
            $error = 'Invalide verifier votre email ou votre numero matricule';
            return redirect()->back()->withErrors(['error' => $error])->withInput();

        }
    }
    else {
        # code...
         # code...
         $error = 'Invalide verifier votre email ou votre numero matricule';
         return redirect()->back()->withErrors(['error' => $error])->withInput();
    }


    $etat = $verifyEtat[0]->id_etat;
    dd($etat);

    // dd($cookieName,$result[0]->id_emp);

 }


  //function authentification de l'employer
  public function signInEmpV1(Request $request)
  {
      $email = $request->email;
      $matricule_emp = $request->matricule_emp;
      $remember = $request->has('remember');

     $getSignEmp = new EmpModel();
     $verifyEtat = $getSignEmp->getAuthEmp($email,$matricule_emp);

     if ($verifyEtat !=null) {
        $credentials = [
            'email' => $verifyEtat[0]->email, // Assurez-vous que la propriété existe
            'matricule_emp' => $verifyEtat[0]->matricule_emp,
        ];

        if(EmpModel::attempt($credentials, $remember))
        {
            # code...

            $cookieName = 'id_emp_' . $verifyEtat[0]->id_emp;

            $result = $getSignEmp->authentificationEmpV1($email,$matricule_emp,$remember);

            if ($verifyEtat !=null) {

                if ($verifyEtat[0]->id_etat !=8 && $verifyEtat[0]->id_etat !=9) {
                    if ($result[0]->id_etat == 7) {
                        return redirect()->route('viewDirecteurEmpPage');
                    }
                    else{
                        return redirect()->route('viewEmpPage');
                    }
                }
                else {
                    $error = 'Erreur vous avez ete licensier ou bien demessionner';
                    return redirect()->back()->withErrors(['error' => $error])->withInput();

                }

            } else {
                # code...
                $error = 'Invalide verifier votre email ou votre numero matricule';
                return redirect()->back()->withErrors(['error' => $error])->withInput();

            }
        }

     }
     else {
         # code...
          # code...
          $error = 'Invalide verifier votre email ou votre numero matricule';
          return redirect()->back()->withErrors(['error' => $error])->withInput();
     }

     $etat = $verifyEtat[0]->id_etat;
     dd($etat);

     // dd($cookieName,$result[0]->id_emp);

  }



    public function getSignOutEmp(Request $request)
    {
            // Récupérer l'ID de l'employé depuis la session
        $id_emp = Session::get('id_emp');

        if ($id_emp) {
            // Créer le nom du cookie en fonction de l'ID
            $cookieName = 'id_emp_' . $id_emp;

            // Supprimer le cookie de l'utilisateur
            Cookie::queue(Cookie::forget($cookieName));
        }

        // Supprimer toutes les sessions
        Session::flush();

        // Régénérer la session pour éviter les attaques par fixation de session
        $request->session()->regenerate();

        // Redirection vers la page de connexion ou une autre page souhaitée
        return redirect()->route('viewauthentificationEmp');

    }



    //afficher la page de l'employer
    public function viewEmpPage()
    {

        return view('emp.empPage');
    }

    //aficher le stand non publier et publier
    public function viewStandEmp()
    {
        $session_id_emp = Session::get('id_emp');
        //dd($session_id_emp);

            $cookieName = 'id_emp_' . $session_id_emp; // Assurez-vous que $session_id_emp est défini
            $cookie_Emp = Cookie::get($cookieName);


        $getStandModel = new StandModel();
        $standMembre = $getStandModel->getAllStandEmpById($cookie_Emp);

        return view('emp.standEmp',compact('standMembre'));

    }


    //gestion de contenue
    public function viewGestionContenue()
    {
        return view('emp.gestionContenueEmp');
    }

    public function viewformulaireAddPosterAndProjet()
    {
        $getStandModel = new StandModel();
        $type_stand = $getStandModel->getAllTypeStand();
        $id_emp = Session::get('id_emp');
        $stand = $getStandModel->getViewMembreStandByIdEmp($id_emp);

        return view('emp.formulaireAddPostAndProjet',compact('stand','type_stand'));
    }

    public function AddPosterAndProjet(Request $request)
    {
        $id_stand = $request->id_stand;
        $id_type_stand = $request->id_type_stand;
        $nom_info_type_stand = $request->nom_info_type_stand;
        $description_info_type_stand = $request->description_info_type_stand;

        $image = [];
        foreach ($request->file('img_info_type_stand') as $img_stand)
        {
            $img_stand_name = $img_stand->getClientOriginalName();
            $img_stand->move(public_path('assets'),$img_stand_name);
            $image[] = $img_stand_name;
        }

        $getEmpModel = new StandModel();
        $ContenueStand = $getEmpModel->insertContenueStand($id_stand,$id_type_stand,$nom_info_type_stand,$description_info_type_stand,$image);

        return redirect()->route('viewformulaireAddPosterAndProjet')->with('success', 'Contenue publier');
    }


    public function viewGestionBrochure()
    {
        return view('emp.gestionBrochureEmp');
    }


    public function viewChoixDeStandBrochureEmp()
    {
        $id_emp = Session::get('id_emp');

        $getStandModel = new StandModel();
        $standSuccessByIdEmp = $getStandModel->getAllStandSuccessByEmp($id_emp);

        return view('emp.choixStandBrochureEmp',compact('standSuccessByIdEmp'));

    }

    public function viewChoixContenuePourBrochureEmp(Request $request)
    {

        $id_stand = $request->id_stand;

        $getStandModel = new StandModel();

        //contenue de stand de id_stand
        $contenue =$getStandModel->viewInfoTypeStandByIdStand($id_stand);
        //geter le nom de stand
        $stand = $getStandModel->viewModifierByEmp($id_stand);


        return view('emp.choixContenuePourBrochureEmp',compact('contenue','stand'));

    }

    public function viewFormulaireAjoutBrochureEmp(Request $request)
    {
        $id_info_type_stand = $request->id_info_type_stand;
        $getStandModel = new StandModel();
        $getBrochure = $getStandModel->getAllBrochureContenue($id_info_type_stand);

        if ($getBrochure ==null) {
            # code...
            return view('emp.formulaireBrochureEmp',compact('id_info_type_stand'));
        } else {
            # code...
            $error = 'Vous ne pouvez plus publier de brochure .';
            return redirect()->back()->withErrors(['error' => $error])->withInput();
        }

    }


    public function publierBrochureEmp(Request $request)
    {
        $id_info_type_stand = $request->id_info_type_stand;
        $nom_brochure = $request->nom_brochure;

        $fichier = $request->file('fichier');
        $fichier_name = $fichier->getClientOriginalName();
        $fichier->move(public_path('assets/pdf'),$fichier_name);

        $getStandModel = new StandModel();
        $getStandModel->insertBrochure($id_info_type_stand,$nom_brochure,$fichier_name);


        return redirect()->route('viewChoixDeStandBrochureEmp')->with('success', 'Brochure publier');
    }

    public function viewPermissionDemissionEmp()
    {
        return view('emp.formulairedemissionEmp');
    }

    public function permissionDemission(Request $request)
    {
        $justification_demission = $request->justification_demission;

        $id_emp = Session::get('id_emp');

        $getEmpModel = new EmpModel();
        $emp_demission = $getEmpModel->getEmpDemandeDemission($id_emp);
        $id_directeur = $emp_demission[0]->id_directeur;
        $id_stand = $emp_demission[0]->id_stand;

        $getEmpModel->permissionDemissionEmployer($justification_demission,$id_emp,$id_directeur,$id_stand);


        Notification::create([
            'user_id' => $id_directeur,
            'title' => 'Validation de demission',
            'message' => 'Un des votre employer a fait une demande de demission. Cliquez ici pour plus de détails.',
            'link' => route('viewDemissionEmployer')
        ]);
    }

    public function viewMessageEmp()
    {
        $getStandModel = new StandModel();
        $id_emp = Session::get('id_emp');
        $getStandEmp = $getStandModel->getAllStandSuccessByEmp($id_emp);
        $id_stand = $getStandEmp[0]->id_stand;
        $membre_stand = $getStandModel->getViewMembreStandV1ByIidStand($id_stand);
        return view('emp.viewMessageEmp',compact('membre_stand'));
    }

    public function viewMessageSendOrReciveEmp(Request $request)
    {
        //pour directeur
        $id = $request->id;
        $nom = $request->nom;
        $prenom = $request->prenom;
        $id_etat_personne = $request->etat;



        if ($id_etat_personne == 7) {
            # code...
            $id_emp = Session::get('id_emp');
            $getEmpModel = new EmpModel();
            $getInfoEmp = $getEmpModel->getEmpById($id_emp);

            $nom_emp = $getInfoEmp[0]->nom_emp;
            $prenom_emp = $getInfoEmp[0]->prenom_emp;
            $id_emp = $getInfoEmp[0]->id_emp;

               //dd($id);
            return view('emp.viewMessageSendOrReciveEmp',compact('id','nom','prenom','id_etat_personne','nom_emp','prenom_emp','id_emp'));

        }
        else
        {
            $id_emp = Session::get('id_emp');
            $getEmpModel = new EmpModel();
            $getInfoEmp = $getEmpModel->getEmpById($id_emp);

            $nom_emp = $getInfoEmp[0]->nom_emp;
            $prenom_emp = $getInfoEmp[0]->prenom_emp;
            $id_emp = $getInfoEmp[0]->id_emp;
            return view('emp.viewMessageSendOrReciveEmp',compact('id','nom','prenom','id_etat_personne','nom_emp','prenom_emp','id_emp'));
        }

        // dd($nom,$prenom_emp,$id_etat_personne);
        //return view('emp.viewMessageSendOrReciveEmp',compact('id','nom','prenom','id_etat_personne'));
    }



    public function searchPersonne(Request $request)
    {
        $search = $request->search;

        $getEmpModel = new EmpModel();
        $seacrhEmp = $getEmpModel->searchEmp($search);
    }

    public function viewformulaireAddVideoEmpSection()
    {
        $getStandModel = new StandModel();
        $id_emp = Session::get('id_emp');
        $stand = $getStandModel->getViewMembreStandByIdEmp($id_emp);
        return view('emp.formulaireAddVideoEmp',compact('stand'));
    }


    public function addVideoEmp(Request $request)
    {
        // Validation des données du formulaire
        $validator = Validator::make($request->all(), [
            'id_stand' => 'required|exists:stand,id_stand', // Assurez-vous que la table "stand" existe
            'titre_video' => 'required|string|max:255',
            'description_video' => 'required|string',
            'video_contenue' => 'required|file|mimetypes:video/mp4,video/mpeg,video/ogg,video/webm|max:40960', // Taille max 40MB
        ]);

        if ($validator->fails()) {
            return back()->withErrors(['error' => $validator->errors()->first()])->withInput();
        }

        try {
            // // Récupérer les données validées
            $id_stand = $request->input('id_stand');
            $titre_video = $request->input('titre_video');
            $description_video = $request->input('description_video');

            $video_contenue = $request->file('video_contenue');
            //dd($video_contenue);
            $video_contenue_name = $video_contenue->getClientOriginalName();
            $video_contenue->move(public_path('assets'),$video_contenue_name);

            $getStandModel = new StandModel();
            $getStandModel->insertVideoContenue($id_stand,$description_video,$titre_video,$video_contenue_name);

            return redirect()->route('viewformulaireAddVideoEmpSection')->with('success', 'Contenue publier');


            // Retour avec un message de succès
            return back()->with('success', 'Vidéo ajoutée avec succès.');
        } catch (\Throwable $e) {
            // Gestion des erreurs
            return back()->withErrors(['error' => 'Une erreur s\'est produite lors de l\'ajout de la vidéo : ' . $e->getMessage()]);
        }
    }
}
