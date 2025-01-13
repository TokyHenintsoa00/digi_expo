<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\EmpModel;
use App\Models\StandModel;
use App\Models\VideoModel;
use App\Models\Temoignage;
use App\Models\FaculteModel;
use App\Models\Event;
use App\Models\CategorieModel;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
class DirecteurEmpController extends Controller
{
    public function viewDirecteurEmpPage()
    {
        return view('directeurEmp.directeurEmpPage');
    }

    //liste des stand non publier
    public function viewStandDirecteur()
    {
        $session_id_emp = Session::get('id_emp');
        //dd($session_id_emp);

            $cookieName = 'id_emp_' . $session_id_emp; // Assurez-vous que $session_id_emp est défini
            $cookie_Emp = Cookie::get($cookieName);


        $standMembre = new StandModel();
        $getStandMembre = $standMembre->getAllStandEmpByIdEmp($cookie_Emp);
        return view('directeurEmp.standDirecteur',compact('getStandMembre'));
    }

    public function publication(Request $request)
    {
        $id_stand = $request->id_stand;
        $getPublication = new StandModel();
        $i = $getPublication->publierStand($id_stand);

        //dd($i);
        return redirect()->route('viewStandDirecteur');
    }

    public function viewModifierStand(Request $request)
    {
        $id_stand = $request->id_stand;
        $getStandModel = new StandModel();
        $modifier = $getStandModel->viewModifierByEmp($id_stand);

        $getCategorieModel = new CategorieModel();
        $categorie = $getCategorieModel->getAllCategorie();

        return view('directeurEmp.modicationStand',compact('modifier','categorie'));
    }

    //fonction pour modifier un stand
    public function modifier(Request $request)
    {
        $id_stand = $request->id_stand;
        $nom_stand = $request->nom_stand;
        $id_categorie = $request->id_categorie;
        $nom_categorie_stand = $request->nom_categorie_stand;
        $description_stand = $request->description_stand;

        $img_stand = $request->file('img_stand');
        $img_stand_name = $img_stand->getClientOriginalName();
        $img_stand->move(public_path('assets'),$img_stand_name);

        $getStandModel = new StandModel();
        $getStandModel->modifierStand($id_categorie,$nom_stand,$description_stand,$img_stand_name,$id_stand,$nom_categorie_stand);

        return redirect()->route('viewStandDirecteur')->with('success', 'Modification');

    }


    public function viewDemandeNouvelleStand(Request $request)
    {
        $getCategorieModel = new CategorieModel();
        $getAllCategorie = $getCategorieModel->getAllCategorie();
        return view('directeurEmp.demandeStand',compact('getAllCategorie'));
    }

    public function demandeStandEmp(Request $request)
    {
        $getReceptionModel = new ReceptionModel();

        $nom_stand = $request->nom_stand;
        $id_categorie = $request->id_categorie;
        $nom_categorie = $request->nom_categorie;
        $description_stand = $request->description_stand;
        $date_debut = $request->date_debut;
        $date_fin = $request->date_fin;

        $img_stand = $request->file('img_stand');
        $img_stand_name = $img_stand->getClientOriginalName();
        $img_stand->move(public_path('assets'),$img_stand_name);

        $session_id_emp = Session::get('id_emp');

        $emp = new EmpModel();
        $getEmpId = $emp->getEmpById($session_id_emp);

        $nom_emp = $getEmpId[0]->nom_emp;
        $prenom_emp = $getEmpId[0]->prenom_emp;
        $date_naissance = $getEmpId[0]->date_naissance;
        $email = $getEmpId[0]->email;

        $getSalon = $getReceptionModel->getAllSalon();

        $stand = new StandModel();
        $stand->insertPermissionStand($nom_stand,$id_categorie,$nom_categorie,$description_stand,
        $nom_emp,$prenom_emp,$date_naissance,$email,$img_stand_name,$date_debut,$date_fin);

        return redirect()->route('viewDemandeNouvelleStand')->with('success', 'Le formulaire a été soumis avec succès !<br>Vous recevrez un e-mail une fois que l\'administrateur aura validé votre demande.');
    }


    public function viewGestionPersonnel()
    {
        return view('directeurEmp.gestionPersonnel');
    }

