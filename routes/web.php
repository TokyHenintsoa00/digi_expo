<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\EmpController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ResetDatabaseController;
use App\Http\Controllers\FacebookController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\testMongodbController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\DirecteurEmpController;
use App\Http\Controllers\NotificationChatController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
Route::get('/', function () {
    // return view('home.homePage');
    return redirect()->route('viewHomePage');
});
//------------------HOME----------------------------------------
Route::get('/homePage',[HomepageController::class,'viewHomePage'])->name('viewHomePage');
Route::get('/viewReception',[HomepageController::class,'viewReception'])->name('viewReception');
Route::get('/videoDirect',[HomepageController::class,'viewVideoDirect']);
Route::get('/viewDemandeAide',[HomepageController::class,'viewDemandeAide']);
Route::get('/viewpermissionDeFaireUnStand',[HomepageController::class,'viewPermissionDeFaireUnStand'])->name('viewpermissionDeFaireUnStand');
Route::post('/getInsertPermissionStandEmp',[HomePageController::class,'getInsertPermissionStandEmp'])->name('getInsertPermissionStandEmp');
Route::post('/storeVideo', [HomePageController::class, 'storeVideo'])->name('storeVideo');
Route::get('/viewGestionContenueHome', [HomePageController::class, 'viewGestionContenueHome'])->name('viewGestionContenueHome');
Route::get('/contenueStand', [HomePageController::class, 'getContenueStand'])->name('getContenueStand');
Route::get('/viewContenueVideo', [HomePageController::class, 'viewContenueVideo'])->name('viewContenueVideo');
Route::get('/videos/download/{fileName}', [HomePageController::class, 'download'])->name('video.download');
Route::post('/pdfDownload', [HomePageController::class, 'pdfDownload'])->name('pdfDownload');
Route::get('/viewVideoConferenceHome', [HomePageController::class, 'viewVideoConferenceHome'])->name('viewVideoConferenceHome');
Route::get('/listTemoignage', [HomePageController::class, 'listTemoignage'])->name('listTemoignage');
Route::get('/mongodb/insert', [TestMongodbController::class, 'insertData']);
Route::get('/mongodb/messages', [TestMongodbController::class, 'getMessages']);
//-----------------MESSAGE---------------------------------------------------------------------------------------------

