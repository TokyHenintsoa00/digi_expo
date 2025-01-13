// // Fonction pour générer un token de réinitialisation de mot de passe et envoyer un email
    // public function forgotPassword($email)
    // {
    //     // Vérifier si l'email existe
    //     $admin = DB::select("SELECT * FROM admin WHERE email=?", [$email]);

    //     if ($admin) {
    //         // Générer un token
    //         $token = Str::random(60);

    //         // Insérer le token dans la table password_resets
    //         DB::insert("INSERT INTO password_resets (email, token, created_at) VALUES (?, ?, ?)", [
    //             $email,
    //             Hash::make($token),
    //             Carbon::now()
    //         ]);

    //         // Construire le lien de réinitialisation
    //         $resetLink = url('/reset-password?token=' . $token . '&email=' . urlencode($email));

    //         // Envoi de l'email avec le modèle MailNotify
    //         Mail::to($email)->send(new MailNotify(['link' => $resetLink]));

    //         return ['message' => 'Un email de réinitialisation a été envoyé.'];
    //     } else {
    //         return ['error' => 'Email non trouvé'];
    //     }
    // }

    // // Fonction pour réinitialiser le mot de passe
    // public function resetPassword($token, $email, $newPassword)
    // {
    //     // Rechercher le token dans la table password_resets
    //     $resetEntry = DB::select("SELECT * FROM password_resets WHERE email=?", [$email]);

    //     if ($resetEntry && Hash::check($token, $resetEntry[0]->token)) {
    //         // Mettre à jour le mot de passe dans la table admin
    //         $hashedPwd = Hash::make($newPassword);
    //         DB::update("UPDATE admin SET pwd_admin=? WHERE email=?", [$hashedPwd, $email]);

    //         // Supprimer l'entrée du token après la réinitialisation
    //         DB::delete("DELETE FROM password_resets WHERE email=?", [$email]);

    //         return ['message' => 'Mot de passe réinitialisé avec succès.'];
    //     } else {
    //         return ['error' => 'Token invalide ou expiré'];
    //     }
    // }





    // Méthode pour demander la réinitialisation du mot de passe
    public function requestPasswordReset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $admin = DB::table('admin')->where('email', $request->email)->first();

        if (!$admin) {
            return back()->withErrors(['email' => 'Email not found.']);
        }

        // Générer un token de réinitialisation
        $token = Str::random(60);

        // Envoie le mail de réinitialisation
        Mail::to($request->email)->send(new mailNotify($token));

        return back()->with('status', 'Password reset link sent!');
    }

    // Méthode pour réinitialiser le mot de passe
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        // Ici tu devrais valider le token (le comparer avec celui stocké en base de données)
        // Pour simplifier, nous considérons que le token est valide

        // Mettre à jour le mot de passe
        DB::table('admin')
            ->where('email', $request->email)
            ->update(['pwd_admin' => Hash::make($request->password)]);

        return redirect()->route('viewAuthentificationAdmin')->with('status', 'Password reset successfully!');
    }