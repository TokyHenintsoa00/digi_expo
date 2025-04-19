<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\FaculteModel;
use App\Models\EmpModel;
use App\Models\Temoignage;
use App\Models\StandModel;
use App\Models\ReceptionModel;
use App\Models\CategorieModel;
use App\Models\VideoModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
class HomePageController extends Controller
{
    public function viewReception()
    {
        $getReceptionModel = new ReceptionModel();

        // Récupérer les données via les fonctions existantes
        $reception = $getReceptionModel->getAllSalon();
        $organisateur = $getReceptionModel->getAllOranisateur();
        $contact_organisateur = $getReceptionModel->getAllContactOrganisateur();
        // Récupérer tous les points existants
        $locations = DB::select("
        SELECT id, name, ST_X(coordinates) AS longitude, ST_Y(coordinates) AS latitude
        FROM locations
        ");

        return view('home.homeReception', compact('reception', 'organisateur', 'contact_organisateur'),['locations' => $locations]);
    }

    //view page stand =>homePage
    public function viewHomePage()
    {
        $getStand = new StandModel();
        $stand = $getStand->maxStand();

        $getReceptionModel = new ReceptionModel();

        // Récupérer les données via les fonctions existantes
        $reception = $getReceptionModel->getSalonWhere();



        $reste_jour = 0;

        if (!empty($reception) && !is_null($reception[0]->date_debut) && !is_null($reception[0]->date_fin))
        {
            $debut = $reception[0]->date_debut;
            $fin = $reception[0]->date_fin;

            // $dateDebut = Carbon::parse($debut);
             $dateFin = Carbon::parse($fin);

            //$dateFin = Carbon::parse('2025-03-11'); // Exemple de date de fin
            $currentDate = Carbon::now(); // Résultat : "2025-01-12"

            $reste_jour = (int) floor($currentDate->diffInDays($dateFin->addDay())); // Inclure le jour de fin
            //dd($reste_jour);
        }

        // //dd($reste_jour);

        $organisateur = $getReceptionModel->getOrganisateurWhere();
        $contact_organisateur = $getReceptionModel->getContactOrganisateurWhere();
        $locations_exposition = $getReceptionModel->getLocationWhere();
        if (!isset($locations_exposition[0]->name)) {
            $location_name = "pas ecore de location de salon";
        }
        else{
            $location_name = $locations_exposition[0]->name;
        }
       $get_id_location = $getReceptionModel->getMaxLocation();
       $id_location = $get_id_location[0]->id;

        //dd($stand);
        //dd($location_name);
        $locations = DB::select("
        SELECT id, name, ST_X(coordinates) AS longitude, ST_Y(coordinates) AS latitude
        FROM locations where id = ?
        ",[$id_location]);



        // $date_fin_salon = $reception[0]->date_fin;

        if ($reste_jour <=0 || $reception[0]->date_fin == null) {
            # code...

            $date_fin_salon = null;
            return view('home.homePage',compact('stand','reception','location_name', 'organisateur', 'contact_organisateur','locations','reste_jour','date_fin_salon'));

        }

        //delcaration de la date de fin du salob
        $date_fin_salon = $reception[0]->date_fin;
        return view('home.homePage',compact('stand','reception','location_name', 'organisateur', 'contact_organisateur','locations','reste_jour','date_fin_salon'));
    }

    //view page video en direct
    public function viewVideoDirect()
    {
        $videoModel = new VideoModel();
        $video_conference_client = $videoModel->getAllReunionPersonne();
        return view('home.videoDirect',compact('video_conference_client'));
    }

    //view page demande aide chatBot
    public function viewDemandeAide(Request $request)
    {

       return view('home.demandeAide');
    }

    //view page permission de faure un stand
    public function viewPermissionDeFaireUnStand()
    {
        // $getAllFaculte = new FaculteModel();
        // $faculte = $getAllFaculte->getAllFaculteStand();

        $getCategorieModel = new CategorieModel();
        $categorie = $getCategorieModel->getAllCategorie();



        return view('home.permissionDeFaireUnStand',compact('categorie'));
    }


    //appelle de la fonction insertPermissionStandEmp
    public function getInsertPermissionStandEmp(Request $request)
    {
        $getInsertPermission = new StandModel();
        $getReceptionModel = new ReceptionModel();

        //---------------etat place stand----------------------
        // $place_stand = $request->place_stand;

        // $getFindPlace = $getInsertPermission->findEtatPlace($place_stand);



        // $getEtatPlace = $getInsertPermission->findEtatPLace();

        //--------------STAND----------------
        $nom_stand = $request->nom_stand;
        $id_categorie = $request->id_categorie;
        $description_stand = $request->description_stand;
        $nom_categorie_stand = $request->nom_categorie_stand;
        $date_debut = $request->date_debut;
        $date_fin = $request->date_fin;

        $img_stand = $request->file('img_stand');
        $img_stand_name = $img_stand->getClientOriginalName();
        $img_stand->move(public_path('assets'),$img_stand_name);


        $getSalonWhere = $getReceptionModel->getSalonWhere();
        $id_max_id_sallon = $getSalonWhere[0]->id_sallon;

        //--------------Emp----------------------
        $nom_employe = $request->nom_employe;
        $prenom_employe = $request->prenom_employe;
        $date_naissance = $request->date_naissance;
        $email_employe = $request->email_employe;
        //------------------------------------------
        // $getInsertPermission = new EmpModel();

        //$getSalon = $getReceptionModel->getAllSalon();
        $getSalon = $getReceptionModel->getSalonWhere();
        // $date_fin_du_salon = $getSalon[0]->date_fin;

        //verification de date
        if($getSalon == null || $getSalon[0]->date_fin < $date_fin || $getSalon[0]->date_fin == null || $getSalon[0]->date_fin == 0)
        {
            return redirect()->back()->withErrors(['error' => 'Vous ne pouvez pas creer une exposition pour le moment'])->withInput();
        }


        $getInsertPermission->insertPermissionStandV1($nom_stand,$id_categorie,$nom_categorie_stand,$description_stand,
        $nom_employe,$prenom_employe,$date_naissance,$email_employe,$img_stand_name,$date_debut,$date_fin,$id_max_id_sallon);
        return redirect()->route('viewpermissionDeFaireUnStand')->with('success', 'Le formulaire a été soumis avec succès !<br>Vous recevrez un e-mail une fois que l\'administrateur aura validé votre demande.');
    }

    public function getInsertPermissionStandEmpV1(Request $request)
    {
        $getInsertPermission = new StandModel();
        $getReceptionModel = new ReceptionModel();

        //--------------STAND----------------
        $nom_stand = $request->nom_stand;
        $id_categorie = $request->id_categorie;
        $description_stand = $request->description_stand;
        $nom_categorie_stand = $request->nom_categorie_stand;
        $date_debut = $request->date_debut;
        $date_fin = $request->date_fin;

        $img_stand = $request->file('img_stand');
        $img_stand_name = $img_stand->getClientOriginalName();
        $img_stand->move(public_path('assets'),$img_stand_name);


        $getSalonWhere = $getReceptionModel->getSalonWhere();
        $id_max_id_salon = $getSalonWhere[0]->id_sallon;

        //--------------Emp----------------------
        $nom_employe = $request->nom_employe;
        $prenom_employe = $request->prenom_employe;
        $date_naissance = $request->date_naissance;
        $email_employe = $request->email_employe;
        //------------------------------------------

        $getSalon = $getReceptionModel->getSalonWhere();
        // $date_fin_du_salon = $getSalon[0]->date_fin;

        //verification de date
        if($getSalon == null || $getSalon[0]->date_fin < $date_fin || $getSalon[0]->date_fin == null || $getSalon[0]->date_fin == 0)
        {
            return redirect()->back()->withErrors(['error' => 'Vous ne pouvez pas creer une exposition pour le moment'])->withInput();
        }
        return redirect()->route('viewSelectPlaceStand')->with([
            'nom_stand' => $nom_stand,
            'id_categorie' => $id_categorie,
            'description_stand' => $description_stand,
            'nom_categorie_stand' => $nom_categorie_stand,
            'date_debut' => $date_debut,
            'date_fin' => $date_fin,
            'img_stand_name' => $img_stand_name,
            'id_max_id_salon' => $id_max_id_salon,
            'nom_employe' => $nom_employe,
            'prenom_employe' => $prenom_employe,
            'date_naissance' => $date_naissance,
            'email_employe' => $email_employe,
        ]);
    }

    public function viewSelectPlaceStand()
    {
        $standData = [
            'nom_stand' => session('nom_stand'),
            'id_categorie' => session('id_categorie'),
            'description_stand' => session('description_stand'),
            'nom_categorie_stand' => session('nom_categorie_stand'),
            'date_debut' => session('date_debut'),
            'date_fin' => session('date_fin'),
            'img_stand_name' => session('img_stand_name'),
            'id_max_id_salon' => session('id_max_id_salon'),
            'nom_employe' => session('nom_employe'),
            'prenom_employe' => session('prenom_employe'),
            'date_naissance' => session('date_naissance'),
            'email_employe' => session('email_employe'),
        ];

        $getStandModel = new StandModel();
        //----ligne vertical gauche premier plan
        $placeTopLeftFistPlan = $getStandModel->getPlaceWherePlaceLeftToFirstPlan();
        //-------------------------------------
        //----Ligne horizontal bas premier plan
        $placeDownFirstPlan = $getStandModel->getPlaceWherePlaceDownFirstPlan();
        //------------------------------------
        //----ligne verticall droite premier plan
        $placeRightFirstPlan = $getStandModel->getPlaceWherePlaceRightFirstPlan();
        //----------------------------------------
        //------ligne horizontal haut di premier plan
        $placeUpFirstPlan = $getStandModel->getPlaceWherePlaceUpFirstPlan();
        //-------------------------------------------
        //-------ligne vertical gahce 2eme plan
        $placeGaucheVerticalSecondPlan = $getStandModel->getPlaceStandWherePlaceLeftSecondPlan();
        //--------------------------------------
        //-------ligne horizontal bas deuxieme plan
        $placeStandWherePlaceDownSecondPlan = $getStandModel->getPlaceStandWherePlaceDownSecondPlan();
        //------------------------------------------
        //ligne vertical droite deuxieme plan
        $placeStandWherePlaceRightSecondPlan = $getStandModel->getPlaceStandWherePlaceRightSecondPlan();
        //-----------------------------------
        //LIGNE HORIZONTAL HAUT DEUXIEME PLAN
        $placeWherePlaceUpSecondPlan = $getStandModel->getPlaceWherePlaceUpSecondPlan();
        //=----------------------------------
        //LIGNE VERTICAL TROISIEME PLAN
        $placeStandWherePlaceRightThirdPlan = $getStandModel->getPlaceStandWherePlaceRightThirdPlan();

        return view('home.SelectPlace',compact('placeTopLeftFistPlan','placeDownFirstPlan','placeRightFirstPlan',
        'placeUpFirstPlan','placeGaucheVerticalSecondPlan','placeStandWherePlaceDownSecondPlan',
        'placeStandWherePlaceRightSecondPlan','placeWherePlaceUpSecondPlan','placeStandWherePlaceRightThirdPlan'),$standData);
    }


    //information formulaire + enplacement de la place
    public function insertPemissionExposition(Request $request)
    {

        $getStandModel = new StandModel();

        //---- INFORMATION DANS LE FORMULAIRE -------
        $nom_stand = $request->nom_stand;
        $id_categorie = $request->id_categorie;
        $description_stand = $request->description_stand;
        $nom_categorie_stand = $request->nom_categorie_stand;
        $date_debut = $request->date_debut;
        $date_fin = $request->date_fin;
        $img_stand_name = $request->img_stand_name;
        $id_max_id_salon = $request->id_max_id_salon;
        $nom_employe = $request->nom_employe;
        $prenom_employe = $request->prenom_employe;
        $date_naissance = $request->date_naissance;
        $email_employe = $request->email_employe;
        //-----------------------------------------

        //------ id de place ----------
        $place_id = $request->place_id;
        //-----------------------------

        $getStandModel->insertPermissionStandV1($nom_stand,$id_categorie,
        $nom_categorie_stand,$description_stand,$nom_employe,$prenom_employe,
        $date_naissance,$email_employe,$img_stand_name,
        $date_debut,$date_fin,$id_max_id_salon,$place_id);

        //reservation de place
        $getStandModel->updateEtatPlaceToReserver($place_id);

        return redirect()->route('viewpermissionDeFaireUnStand')
        ->with('success', 'Le formulaire a été soumis avec succès !<br>Vous recevrez un e-mail
        une fois que l\'administrateur aura validé votre demande.');
    }


    public function storeVideo(Request $request)
    {
        $videoUrl = $request->input('videoUrl');

        // On stocke le lien dans la session pour l'afficher ensuite
        return redirect()->back()->with('videoUrl', $videoUrl);
    }


    public function download($fileName)
    {
        $filePath = public_path('assets/' . $fileName);

        if (file_exists($filePath)) {
            return response()->download($filePath);
        }

        return abort(404, 'Fichier non trouvé.');
    }


    public function viewGestionContenueHome(Request $request)
    {
        $id_stand = $request->id_stand;
        return view('home.gestionContenueHome',compact('id_stand'));
    }


    public function viewContenueVideo(Request $request)
    {
        $id_stand = $request->id_stand;
        $getStandModel = new StandModel();
        $videos = $getStandModel->getAllContenueVideo($id_stand);



        return view('home.ContenueVideo',compact('videos'));
    }



    public function getContenueStand(Request $request)
    {
        $id_stand = $request->id_stand;

        $getStandModel = new StandModel();
        $contenue = $getStandModel->viewInfoTypeStandByIdStand($id_stand);
        $stand = $getStandModel->viewModifierByEmp($id_stand);
        return view('home.ContenueDeStand',compact('contenue','stand'));
    }


    public function pdfDownload(Request $request)
    {
        $id_info_type_stand = $request->id_info_type_stand;

        $getStandModel = new StandModel();
        $fichier = $getStandModel->getFichierPdf($id_info_type_stand);


        if ($fichier !=null) {
            # code...
            $pdf = $getStandModel->downloadPdf($id_info_type_stand);
        }
        else{
            $error = 'Erreur vous de pouvez pas encore telecharger en ce moment';
            return redirect()->back()->withErrors(['error' => $error])->withInput();
        }

        // if ($fichier !=null) {
        //     # code...
        //     $getStandModel->downloadPdf($id_info_type_stand);
        //     return redirect()->route('getContenueStand')->with('success', 'Telecharger');

        // }else{
        //     $error = 'Erreur vous de pouvez pas encore telecharger en ce moment';
        //     return redirect()->back()->withErrors(['error' => $error])->withInput();
        // }
    }

    public function viewVideoConferenceHome()
    {
        $getVideoModel = new VideoModel();
        $videoConference =  $getVideoModel->viewVideoConference();
        return view('home.listVideoConference',compact('videoConference'));
    }

    public function listTemoignage()
    {
        $getTemoigange = new Temoignage();
        // $getAllTemoignage = $getTemoigange->getAllTemoignage();
        $getAllTemoignage = $getTemoigange->getTemoignageBySalon();
        return view('home.listTemoignage',compact('getAllTemoignage'));
    }


    public function verifyRemember(Request $request)
    {

    }

}