Route::post('/send-message', [ChatController::class, 'sendMessage']);
Route::get('/fetch-messages/{sender_id}/{receiver_id}', [ChatController::class, 'fetchMessages']);
Route::post('/send-messageV1', [ChatController::class, 'sendMessageV1']);
Route::get('/fetch-messagesV1/{sender_id}/{receiver_id}', [ChatController::class, 'fetchMessagesV1']);
//------------------DIRECTEUR EMP-----------------------------------------------------------------------
Route::prefix('directeur')->group(function(){

    Route::get('/viewDirecteurEmpPage', function (Request $request) {
        if (!session()->has('id_emp')) {
            return redirect('/authentification')->with('error', 'Accès interdit !');
        }
        return app(DirecteurEmpController::class)->viewDirecteurEmpPage();
    })->name('viewDirecteurEmpPage');

    Route::get('/viewStandDirecteur', function (Request $request) {
        if (!session()->has('id_emp')) {
            return redirect('/authentification')->with('error', 'Accès interdit !');
        }
        return app(DirecteurEmpController::class)->viewStandDirecteur();
    })->name('viewStandDirecteur');

    //Route::get('/viewDirecteurEmpPage',[DirecteurEmpController::class, 'viewDirecteurEmpPage'])->name('viewDirecteurEmpPage');
    //Route::get('/viewStandDirecteur',[DirecteurEmpController::class,'viewStandDirecteur'])->name('viewStandDirecteur');
    Route::post('/publication',[DirecteurEmpController::class,'publication'])->name('publication');

    Route::get('/viewModifierStand', function (Request $request) {
        if (!session()->has('id_emp')) {
            return redirect('/authentification')->with('error', 'Accès interdit !');
        }
        return app(DirecteurEmpController::class)->viewModifierStand($request);
    })->name('viewModifierStand');

    //Route::get('/viewModifierStand',[DirecteurEmpController::class,'viewModifierStand'])->name('viewModifierStand');
    Route::post('/modifier',[DirecteurEmpController::class,'modifier'])->name('modifier');

    Route::get('/viewDemandeNouvelleStand', function (Request $request) {
        if (!session()->has('id_emp')) {
            return redirect('/authentification')->with('error', 'Accès interdit !');
        }
        return app(DirecteurEmpController::class)->viewDemandeNouvelleStand($request);
    })->name('viewDemandeNouvelleStand');

    //Route::get('/viewDemandeNouvelleStand',[DirecteurEmpController::class,'viewDemandeNouvelleStand'])->name('viewDemandeNouvelleStand');

    Route::get('/demandeStandEmp', function (Request $request) {
        if (!session()->has('id_emp')) {
            return redirect('/authentification')->with('error', 'Accès interdit !');
        }
        return app(DirecteurEmpController::class)->demandeStandEmp($request);
    })->name('demandeStandEmp');

    //Route::post('/demandeStandEmp',[DirecteurEmpController::class,'demandeStandEmp'])->name('demandeStandEmp');

    Route::get('/viewGestionPersonnel', function (Request $request) {
        if (!session()->has('id_emp')) {
            return redirect('/authentification')->with('error', 'Accès interdit !');
        }
        return app(DirecteurEmpController::class)->viewGestionPersonnel($request);
    })->name('viewGestionPersonnel');

    //Route::get('/viewGestionPersonnel',[DirecteurEmpController::class,'viewGestionPersonnel'])->name('viewGestionPersonnel');

    Route::get('/viewRecrutementEmp', function (Request $request) {
        if (!session()->has('id_emp')) {
            return redirect('/authentification')->with('error', 'Accès interdit !');
        }
        return app(DirecteurEmpController::class)->viewRecrutementEmp($request);
    })->name('viewRecrutementEmp');

    //Route::get('/viewRecrutementEmp',[DirecteurEmpController::class,'viewRecrutementEmp'])->name('viewRecrutementEmp');
    Route::post('/recrutementEmp',[DirecteurEmpController::class,'recrutementEmp'])->name('recrutementEmp');

    Route::get('/viewLicensimentEmployer', function (Request $request) {
        if (!session()->has('id_emp')) {
            return redirect('/authentification')->with('error', 'Accès interdit !');
        }
        return app(DirecteurEmpController::class)->viewLicensimentEmployer($request);
    })->name('viewLicensimentEmployer');

    //Route::get('/viewLicensimentEmployer',[DirecteurEmpController::class,'viewLicensimentEmployer'])->name('viewLicensimentEmployer');
    Route::post('/licensiment',[DirecteurEmpController::class,'licensiment'])->name('licensiment');

    Route::get('/viewGestionContenue', function (Request $request) {
        if (!session()->has('id_emp')) {
            return redirect('/authentification')->with('error', 'Accès interdit !');
        }
        return app(DirecteurEmpController::class)->viewGestionContenue($request);
    })->name('viewGestionContenue');

    //Route::get('/viewGestionContenue',[DirecteurEmpController::class,'viewGestionContenue'])->name('viewGestionContenue');

    Route::get('/viewformulaireAddPosterAndProjetEmp', function (Request $request) {
        if (!session()->has('id_emp')) {
            return redirect('/authentification')->with('error', 'Accès interdit !');
        }
        return app(DirecteurEmpController::class)->viewformulaireAddPosterAndProjetEmp($request);
    })->name('viewformulaireAddPosterAndProjetEmp');

    //Route::get('/viewformulaireAddPosterAndProjetEmp',[DirecteurEmpController::class,'viewformulaireAddPosterAndProjetEmp'])->name('viewformulaireAddPosterAndProjetEmp');
    Route::post('/AddPosterAndProjetEmp',[DirecteurEmpController::class,'AddPosterAndProjetEmp'])->name('AddPosterAndProjetEmp');

    Route::get('/viewModifierPosterProjet', function (Request $request) {
        if (!session()->has('id_emp')) {
            return redirect('/authentification')->with('error', 'Accès interdit !');
        }
        return app(DirecteurEmpController::class)->viewModifierPosterProjet($request);
    })->name('viewModifierPosterProjet');

    //Route::get('/viewModifierPosterProjet',[DirecteurEmpController::class,'viewModifierPosterProjet'])->name('viewModifierPosterProjet');

    Route::get('/viewformulaireModifierAddPosterAndProjetEmp', function (Request $request) {
        if (!session()->has('id_emp')) {
            return redirect('/authentification')->with('error', 'Accès interdit !');
        }
        return app(DirecteurEmpController::class)->viewformulaireModifierAddPosterAndProjetEmp($request);
    })->name('viewformulaireModifierAddPosterAndProjetEmp');

    //Route::get('/viewformulaireModifierAddPosterAndProjetEmp',[DirecteurEmpController::class,'viewformulaireModifierAddPosterAndProjetEmp'])->name('viewformulaireModifierAddPosterAndProjetEmp');
    Route::post('/modifierContenue',[DirecteurEmpController::class,'modifierContenue'])->name('modifierContenue');


    Route::get('/viewFormulaireAddVideo', function (Request $request) {
        if (!session()->has('id_emp')) {
            return redirect('/authentification')->with('error', 'Accès interdit !');
        }
        return app(DirecteurEmpController::class)->viewFormulaireAddVideo($request);
    })->name('viewFormulaireAddVideo');

    //Route::get('/viewFormulaireAddVideo',[DirecteurEmpController::class,'viewFormulaireAddVideo'])->name('viewFormulaireAddVideo');
    Route::post('/addVideo',[DirecteurEmpController::class,'addVideo'])->name('addVideo');

    Route::get('/viewModificationVideo', function (Request $request) {
        if (!session()->has('id_emp')) {
            return redirect('/authentification')->with('error', 'Accès interdit !');
        }
        return app(DirecteurEmpController::class)->viewModificationVideo($request);
    })->name('viewModificationVideo');

    //Route::get('/viewModificationVideo',[DirecteurEmpController::class,'viewModificationVideo'])->name('viewModificationVideo');

    Route::get('/viewFormulaireModificationVideo', function (Request $request) {
        if (!session()->has('id_emp')) {
            return redirect('/authentification')->with('error', 'Accès interdit !');
        }
        return app(DirecteurEmpController::class)->viewModificationVideo($request);
    })->name('viewFormulaireModificationVideo');

    //Route::get('/viewFormulaireModificationVideo',[DirecteurEmpController::class,'viewFormulaireModificationVideo'])->name('viewFormulaireModificationVideo');
    Route::post('/modificationVideo',[DirecteurEmpController::class,'modificationVideo'])->name('modificationVideo');

    Route::get('/viewGestionBrochure', function (Request $request) {
        if (!session()->has('id_emp')) {
            return redirect('/authentification')->with('error', 'Accès interdit !');
        }
        return app(DirecteurEmpController::class)->viewGestionBrochure($request);
    })->name('viewGestionBrochure');

    //Route::get('/viewGestionBrochure',[DirecteurEmpController::class,'viewGestionBrochure'])->name('viewGestionBrochure');


    Route::get('/viewChoixDeStandBrochure', function (Request $request) {
            if (!session()->has('id_emp')) {
                return redirect('/authentification')->with('error', 'Accès interdit !');
            }
            return app(DirecteurEmpController::class)->viewChoixDeStandBrochure($request);
        })->name('viewChoixDeStandBrochure');

    //Route::get('/viewChoixDeStandBrochure',[DirecteurEmpController::class,'viewChoixDeStandBrochure'])->name('viewChoixDeStandBrochure');


    Route::get('/viewChoixContenuePourBrochure', function (Request $request) {
        if (!session()->has('id_emp')) {
            return redirect('/authentification')->with('error', 'Accès interdit !');
        }
        return app(DirecteurEmpController::class)->viewChoixContenuePourBrochure($request);
    })->name('viewChoixContenuePourBrochure');

    //Route::get('/viewChoixContenuePourBrochure',[DirecteurEmpController::class,'viewChoixContenuePourBrochure'])->name('viewChoixContenuePourBrochure');

    Route::get('/viewFormulaireAjoutBrochure', function (Request $request) {
        if (!session()->has('id_emp')) {
            return redirect('/authentification')->with('error', 'Accès interdit !');
        }
        return app(DirecteurEmpController::class)->viewFormulaireAjoutBrochure($request);
    })->name('viewFormulaireAjoutBrochure');

    //Route::get('/viewFormulaireAjoutBrochure',[DirecteurEmpController::class,'viewFormulaireAjoutBrochure'])->name('viewFormulaireAjoutBrochure');
    Route::post('/publierBrochure',[DirecteurEmpController::class,'publierBrochure'])->name('publierBrochure');

    Route::get('/viewFormulaireDeModificationBrochure', function (Request $request) {
        if (!session()->has('id_emp')) {
            return redirect('/authentification')->with('error', 'Accès interdit !');
        }
        return app(DirecteurEmpController::class)->viewFormulaireDeModificationBrochure($request);
    })->name('viewFormulaireDeModificationBrochure');


    //Route::get('/viewFormulaireDeModificationBrochure',[DirecteurEmpController::class,'viewFormulaireDeModificationBrochure'])->name('viewFormulaireDeModificationBrochure');
    Route::post('/modificationBrochure',[DirecteurEmpController::class,'modificationBrochure'])->name('modificationBrochure');

    Route::get('/viewDemissionEmployer', function (Request $request) {
        if (!session()->has('id_emp')) {
            return redirect('/authentification')->with('error', 'Accès interdit !');
        }
        return app(DirecteurEmpController::class)->viewDemissionEmployer($request);
    })->name('viewDemissionEmployer');

    //Route::get('/viewDemissionEmployer',[DirecteurEmpController::class,'viewDemissionEmployer'])->name('viewDemissionEmployer');
    Route::post('/demissionEmployer',[DirecteurEmpController::class,'demissionEmployer'])->name('demissionEmployer');

    Route::get('/viewListEmpAndNombreEmpParStand', function (Request $request) {
        if (!session()->has('id_emp')) {
            return redirect('/authentification')->with('error', 'Accès interdit !');
        }
        return app(DirecteurEmpController::class)->viewListEmpAndNombreEmpParStand($request);
    })->name('viewListEmpAndNombreEmpParStand');

    //Route::get('/viewListEmpAndNombreEmpParStand',[DirecteurEmpController::class,'viewListEmpAndNombreEmpParStand'])->name('viewListEmpAndNombreEmpParStand');

    Route::get('/viewVideoConference', function (Request $request) {
        if (!session()->has('id_emp')) {
            return redirect('/authentification')->with('error', 'Accès interdit !');
        }
        return app(DirecteurEmpController::class)->viewVideoConference($request);
    })->name('viewVideoConference');

    //Route::get('/viewVideoConference',[DirecteurEmpController::class,'viewVideoConference'])->name('viewVideoConference');

    Route::get('/viewPlanificationVideoConference', function (Request $request) {
        if (!session()->has('id_emp')) {
            return redirect('/authentification')->with('error', 'Accès interdit !');
        }
        return app(DirecteurEmpController::class)->viewPlanificationVideoConference($request);
    })->name('viewPlanificationVideoConference');

    //Route::get('/viewPlanificationVideoConference',[DirecteurEmpController::class,'viewPlanificationVideoConference'])->name('viewPlanificationVideoConference');
    Route::post('/planificationVideoConference',[DirecteurEmpController::class,'planificationVideoConference'])->name('planificationVideoConference');

    Route::get('/viewModificationVideoConference', function (Request $request) {
        if (!session()->has('id_emp')) {
            return redirect('/authentification')->with('error', 'Accès interdit !');
        }
        return app(DirecteurEmpController::class)->viewModificationVideoConference($request);
    })->name('viewModificationVideoConference');

    //Route::get('/viewModificationVideoConference',[DirecteurEmpController::class,'viewModificationVideoConference'])->name('viewModificationVideoConference');

    Route::get('/viewFormulaireModificationVideoConference', function (Request $request) {
        if (!session()->has('id_emp')) {
            return redirect('/authentification')->with('error', 'Accès interdit !');
        }
        return app(DirecteurEmpController::class)->viewFormulaireModificationVideoConference($request);
    })->name('viewFormulaireModificationVideoConference');

    //Route::get('/viewFormulaireModificationVideoConference',[DirecteurEmpController::class,'viewFormulaireModificationVideoConference'])->name('viewFormulaireModificationVideoConference');
    Route::post('/modificationVideoConference',[DirecteurEmpController::class,'modificationVideoConference'])->name('modificationVideoConference');

    Route::get('/viewAddLinkVideo', function (Request $request) {
        if (!session()->has('id_emp')) {
            return redirect('/authentification')->with('error', 'Accès interdit !');
        }
        return app(DirecteurEmpController::class)->viewAddLinkVideo($request);
    })->name('viewAddLinkVideo');

    //Route::get('/viewAddLinkVideo',[DirecteurEmpController::class,'viewAddLinkVideo'])->name('viewAddLinkVideo');
    Route::post('/addLinkVideo',[DirecteurEmpController::class,'addLinkVideo'])->name('addLinkVideo');

    Route::get('/viewCalendrierSuivi', function (Request $request) {
        if (!session()->has('id_emp')) {
            return redirect('/authentification')->with('error', 'Accès interdit !');
        }
        return app(DirecteurEmpController::class)->viewCalendrierSuivi($request);
    })->name('viewCalendrierSuivi');

    //Route::get('/viewCalendrierSuivi',[DirecteurEmpController::class,'viewCalendrierSuivi'])->name('viewCalendrierSuivi');

    Route::get('/viewMessageDirecteur', function (Request $request) {
        if (!session()->has('id_emp')) {
            return redirect('/authentification')->with('error', 'Accès interdit !');
        }
        return app(DirecteurEmpController::class)->viewMessageDirecteur($request);
    })->name('viewMessageDirecteur');

    //Route::get('/viewMessageDirecteur',[DirecteurEmpController::class,'viewMessageDirecteur'])->name('viewMessageDirecteur');

    Route::get('/viewMessageSendOrReciveDirecteur', function (Request $request) {
        if (!session()->has('id_emp')) {
            return redirect('/authentification')->with('error', 'Accès interdit !');
        }
        return app(DirecteurEmpController::class)->viewMessageSendOrReciveDirecteur($request);
    })->name('viewMessageSendOrReciveDirecteur');

    //Route::get('/viewMessageSendOrReciveDirecteur',[DirecteurEmpController::class,'viewMessageSendOrReciveDirecteur'])->name('viewMessageSendOrReciveDirecteur');
    Route::post('/supprimerStand',[DirecteurEmpController::class,'supprimerStand'])->name('supprimerStand');

    Route::get('/viewTemoignage', function (Request $request) {
        if (!session()->has('id_emp')) {
            return redirect('/authentification')->with('error', 'Accès interdit !');
        }
        return app(DirecteurEmpController::class)->viewTemoignage($request);
    })->name('viewTemoignage');

    //Route::get('/viewTemoignage',[DirecteurEmpController::class,'viewTemoignage'])->name('viewTemoignage');

    Route::get('/viewPlanificationTemoignage', function (Request $request) {
        if (!session()->has('id_emp')) {
            return redirect('/authentification')->with('error', 'Accès interdit !');
        }
        return app(DirecteurEmpController::class)->viewPlanificationTemoignage($request);
    })->name('viewPlanificationTemoignage');

    //Route::get('/viewPlanificationTemoignage',[DirecteurEmpController::class,'viewPlanificationTemoignage'])->name('viewPlanificationTemoignage');
    Route::post('/insertTemoignage',[DirecteurEmpController::class,'insertTemoignage'])->name('insertTemoignage');

    Route::get('/viewInformationExposition', function (Request $request) {
        if (!session()->has('id_emp')) {
            return redirect('/authentification')->with('error', 'Accès interdit !');
        }
        return app(DirecteurEmpController::class)->viewInformationExposition($request);
    })->name('viewInformationExposition');

    //Route::get('/viewInformationExposition',[DirecteurEmpController::class,'viewInformationExposition'])->name('viewInformationExposition');

    Route::get('/viewConferenceClient', function (Request $request) {
        if (!session()->has('id_emp')) {
            return redirect('/authentification')->with('error', 'Accès interdit !');
        }
        return app(DirecteurEmpController::class)->viewConferenceClient($request);
    })->name('viewConferenceClient');

    //Route::get('/viewConferenceClient',[DirecteurEmpController::class,'viewConferenceClient'])->name('viewConferenceClient');

    Route::get('/viewJustificationDemissionEditeur', function (Request $request) {
        if (!session()->has('id_emp')) {
            return redirect('/authentification')->with('error', 'Accès interdit !');
        }
        return app(DirecteurEmpController::class)->viewJustificationDemissionEditeur($request);
    })->name('viewJustificationDemissionEditeur');

    //Route::get('/viewJustificationDemissionEditeur',[DirecteurEmpController::class,'viewJustificationDemissionEditeur'])->name('viewJustificationDemissionEditeur');

    Route::get('/viewGalerie', function (Request $request) {
        if (!session()->has('id_emp')) {
            return redirect('/authentification')->with('error', 'Accès interdit !');
        }
        return app(DirecteurEmpController::class)->viewGalerie($request);
    })->name('viewGalerie');

    //Route::get('/viewGalerie',[DirecteurEmpController::class,'viewGalerie'])->name('viewGalerie');
    Route::post('/planificationGallerie',[DirecteurEmpController::class,'planificationGallerie'])->name('planificationGallerie');
    Route::post('/ajoutDeReunion',[DirecteurEmpController::class,'ajoutDeReunion'])->name('ajoutDeReunion');

    Route::get('/viewListTemoignage', function (Request $request) {
        if (!session()->has('id_emp')) {
            return redirect('/authentification')->with('error', 'Accès interdit !');
        }
        return app(DirecteurEmpController::class)->viewListTemoignage($request);
    })->name('viewListTemoignage');


    //Route::get('/viewListTemoignage',[DirecteurEmpController::class,'viewListTemoignage'])->name('viewListTemoignage');


    Route::get('/viewModificationemoignage', function (Request $request) {
        if (!session()->has('id_emp')) {
            return redirect('/authentification')->with('error', 'Accès interdit !');
        }
        return app(DirecteurEmpController::class)->viewModificationemoignage($request);
    })->name('viewModificationemoignage');


    //Route::get('/viewModificationemoignage',[DirecteurEmpController::class,'viewModificationemoignage'])->name('viewModificationemoignage');

    Route::post('/modificationTemoignage',[DirecteurEmpController::class,'modificationTemoignage'])->name('modificationTemoignage');

    Route::get('/viewAjoutLiensTemoignage', function (Request $request) {
        if (!session()->has('id_emp')) {
            return redirect('/authentification')->with('error', 'Accès interdit !');
        }
        return app(DirecteurEmpController::class)->viewAjoutLiensTemoignage($request);
    })->name('viewAjoutLiensTemoignage');

    //Route::get('/viewAjoutLiensTemoignage',[DirecteurEmpController::class,'viewAjoutLiensTemoignage'])->name('viewAjoutLiensTemoignage');
    Route::post('/ajoutLiensTemoignage',[DirecteurEmpController::class,'ajoutLiensTemoignage'])->name('ajoutLiensTemoignage');

});
// -----------------Authentification--------------------------------------------------------------------------------

    Route::get('/authentification',[EmpController::class,'viewAuthentificationEmp'])->name('viewauthentificationEmp');
    Route::post('/signInEmp',[EmpController::class,'signInEmp']);
    Route::post('/getSignOutEmp',[EmpController::class,'getSignOutEmp'])->name('getSignOutEmp');
    Route::post('/signInEmpV1',[EmpController::class,'signInEmpV1'])->name('signInEmpV1');


