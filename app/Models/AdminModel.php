<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
class AdminModel extends Model
{
    use HasFactory;

    // Indiquer la table associée si ce n'est pas le nom par défaut
    protected $table = 'admin';

    // Indiquer les champs qui peuvent être remplis
    protected $fillable = [
        'id_facebook', 'nom', 'prenom', 'email', 'pwd_admin', 'id_etat'
    ];

    //function se signIn de l'admin(Se connection est avec facebook)
    //NE PAS TOUCHER CETTE FONCTION
    //-------------------------------
    public function signInAdmin($email,$pwd)
    {
         return $result = DB::select("SELECT * FROM admin Where email=? and pwd_admin=?",[$email,$pwd]);
    }
    //---------------------------------------

    //cette fonction va prendre l'email de admin pour LE FORMULAIRE
    public function getAuthAdminFirst($email)
    {
        $request = DB::table('admin')->where('email', $email)->first();
        return $request;
    }

    public function signInAdminByFormulaire($email, $pwd,$remember)
    {

        $admin = $getAuthAdminFirst = $this->getAuthAdminFirst($email);

        if($admin == null)
        {
            return redirect()->back()->withErrors(['error' => 'Mail invalide.'])->withInput();
        }

        //si le mdp n'est pas hache(Tsy crypter ilay mdp)
        if(Hash::needsRehash($admin->pwd_admin))
        {
            // Si "remember me" est coché
            if ($remember ==TRUE) {
                // Créer un cookie pour se souvenir de l'utilisateur pendant 7 jours
                Cookie::queue('remember_admin', $admin->id, 60 * 24 * 7); // 7 jours
            }
            return $admin;
        }
        else{
            // Vérifier si l'administrateur existe et comparer le mot de passe haché
            if ($admin && Hash::check($pwd, $admin->pwd_admin)) {

                // Si "remember me" est coché
                if ($remember ==TRUE) {
                    // Créer un cookie pour se souvenir de l'utilisateur pendant 7 jours
                    Cookie::queue('remember_admin', $admin->id, 60 * 24 * 7); // 7 jours
                }
                return $admin; // ou vous pouvez retourner d'autres informations selon vos besoins
            }
        }
        return null; // ou gérer le cas où l'authentification échoue
    }

     // Fonction pour vérifier si un utilisateur est "remembered"
     public function checkRememberedAdmin()
     {
         $adminId = Cookie::get('remember_admin');

         if ($adminId) {
             // Récupérer l'administrateur à partir de l'ID stocké dans le cookie
             return DB::table('admin')->where('id', $adminId)->first();
         }

         return null;
     }



}
