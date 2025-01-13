<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\AdminModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str; // Assurez-vous d'importer Str
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cookie;

use Exception;

class FacebookController extends Controller
{
    // Redirection vers Facebook pour l'authentification
    public function facebookPage()
    {
        return Socialite::driver('facebook')
                        ->scopes(['email']) // Demande explicitement l'autorisation 'email'
                        ->redirect();
    }


    public function facebookRedirect()
    {
        try {
            // Récupérer les informations de l'utilisateur via Facebook
            $facebookUser = Socialite::driver('facebook')->stateless()->user();

            // Vérifier que l'email est disponible
            if (!$facebookUser->email) {
                throw new Exception("Permission d'email requise.");
            }

            // Vérifier si l'utilisateur existe déjà dans la base de données
            $existingUser = AdminModel::where('id_facebook', $facebookUser->id)->first();

            if ($existingUser) {
                // Connexion de l'utilisateur existant via la méthode signInAdmin
                $result = (new AdminModel())->signInAdmin($existingUser->email, $existingUser->pwd_admin);

                if (empty($result)) {
                    throw new Exception('Échec de la connexion de l\'utilisateur existant.');
                }

                // Si la connexion réussit, sauvegarder l'utilisateur en session
                Session::put('admin', $result[0]);
                Cookie::queue('remember_admin', $result[0]->id, 60 * 24 * 7); // 7 jours
                // Affichage des données pour vérification
                // dd('Utilisateur connecté', $existingUser);
                return redirect()->route('viewAdminPage');

            } else {
                // Extraire le prénom du nom complet (si Facebook ne fournit pas de champ first_name)
                $fullName = explode(' ', $facebookUser->name);
                $prenom = isset($fullName[1]) ? $fullName[1] : $fullName[0]; // Utiliser la deuxième partie comme prénom (si disponible)

                // Générer un mot de passe sécurisé (car Facebook ne fournit pas le mot de passe)
                $motDePasse = Str::random(10); // Générer un mot de passe aléatoire

                // Création d'un nouvel utilisateur administrateur
                $newUserData = [
                    'id_facebook' => $facebookUser->id,
                    'nom' => $fullName[0], // Le premier nom est utilisé comme nom de famille
                    'prenom' => $prenom, // Prénom extrait du nom complet
                    'email' => $facebookUser->email,
                    'pwd_admin' => bcrypt($motDePasse), // Hasher le mot de passe généré
                    'id_etat' => 1 // Statut par défaut
                ];

                // Enregistrement du nouvel administrateur
                $newUser = AdminModel::create($newUserData);

                // Envoyer l'email avec les informations de connexion via Brevo
                Mail::send('emails.password', [
                    'prenom' => $newUser->prenom,
                    'email' => $newUser->email,
                    'password' => $motDePasse
                ], function ($message) use ($newUser) {
                    $message->to($newUser->email)
                            ->subject('Votre nouveau compte administrateur');
                });

                // Connexion du nouvel utilisateur via la méthode signInAdmin
                $result = (new AdminModel())->signInAdmin($newUser->email, $newUser->pwd_admin);

                if (empty($result)) {
                    throw new Exception('Échec de la connexion pour le nouvel utilisateur.');
                }

                // Si la connexion réussit, sauvegarder l'utilisateur en session
                Session::put('admin', $result[0]);
                Cookie::queue('remember_admin', $result[0]->id, 60 * 24 * 7); // 7 jours

                // Affichage des données pour vérification
                // dd('Nouvel utilisateur enregistré et connecté', $newUser);
                return redirect()->route('viewAdminPage');
            }

        } catch (Exception $e) {
            // Afficher l'exception sans redirection
            dd('Erreur détectée :', $e->getMessage());
        }
    }


}