// -----------------EMP--------------------------------------------------------------------------------
    Route::prefix('employer')->group(function(){

        Route::get('/viewEmpPage', function (Request $request) {
            if (!session()->has('id_emp')) {
                return redirect('/authentification')->with('error', 'Accès interdit !');
            }
            return app(EmpController::class)->viewEmpPage($request);
        })->name('viewEmpPage');

        Route::get('/viewStandEmp', function (Request $request) {
            if (!session()->has('id_emp')) {
                return redirect('/authentification')->with('error', 'Accès interdit !');
            }
            return app(EmpController::class)->viewStandEmp($request);
        })->name('viewStandEmp');

        Route::get('/viewGestionContenueEmp', function (Request $request) {
            if (!session()->has('id_emp')) {
                return redirect('/authentification')->with('error', 'Accès interdit !');
            }
            return app(EmpController::class)->viewGestionContenue($request);
        })->name('viewGestionContenueEmp');


        Route::get('/viewformulaireAddPosterAndProjet', function (Request $request) {
            if (!session()->has('id_emp')) {
                return redirect('/authentification')->with('error', 'Accès interdit !');
            }
            return app(EmpController::class)->viewformulaireAddPosterAndProjet($request);
        })->name('viewformulaireAddPosterAndProjet');

        Route::post('/AddPosterAndProjet',[EmpController::class,'AddPosterAndProjet'])->name('AddPosterAndProjet');

        Route::get('/viewGestionBrochureEmp', function (Request $request) {
            if (!session()->has('id_emp')) {
                return redirect('/authentification')->with('error', 'Accès interdit !');
            }
            return app(EmpController::class)->viewGestionBrochure($request);
        })->name('viewGestionBrochureEmp');

        Route::get('/viewChoixDeStandBrochureEmp', function (Request $request) {
            if (!session()->has('id_emp')) {
                return redirect('/authentification')->with('error', 'Accès interdit !');
            }
            return app(EmpController::class)->viewChoixDeStandBrochureEmp($request);
        })->name('viewChoixDeStandBrochureEmp');

        Route::get('/viewChoixContenuePourBrochureEmp', function (Request $request) {
            if (!session()->has('id_emp')) {
                return redirect('/authentification')->with('error', 'Accès interdit !');
            }
            return app(EmpController::class)->viewChoixContenuePourBrochureEmp($request);
        })->name('viewChoixContenuePourBrochureEmp');

        Route::get('/viewFormulaireAjoutBrochureEmp', function (Request $request) {
            if (!session()->has('id_emp')) {
                return redirect('/authentification')->with('error', 'Accès interdit !');
            }
            return app(EmpController::class)->viewFormulaireAjoutBrochureEmp($request);
        })->name('viewFormulaireAjoutBrochureEmp');

        Route::post('/publierBrochureEmp',[EmpController::class,'publierBrochureEmp'])->name('publierBrochureEmp');


        Route::get('/viewPermissionDemissionEmp', function (Request $request) {
            if (!session()->has('id_emp')) {
                return redirect('/authentification')->with('error', 'Accès interdit !');
            }
            return app(EmpController::class)->viewPermissionDemissionEmp($request);
        })->name('viewPermissionDemissionEmp');

        Route::post('/permissionDemission',[EmpController::class,'permissionDemission'])->name('permissionDemission');

        Route::get('/viewMessageEmp', function (Request $request) {
            if (!session()->has('id_emp')) {
                return redirect('/authentification')->with('error', 'Accès interdit !');
            }
            return app(EmpController::class)->viewMessageEmp($request);
        })->name('viewMessageEmp');

        Route::get('/viewMessageSendOrReciveEmp', function (Request $request) {
            if (!session()->has('id_emp')) {
                return redirect('/authentification')->with('error', 'Accès interdit !');
            }
            return app(EmpController::class)->viewMessageSendOrReciveEmp($request);
        })->name('viewMessageSendOrReciveEmp');

        Route::get('/viewformulaireAddVideoEmpSection', function (Request $request) {
            if (!session()->has('id_emp')) {
                return redirect('/authentification')->with('error', 'Accès interdit !');
            }
            return app(EmpController::class)->viewformulaireAddVideoEmpSection($request);
        })->name('viewformulaireAddVideoEmpSection');

        //Route::get('/viewEmpPage',[EmpController::class,'viewEmpPage'])->name('viewEmpPage');
        //Route::get('/viewStandEmp',[EmpController::class,'viewStandEmp'])->name('viewStandEmp');
        //Route::get('/viewGestionContenueEmp',[EmpController::class,'viewGestionContenue'])->name('viewGestionContenueEmp');
        //Route::get('/viewformulaireAddPosterAndProjet',[EmpController::class,'viewformulaireAddPosterAndProjet'])->name('viewformulaireAddPosterAndProjet');
        //Route::get('/viewGestionBrochureEmp',[EmpController::class,'viewGestionBrochure'])->name('viewGestionBrochureEmp');
        //Route::get('/viewChoixDeStandBrochureEmp',[EmpController::class,'viewChoixDeStandBrochureEmp'])->name('viewChoixDeStandBrochureEmp');
        //Route::get('/viewChoixContenuePourBrochureEmp',[EmpController::class,'viewChoixContenuePourBrochureEmp'])->name('viewChoixContenuePourBrochureEmp');
        //Route::get('/viewFormulaireAjoutBrochureEmp',[EmpController::class,'viewFormulaireAjoutBrochureEmp'])->name('viewFormulaireAjoutBrochureEmp');
        //Route::get('/viewPermissionDemissionEmp',[EmpController::class,'viewPermissionDemissionEmp'])->name('viewPermissionDemissionEmp');
        //Route::get('/viewMessageEmp',[EmpController::class,'viewMessageEmp'])->name('viewMessageEmp');
        //Route::get('/viewMessageSendOrReciveEmp',[EmpController::class,'viewMessageSendOrReciveEmp'])->name('viewMessageSendOrReciveEmp');
        //Route::get('/viewformulaireAddVideoEmpSection',[EmpController::class,'viewformulaireAddVideoEmpSection'])->name('viewformulaireAddVideoEmpSection');
        Route::post('/addVideoEmp',[EmpController::class,'addVideoEmp'])->name('addVideoEmp');

    });
