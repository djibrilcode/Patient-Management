<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CheckRole
{
   public function handle(Request $request, Closure $next, ...$roles)
{
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    $user = Auth::user();
    
    // Debug: Afficher le rôle de l'utilisateur et les rôles attendus
    Log::info("User role: {$user->role}, Required roles: " . implode(', ', $roles));
    
    foreach ($roles as $role) {
        if ($user->role === $role) {
            return $next($request);
        }
    }

    // Si admin, on autorise tout
    if ($user->role === 'admin') {
        return $next($request);
    }

    abort(403, 'Accès non autorisé. Votre rôle: ' . $user->role);
}

}