<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate; // Ajout de l'importation de Gate
use Symfony\Component\HttpFoundation\Response;

class CarMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Utilisation du Gate pour vérifier l'autorisation
        if (Gate::allows("car")) {
            return $next($request);
        }

        // Redirection si l'utilisateur n'est pas autorisé
        return redirect()->route("home");
    }
}