//-------------------ADMIN-------------------------------------------------------------------------------

    Route::get('/viewAuthentificationAdmin',[AdminController::class,'viewAuthentificationAdmin'])->name('viewAuthentificationAdmin');
    Route::get('/getSignInAdmin',[AdminController::class,'getSignInAdmin']);
    Route::get('/getSignOutAdmin',[AdminController::class,'getSignOutAdmin']);

    Route::prefix("admin")->group(function(){

        Route::get('/viewCreationSalonAdmin', function (Request $request) {
            if (!session()->has('id')) {
                return redirect('/viewAuthentificationAdmin')->with('error', 'Accès interdit !');
            }
            return app(AdminController::class)->viewCreationSalonAdmin($request);
            })->name('viewCreationSalonAdmin');

        Route::post('/creationSalonV1',[AdminController::class,'creationSalonV2'])->name('creationSalonV1');

        Route::get('/viewAdminPage', function (Request $request) {
            if (!session()->has('id')) {
                return redirect('/viewAuthentificationAdmin')->with('error', 'Accès interdit !');
            }
            return app(AdminController::class)->viewAdminPage($request);
        })->name('viewAdminPage');

        Route::get('/viewValidationPermissionStand', function (Request $request) {
            if (!session()->has('id')) {
                return redirect('/viewAuthentificationAdmin')->with('error', 'Accès interdit !');
            }
            return app(AdminController::class)->viewValidationPermissionStand($request);
        })->name('viewValidationPermissionStand');

        //--------Stand
        Route::post('/validePermissionByAdmin',[AdminController::class,'validePermissionByAdmin'])->name('validePermissionByAdmin');
        Route::post('/refusePermissiontandByAdmin',[AdminController::class,'refusePermissiontandByAdmin']);


        Route::get('/viewValidationRecrutementEmp', function (Request $request) {
            if (!session()->has('id')) {
                return redirect('/viewAuthentificationAdmin')->with('error', 'Accès interdit !');
            }
            return app(AdminController::class)->viewValidationRecrutementEmp($request);
        })->name('viewValidationRecrutementEmp');

        Route::post('/validationRecrutement',[AdminController::class,'validationRecrutement'])->name('validationRecrutement');
        Route::post('/refusDeRecrutement',[AdminController::class,'refusDeRecrutement'])->name('refusDeRecrutement');

        Route::get('/viewGestionPersonnelByAdmin', function (Request $request) {
            if (!session()->has('id')) {
                return redirect('/viewAuthentificationAdmin')->with('error', 'Accès interdit !');
            }
            return app(AdminController::class)->viewGestionPersonnelByAdmin($request);
        })->name('viewGestionPersonnelByAdmin');

        Route::get('/viewLicensimentEmpByAdmin', function (Request $request) {
            if (!session()->has('id')) {
                return redirect('/viewAuthentificationAdmin')->with('error', 'Accès interdit !');
            }
            return app(AdminController::class)->viewLicensimentEmpByAdmin($request);
        })->name('viewLicensimentEmpByAdmin');


        Route::get('/viewPromouvoirEmpEnDirecteur', function (Request $request) {
            if (!session()->has('id')) {
                return redirect('/viewAuthentificationAdmin')->with('error', 'Accès interdit !');
            }
            return app(AdminController::class)->viewPromouvoirEmpEnDirecteur($request);
        })->name('viewPromouvoirEmpEnDirecteur');

        Route::post('/licensimentDirecteurByAdmin',[AdminController::class,'licensimentDirecteurByAdmin'])->name('licensimentDirecteurByAdmin');
        Route::post('/licensimentEmployerByAdmin',[AdminController::class,'licensimentEmployerByAdmin'])->name('licensimentEmployerByAdmin');

        Route::get('/viewListStandAndEmpAndNombreStand', function (Request $request) {
            if (!session()->has('id')) {
                return redirect('/viewAuthentificationAdmin')->with('error', 'Accès interdit !');
            }
            return app(AdminController::class)->viewListStandAndEmpAndNombreStand($request);
        })->name('viewListStandAndEmpAndNombreStand');


        Route::get('/viewInfoStand', function (Request $request) {
            if (!session()->has('id')) {
                return redirect('/viewAuthentificationAdmin')->with('error', 'Accès interdit !');
            }
            return app(AdminController::class)->viewInfoStand($request);
        })->name('viewInfoStand');

        Route::get('/viewListMembreStand', function (Request $request) {
            if (!session()->has('id')) {
                return redirect('/viewAuthentificationAdmin')->with('error', 'Accès interdit !');
            }
            return app(AdminController::class)->viewListMembreStand($request);
        })->name('viewListMembreStand');

        Route::get('/viewCalendrierSuiviAdmin', function (Request $request) {
            if (!session()->has('id')) {
                return redirect('/viewAuthentificationAdmin')->with('error', 'Accès interdit !');
            }
            return app(AdminController::class)->viewCalendrierSuiviAdmin($request);
        })->name('viewCalendrierSuiviAdmin');


        Route::get('/dasboardAdmin', function (Request $request) {
            if (!session()->has('id')) {
                return redirect('/viewAuthentificationAdmin')->with('error', 'Accès interdit !');
            }
            return app(AdminController::class)->dasboardAdmin($request);
        })->name('dasboardAdmin');

            //Route::get('/dasboardAdmin',[AdminController::class,'dasboardAdmin'])->name('dasboardAdmin');

        Route::get('/admin/dashboard/data', function (Request $request) {
            if (!session()->has('id')) {
                return redirect('/viewAuthentificationAdmin')->with('error', 'Accès interdit !');
            }
            return app(AdminController::class)->fetchDashboardData($request);
        });

        //Route::get('/admin/dashboard/data', [AdminController::class, 'fetchDashboardData']);

        //DONNEE DE STAND DURANT L'ANNEE
        Route::get('/get-data-by-year', function (Request $request) {
            if (!session()->has('id')) {
                return redirect('/viewAuthentificationAdmin')->with('error', 'Accès interdit !');
            }
            return app(AdminController::class)->getDataByYear($request);
        })->name('get.data.by.year');

        //Route::get('/get-data-by-year', [AdminController::class, 'getDataByYear'])->name('get.data.by.year');

        Route::get('/get-data-user-by-year', function (Request $request) {
            if (!session()->has('id')) {
                return redirect('/viewAuthentificationAdmin')->with('error', 'Accès interdit !');
            }
            return app(AdminController::class)->getDataUtilisateur($request);
        })->name('get.data.user.by.year');

        //Route::get('/get-data-user-by-year', [AdminController::class, 'getDataUtilisateur'])->name('get.data.user.by.year');

        Route::get('/get-data-mvt-by-year', function (Request $request) {
            if (!session()->has('id')) {
                return redirect('/viewAuthentificationAdmin')->with('error', 'Accès interdit !');
            }
            return app(AdminController::class)->getMouvementPersonnel($request);
        })->name('get.data.mvt.by.year');

            //Route::get('/get-data-mvt-by-year', [AdminController::class, 'getMouvementPersonnel'])->name('get.data.mvt.by.year');

        Route::get('/get-data-video-contenue-by-year', function (Request $request) {
            if (!session()->has('id')) {
                return redirect('/viewAuthentificationAdmin')->with('error', 'Accès interdit !');
            }
            return app(AdminController::class)->getVideoContenueVideo($request);
        })->name('get.data.video-contenue.by.year');

            //Route::get('/get-data-video-contenue-by-year', [AdminController::class, 'getVideoContenueVideo'])->name('get.data.video-contenue.by.year');

        Route::get('/get-data-photo-contenue-by-year', function (Request $request) {
            if (!session()->has('id')) {
                return redirect('/viewAuthentificationAdmin')->with('error', 'Accès interdit !');
            }
            return app(AdminController::class)->getContenuePhoto($request);
        })->name('get.data.photo-contenue.by.year');

    });




    //Route::get('/viewCreationSalonAdmin',[AdminController::class,'viewCreationSalonAdmin'])->name('viewCreationSalonAdmin');
    //Route::post('/creationSalon',[AdminController::class,'creationSalon'])->name('creationSalon');

    // Route::get('/viewValidationPermissionStand', function (Request $request) {
    //     if (!session()->has('id')) {
    //         return redirect('/viewAuthentificationAdmin')->with('error', 'Accès interdit !');
    //     }
    //     return app(AdminController::class)->viewValidationPermissionStand($request);
    // })->name('viewValidationPermissionStand');

    //Route::get('/viewValidationPermissionStand',[AdminController::class,'viewValidationPermissionStand'])->name('viewValidationPermissionStand');

    //Route::get('/viewLicensimentEmpByAdmin',[AdminController::class,'viewLicensimentEmpByAdmin'])->name('viewLicensimentEmpByAdmin');




        //Route::get('/viewPromouvoirEmpEnDirecteur',[AdminController::class,'viewPromouvoirEmpEnDirecteur'])->name('viewPromouvoirEmpEnDirecteur');



        //Route::get('/viewListStandAndEmpAndNombreStand',[AdminController::class,'viewListStandAndEmpAndNombreStand'])->name('viewListStandAndEmpAndNombreStand');



        //Route::get('/viewInfoStand',[AdminController::class,'viewInfoStand'])->name('viewInfoStand');



        //Route::get('/viewListMembreStand',[AdminController::class,'viewListMembreStand'])->name('viewListMembreStand');


        //Route::get('/viewCalendrierSuiviAdmin',[AdminController::class,'viewCalendrierSuiviAdmin'])->name('viewCalendrierSuiviAdmin');



        //Route::get('/get-data-photo-contenue-by-year', [AdminController::class, 'getContenuePhoto'])->name('get.data.photo-contenue.by.year');
        Route::post('/search',[AdminController::class,'search'])->name('search');
