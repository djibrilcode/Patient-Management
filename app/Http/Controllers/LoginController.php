<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        if (auth()->check()) {
            return $this->redirectByRole(auth()->user()->role);
        }
        
        return view('login');
    }

    public function doLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
            return $this->redirectByRole(Auth::user()->role)
                ->with('success', 'Connexion réussie.');
        }

        return back()->withErrors([
            'email' => 'Identifiants incorrects.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Déconnexion réussie.');
    }

    private function redirectByRole($role)
    {
        return match ($role) {
            'admin' => redirect()->route('dashboard.index'),
            'secretaire' => redirect()->route('rendezvous.index'),
            'medecin' => redirect()->route('consultations.index'),
            default => redirect('/login'),
        };
    }
}