    //------
    public function viewRecrutementEmp()
    {
        $getStandModel = new StandModel();
        $session_id_emp = Session::get('id_emp');
        $viewMembreStand = $getStandModel->getViewMembreStandById($session_id_emp);

        return view('directeurEmp.formulaireRecrutementEmp',compact('viewMembreStand'));
    }


    public function recrutementEmp(Request $request)
    {
        $nom_emp = $request->nom_emp;
        $prenom_emp = $request->prenom_emp;
        $email_emp = $request->email_emp;
        $date_naissance_emp = $request->date_naissance_emp;
        $id_stand = $request->id_stand;
        $id_expediteur = Session::get('id_emp');

        $getEmpModel = new EmpModel();
        $getEmpModel->insertPermissionEmployer($nom_emp,$prenom_emp,$email_emp,$date_naissance_emp,$id_stand,$id_expediteur);
        return redirect()->route('viewRecrutementEmp')->with('success', 'Le formulaire a été soumis avec succès apres validation vous receveriez un notification');
    }

    public function viewLicensimentEmployer()
    {
        $getEmpModel = new EmpModel();
        $id_directeur = Session::get('id_emp');
        $employerDirecteur = $getEmpModel->getAllEmployerDirecteur($id_directeur);

        return view('directeurEmp.licensimentEmployer',compact('employerDirecteur'));
    }

    public function licensiment(Request $request)
    {
        $id_emp = $request->id_emp;
        $getEmpModel = new EmpModel();
        $licensier = $getEmpModel->licensiment($id_emp);
        $mouvement = $getEmpModel->insertMouvementPersonnelLicensimentEmp($id_emp);
        return redirect()->route('viewLicensimentEmployer')->with('success', 'Lincesiment soumis avec succes');

    }

    public function viewGestionContenue()
    {
       return view('directeurEmp.gestionContenue');
    }


    //------------------POUR PHOTOS------------------------------------------
    public function viewformulaireAddPosterAndProjetEmp()
    {
        $getStandModel = new StandModel();
        $type_stand = $getStandModel->getAllTypeStand();
        $id_emp = Session::get('id_emp');
        $stand = $getStandModel->getViewMembreStandById($id_emp);

        return view('directeurEmp.formulaireAddPosterAndProjetEmp',compact('type_stand','stand'));
    }


    public function AddPosterAndProjetEmp(Request $request)
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

