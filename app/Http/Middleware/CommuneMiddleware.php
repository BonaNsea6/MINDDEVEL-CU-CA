<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate; // Ajout de l'importation de Gate
use Symfony\Component\HttpFoundation\Response;

class CommuneMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(Gate::allows("commune")){
            return $next($request);
        }
        return redirect()->route("home");
    }
}