//----------------------RESET DATABASE----------------------------------------------------------------------------
Route::get('/reset',[ResetDatabaseController::class,'reset']);
//------------------FACEBOOK---------------------------------------------------------------------
Route::get('/viewAuthentificationAdmin/facebook',[FacebookController::class,'facebookPage']);
Route::get('/viewAuthentificationAdmin/facebook/callback',[FacebookController::class,'facebookRedirect']);
//---------------------RESET PASSWORD-------------------------------------------------------
Route::get('/forgotPassword', [AdminController::class, 'viewForgotPassword'])->name('forgotPassword');
Route::post('/sendResetLink', [AdminController::class, 'sendResetLink'])->name('sendResetLink');
Route::get('/viewResetPassword/{token}', [AdminController::class, 'viewResetPassword'])->name('resetPassword');
Route::post('/resetPassword', [AdminController::class, 'resetPassword'])->name('updatePassword');
//---------------------------Notification-------------------------------------
Route::get('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
// Route::post('/createNotificationMessageDirecteurToEmp', [NotificationController::class, 'createNotificationMessageDirecteurToEmp'])->name('createNotificationMessageDirecteurToEmp');
// Route::post('/createNotificationMessageEmpToEmp', [NotificationController::class, 'createNotificationMessageEmpToEmp'])->name('createNotificationMessageEmpToEmp');
// Route::post('/createNotificationMessageEmpToDirecteur', [NotificationController::class, 'createNotificationMessageEmpToDirecteur'])->name('createNotificationMessageEmpToDirecteur');
//-----------------------------Notification Message------------------------------
Route::post('/createNotificationMessageDirecteurToEmp', [NotificationChatController::class, 'createNotificationMessageDirecteurToEmp'])->name('createNotificationMessageDirecteurToEmp');
Route::post('/createNotificationMessageEmpToEmp', [NotificationChatController::class, 'createNotificationMessageEmpToEmp'])->name('createNotificationMessageEmpToEmp');
Route::post('/createNotificationMessageEmpToDirecteur', [NotificationChatController::class, 'createNotificationMessageEmpToDirecteur'])->name('createNotificationMessageEmpToDirecteur');
//--------------------------------------------------------------------------------

Route::get('/directeur/viewMessageSendOrReciveDirecteur?nom_emp={nom_emp}&prenom_emp={prenom_emp}&id_emp={id_emp}&id_directeur={id_directeur}&nom_dir={nom_directeur}&prenom_dir={prenom_directeur}&etat_dir={etat_directeur}', [NotificationChatController::class, 'viewChatEmpToDIr'])
->name('chat.employeeToDirector');

    // Route::get('/notificationsChat/{id}/read', [NotificationChatController::class, 'markAsRead'])->name('notifications.markAsReadChat');

Route::get('/employer/viewMessageSendOrReciveEmp?nom={nom}&prenom={prenom}&id={id}&etat={etat}', [NotificationChatController::class, 'viewChatEmpToDIr'])
->name('chat.employeeToEmploye');


//---------------------------------------------------------------------------------------------
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/test-email', function () {
    Mail::raw('Ceci est un test avec Brevo SMTP.', function ($message) {
        $message->to('tokyramanalinarivo16@gmail.com')
                ->subject('Test e-mail Brevo');
    });

    return 'E-mail envoyé avec succès !';
});

Route::get('/test-image', function () {
    $img = Image::canvas(800, 600, '#ccc'); // Crée une image vide
    return $img->response('jpg');
});

Route::post('/events', [EventController::class, 'store'])->name('storeEvent'); // Pour enregistrer un événement
Route::post('/events/delete', [EventController::class, 'delete'])->name('deleteEvent'); // Pour supprimer un événement
Route::get('/calendar', [EventController::class, 'index'])->name('calendar.index');
Route::post('/update-event', [EventController::class, 'update'])->name('updateEvent');

require __DIR__.'/auth.php';