        return redirect()->route('viewformulaireAddPosterAndProjetEmp')->with('success', 'Contenue publier');

    }


    public function viewModifierPosterProjet()
    {
        $getStandModel = new StandModel();
        $id_emp = Session::get('id_emp');
        //geter le stand (manao select distinc by id_emp)
        $stand = $getStandModel->getViewMembreStandById($id_emp);
        //geter le id_Stand  du select distinct
        $id_stand = $stand[0]->id_stand;
        //contenue de stand de id_stand
        $contenue =$getStandModel->viewInfoTypeStandByIdStand($id_stand);
        //geter le nom de stand
        $stand = $getStandModel->viewModifierByEmp($id_stand);
        return view('directeurEmp.viewModificationPosterProjet',compact('contenue','stand'));
    }


    public function viewformulaireModifierAddPosterAndProjetEmp(Request $request)
    {

        $id_info_type_stand = $request->id_info_type_stand;
        $id_info_type_stand_desc = $request->id_info_type_stand_desc;
        $id_stand = $request->id_stand;

        $information_contenue = [
            'id_info_type_stand' => $id_info_type_stand,
            'id_info_type_stand_desc' => $id_info_type_stand_desc,
            'id_stand' => $id_stand];
        //dd($id_info_type_stand,$id_info_type_stand_desc,$id_stand);

        $getStandModel = new StandModel();
        $type_stand = $getStandModel->getAllTypeStand();
        $id_emp = Session::get('id_emp');

        $stand = $getStandModel->getViewMembreStandById($id_emp);
        $getId_stand = $stand[0]->id_stand;


        $id_info_type_stand = $getStandModel->viewInfoTypeStandByIdStand($getId_stand);

        return view('directeurEmp.formulaireModificationPosterProjet', compact('type_stand','stand','id_info_type_stand','information_contenue'));
    }


    public function modifierContenue(Request $request)
    {

        $id_type_stand = $request->id_type_stand;
        $nom_info_type_stand = $request->nom_info_type_stand;
        $description_info_type_stand = $request->description_info_type_stand;
        $id_info_type_stand = $request->id_info_type_stand;
        $id_info_type_stand_desc = $request->id_info_type_stand_desc;

        $image = [];
        foreach ($request->file('img_info_type_stand') as $img_stand)
        {
            $img_stand_name = $img_stand->getClientOriginalName();
            $img_stand->move(public_path('assets'),$img_stand_name);
            $image[] = $img_stand_name;
        }

        $getStandModel = new StandModel();
        $getStandModel->updateContenueStand($id_info_type_stand,$id_info_type_stand_desc,
        $id_type_stand,$nom_info_type_stand,$description_info_type_stand,$image);

        return redirect()->route('viewGestionContenue')->with('success', 'Contenue publier');

    }

    //-----------------------------------------------------------

    //-----------------POUR VIDEO-------------------------------------------
    public function viewFormulaireAddVideo()
    {
        $getStandModel = new StandModel();
        $id_emp = Session::get('id_emp');
        $stand = $getStandModel->getViewMembreStandById($id_emp);
        return view('directeurEmp.formulaireAddVideo',compact('stand'));
    }


    public function addVideo(Request $request)
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

            return redirect()->route('viewFormulaireAddVideo')->with('success', 'Contenue publier');


            // Retour avec un message de succès
            return back()->with('success', 'Vidéo ajoutée avec succès.');
        } catch (\Throwable $e) {
            // Gestion des erreurs
            return back()->withErrors(['error' => 'Une erreur s\'est produite lors de l\'ajout de la vidéo : ' . $e->getMessage()]);
        }
    }

    public function viewModificationVideo()
    {
        $getStandModel = new StandModel();
        $id_emp = Session::get('id_emp');
        //geter le stand (manao select distinc by id_emp)
        $stand = $getStandModel->getViewMembreStandById($id_emp);
        //geter le id_Stand  du select distinct
        $id_stand = $stand[0]->id_stand;
        $contenue_video = $getStandModel->getAllContenueVideo($id_stand);

        return view('directeurEmp.viewModificationVideo',compact('contenue_video'));
    }

    public function viewFormulaireModificationVideo(Request $request)
    {
        $id_video_contenue = $request->id_video_contenue;
        return view('directeurEmp.formulaireModificationVideo',compact('id_video_contenue'));

    }

    public function modificationVideo(Request $request)
    {
        $titre_video = $request->titre_video;
        $description_video = $request->description_video;
        $video_contenue = $request->file('video_contenue');
        $video_contenue_name = $video_contenue->getClientOriginalName();
        $video_contenue->move(public_path('assets'),$video_contenue_name);
        $id_video_contenue = $request->id_video_contenue;

        //dd($id_video_contenue);
        $getStandModel = new StandModel();
        $getStandModel->modifiyVideo($titre_video,$description_video,$video_contenue_name,$id_video_contenue);

        return redirect()->route('viewGestionContenue')->with('success', 'Contenue publier');

    }

    //----------------------------------------------------------------------
    public function viewGestionBrochure()
    {
        return view('directeurEmp.gestionBrochure');
    }

    public function viewChoixDeStandBrochure()
    {

        $id_directeur = Session::get('id_emp');

        $getStandModel = new StandModel();
        $standSuccessByIdDirecteur = $getStandModel->getAllStandSuccessByDirecteur($id_directeur);

        return view('directeurEmp.choixStandBrochure',compact('standSuccessByIdDirecteur'));
    }

    public function viewChoixContenuePourBrochure(Request $request)
    {

        $id_stand = $request->id_stand;

        $getStandModel = new StandModel();

        //contenue de stand de id_stand
        $contenue =$getStandModel->viewInfoTypeStandByIdStand($id_stand);
        //geter le nom de stand
        $stand = $getStandModel->viewModifierByEmp($id_stand);



        //dd($id_info_type_stand);

        // $id_info_type_stand = $contenue[0]->id_info_type_stand;
        // $brochures = $getStandModel->getAllBrochureContenue($id_info_type_stand);

        return view('directeurEmp.choixContenuePourBrochure',compact('contenue','stand'));

    }

    //avec verification de brochure
    //si exsiste message erreur
    //sinon ca va vers le formulaure
    public function viewFormulaireAjoutBrochure(Request $request)
    {
        $id_info_type_stand = $request->id_info_type_stand;
        $getStandModel = new StandModel();
        $getBrochure = $getStandModel->getAllBrochureContenue($id_info_type_stand);

        if ($getBrochure ==null) {
            # code...
            return view('directeurEmp.formulaireBrochure',compact('id_info_type_stand'));
        } else {
            # code...
            $error = 'Vous ne pouvez plus publier .';
            return redirect()->back()->withErrors(['error' => $error])->withInput();
        }
    }

    //function pour publication de brochure de stand
    public function publierBrochure(Request $request)
    {
        $id_info_type_stand = $request->id_info_type_stand;
        $nom_brochure = $request->nom_brochure;

        $fichier = $request->file('fichier');
        $fichier_name = $fichier->getClientOriginalName();
        $fichier->move(public_path('assets/pdf'),$fichier_name);

        $getStandModel = new StandModel();
        $getStandModel->insertBrochure($id_info_type_stand,$nom_brochure,$fichier_name);
        return redirect()->route('viewChoixDeStandBrochure')->with('success', 'Brochure publier');


    }

    public function viewFormulaireDeModificationBrochure(Request $request)
    {
        $id_info_type_stand = $request->id_info_type_stand;
        $getStandModel = new StandModel();
        $fichier = $getStandModel->getFichierPdf($id_info_type_stand);

        if ($fichier !=null)
        {
            # code...
            return view('directeurEmp.formulaireDeModificationBrochure',compact('id_info_type_stand'));

        } else {
            # code...
            $error = 'Erreur vous de pouvez pas encore modifier car il y a pas de brochure';
            return redirect()->back()->withErrors(['error' => $error])->withInput();

        }


    }

    public function modificationBrochure(Request $request)
    {
        $id_info_type_stand = $request->id_info_type_stand;

        $nom_brochure = $request->nom_brochure;

        $fichier = $request->file('fichier');
        $fichier_name = $fichier->getClientOriginalName();
        $fichier->move(public_path('assets/pdf'),$fichier_name);

        $getStandModel = new StandModel();
        $getStandModel->modifieBrochure($id_info_type_stand,$nom_brochure,$fichier_name);

        //return redirect()->route('viewChoixDeStandBrochure')->with('success', 'Brochure publier');
    }





    public function viewDemissionEmployer()
    {
        $getEmpModel = new EmpModel();
        $id_directeur = Session::get('id_emp');
        $demissionEmp = $getEmpModel->getAllPermissionDemissionEmployerByIdDirecteur($id_directeur);
        return view('directeurEmp.demissionEmployer',compact('demissionEmp'));
    }


    public function demissionEmployer(Request $request)
    {
        $id_emp = $request->id_emp;
        $getEmpModel = new EmpModel();
        $demission = $getEmpModel->validationPermissionDemission($id_emp);
        $mouvement_personnel = $getEmpModel->insertMouvementPersonneDemissionEmployer($id_emp);
        //information de l'employer
        $getEmpById = $getEmpModel->getEmpById($id_emp);

        $nom_emp = $getEmpById[0]->nom_emp;
        $prenom_emp = $getEmpById[0]->prenom_emp;
        $email_emp = $getEmpById[0]->email;
        Mail::send('emails.sentMailAcceptDemissionEmp',[
            'nom_emp' =>$nom_emp,
            'prenom_emp' =>$prenom_emp,
        ],function($message) use($email_emp,$nom_emp,$prenom_emp){
            $message->to($email_emp)
                    ->subject('Validation de demande de demission');
        });
    }

    public function viewListEmpAndNombreEmpParStand()
    {
        $id_directeur = Session::get('id_emp');

        $getEmpModel = new EmpModel();
        $getAllEmpDirecteur = $getEmpModel->getAllEmployer1ByIdDirecteur($id_directeur);
        $getCountEmpStand = $getEmpModel->countEmpStandByDirecteur($id_directeur);
        return view('directeurEmp.listEmpAndNombreEmpStand',compact('getAllEmpDirecteur','getCountEmpStand'));
    }



    public function viewVideoConference()
    {

        return view('directeurEmp.VideoConference');
    }


    public function viewPlanificationVideoConference()
    {
        $getVideoModel = new VideoModel();
        $type_conference = $getVideoModel->getAllTypeConference();
        $type_video = $getVideoModel->getAllTypeVideo();
        return view('directeurEmp.PlanificationVideoConference',compact('type_conference','type_video'));
    }

    public function planificationVideoConference(Request $request)
    {
        $titre_video = $request->titre_video;
        $id_type_video = $request->id_type_video;
        $id_type_conference = $request->id_type_conference;
        $date_heure_conference = $request->date_heure_conference;
        $liens_video = $request->liens_video;
        $id_directeur = Session::get('id_emp');
        $getVideoModel = new VideoModel();
        if ($liens_video ==null) {
            # code...
            $getVideoModel->insertSalleConferenceWithoutLink($titre_video,$id_directeur,$id_type_video,$id_type_conference,$date_heure_conference);
            return redirect()->route('viewVideoConference')->with('success', 'video conference publier');


        } else {
            # code...
            $getVideoModel->insertSalleConferenceWithLink($titre_video,$id_directeur,$id_type_video,$id_type_conference,$date_heure_conference,$liens_video);
            return redirect()->route('viewVideoConference')->with('success', 'video conferece publier');

        }
    }


    public function viewModificationVideoConference()
    {
        $getVideoModel = new VideoModel();
        $id_directeur = Session::get('id_emp');
        $videoConference = $getVideoModel->viewVideoConferenceByIdDirecteur($id_directeur);
        return view('directeurEmp.viewModificationVideoConference',compact('videoConference'));
    }


    public function viewFormulaireModificationVideoConference(Request $request)
    {
        $getVideoModel = new VideoModel();
        $type_conference = $getVideoModel->getAllTypeConference();
        $type_video = $getVideoModel->getAllTypeVideo();
        $id_salle_conference = $request->id_salle_conference;

        //dd($id_salle_conference);
        return view('directeurEmp.formulaireModificationVideoConference',compact('type_conference','type_video','id_salle_conference'));
    }

    public function modificationVideoConference(Request $request)
    {
        $titre_video = $request->titre_video;
        $id_type_video = $request->id_type_video;
        $id_type_conference = $request->id_type_conference;
        $date_heure_conference = $request->date_heure_conference;
        $liens_video = $request->liens_video;
        $id_salle_conference = $request->id_salle_conference;
        $getVideoModel = new VideoModel();
        if ($liens_video ==null) {
            # code...
            $getVideoModel->modificationVideoConferenceWithoutLink($titre_video,$id_type_video,$id_type_conference,$date_heure_conference,$id_salle_conference);
            return redirect()->route('viewVideoConference')->with('success', 'video conferece modifier');



        } else {
            # code...
            $getVideoModel->modificationVideoConferenceWithLink($titre_video,$id_type_video,$id_type_conference,$date_heure_conference,$liens_video,$id_salle_conference);
            return redirect()->route('viewVideoConference')->with('success', 'video conferece modifier');


        }

        //dd($titre_video,$id_type_video,$id_type_conference,$date_heure_conference,$liens_video,$id_salle_conference);
    }

    public function viewAddLinkVideo(Request $request)
    {
        $id_salle_conference = $request->id_salle_conference;
        return view('directeurEmp.addLinkVideoConference',compact('id_salle_conference'));
    }

    public function addLinkVideo(Request $request)
    {
        $liens_video = $request->liens_video;
        $id_salle_conference = $request->id_salle_conference;
        $getVideoModel = new VideoModel();

        $getVideoModel->AddLink($liens_video,$id_salle_conference);
        return redirect()->route('viewVideoConference')->with('success', 'Lines ajouter');


    }

    // public function viewMessageDirecteur()
    // {
    //     $id_directeur = Session::get('id_emp');
    //     $getEmpModel = new EmpModel();
    //     $getAllEmployerDirecteur = $getEmpModel->getAllEmployerByIdDirecteur($id_directeur);

    //     return view('directeurEmp.viewMessageDirecteur',compact('getAllEmployerDirecteur'));
    // }


    // MODIFICATION DE ID STAND
    public function viewMessageDirecteur()
    {
        $getStandModel = new StandModel();
        $id_directeur = Session::get('id_emp');

        $getStandDirecteur = $getStandModel->getAllStandSuccessByDirecteur($id_directeur);
        //$id_stand = $getStandDirecteur[0]->id_stand;
        $id_stand = collect($getStandDirecteur)->pluck('id_stand')->toArray();

        $membre_stand = $getStandModel->getViewMembreStandByIdArray($id_stand);

        return view('directeurEmp.viewMessageDirecteur',compact('membre_stand'));
    }

    public function viewMessageSendOrReciveDirecteur(Request $request)
    {
        $nom_emp = $request->nom_emp;
        $prenom_emp = $request->prenom_emp;
        $id_emp = $request->id_emp;

        $nom_directeur = $request->nom_dir;
        $prenom_directeur = $request->prenom_dir;
        $id_directeur = $request->id_directeur;
        $etat_directeur = $request->etat_dir;

        //dd($etat_directeur,$prenom_directeur);
        return view('directeurEmp.viewMessageSendOrReciveDirecteur',compact('nom_emp','prenom_emp','id_emp',
        'nom_directeur','prenom_directeur','id_directeur','etat_directeur'));
    }




    public function viewCalendrierSuivi()
    {
        $getEventModel = new Event();
        $id_directeur = Session::get('id_emp');
        $eventData = $getEventModel->getAll($id_directeur); // Récupère tous les événements


        $getStandModel = new StandModel();
        $getEmpModel = new EmpModel();
        $getVideoModel = new VideoModel();

        $membre_stand = $getStandModel->getAllDateEntrerStandEmpByIdDirecteur($id_directeur);
        $stand_directeur = $getStandModel->getAllStandEmpByIdEmp($id_directeur);
        $stand_ids = collect($stand_directeur)->pluck('id_stand')->toArray();

        // Debug : Afficher les IDs des stands récupérés
        // foreach ($stand_ids as $id_stand) {
        //     echo "ID Stand : " . $id_stand . "<br>";
        // }
        // Récupérer les contenus pour ces stands

        $contenue_photo = $getStandModel->viewInfoTypeStandByIdStandCalendar($stand_ids);
        $contenue_video = $getStandModel->getAllContenueVideoCalendar($stand_ids);

        //video conference
        $video_conference = $getVideoModel->viewVideoConferenceByIdDirecteur($id_directeur);
        //get brochure
        $contenue_info = $getStandModel->getAllInfoTypeStandCalendar($stand_ids);
        $id_info_type_stand = collect($contenue_info)->pluck('id_info_type_stand')->toArray();
        $contenue_brochure = $getStandModel->getBrochureCalendar($id_info_type_stand);

        //gestion personnel

            //prendre tout les id emp du directeur
            $employer_directeur = $getEmpModel->getAllEmployerDirecteurByAllEtat($id_directeur);
            $id_employer_directeur = collect($employer_directeur)->pluck('id_emp')->toArray();

            //geter tout le mouvement personnel par id de emopployer du directeur
            $mouvement_personnel = $getEmpModel->getAllMouvementPersonneByIdEmp($id_employer_directeur);

        // dd($id_info_type_stand,$contenue_brochure);


        return view('directeurEmp.viewCalendrierSuivi',compact('membre_stand','eventData','stand_directeur',
        'contenue_photo','contenue_video','contenue_brochure','mouvement_personnel','video_conference'));

    }



    public function supprimerStand(Request $request)
    {
        $id_stand = $request->id_stand;
        $getStandModel = new StandModel();
        $supprimer = $getStandModel->suppressionStand($id_stand);

        return redirect()->route('viewStandDirecteur')->with('success', 'Suppression avec succes');
    }


    public function viewTemoignage()
    {
        return view('directeurEmp.Temoignage');
    }

    public function viewPlanificationTemoignage()
    {
        $id_directeur = Session::get('id_emp');
        $getStandModel = new StandModel();
        $getStandDirecteur = $getStandModel->getAllStandSuccessByDirecteur($id_directeur);
        return view('directeurEmp.planificationTemoignage',compact('getStandDirecteur'));
    }

    public function insertTemoignage(Request $request)
    {
        $titre = $request->titre;
        $id_stand = $request->id_stand;
        $id_directeur = Session::get('id_emp');
        $date_temoignage = $request->date_temoignage;
        $liens_video = $request->liens_video;

        $getTemoignage = new Temoignage;
        $insertTemoignage = $getTemoignage->insertTemoignage($id_stand,$id_directeur,$date_temoignage,$liens_video,$titre);

        return redirect()->route('viewPlanificationTemoignage')->with('success', 'Temoignage planifier');

    }


    public function viewInformationExposition(Request $request)
    {
        $id_stand = $request->id_stand;
        $getStandModel = new StandModel();
        $getStandById = $getStandModel->viewModifierByEmp($id_stand);
        //$nom = $getStandById[0]->nom_stand;


        return view('directeurEmp.informationExposition',compact('getStandById'));
    }
}
