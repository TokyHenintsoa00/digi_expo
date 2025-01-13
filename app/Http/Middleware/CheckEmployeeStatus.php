<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckEmployeeStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Vérifiez si l'utilisateur est authentifié
        if (Auth::check()) {
            // Récupérez l'utilisateur actuel
            $user = Auth::user();

            // Vérifiez si l'état est différent de 2
            if ($user->id_etat != 2) {
                // Rediriger ou retourner une erreur
                return redirect()->route('home')->with('error', 'Accès interdit : statut d\'employé non valide.');
            }

            return $next($request);
        }

        return redirect()->route('login')->with('error', 'Vous devez être connecté pour accéder à cette page.');
    }
}
