<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class LoginController extends Controller
{
    // Affiche le formulaire de connexion
    public function login()
    {
        if (auth()->check()) {
            return $this->redirectByRole(auth()->user()->role);
        }

        return view('login');
    }

    // Traite le formulaire de connexion
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

    // Déconnexion
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Déconnexion réussie.');
    }

    // Redirection en fonction du rôle
    private function redirectByRole($role)
    {
        return match ($role) {
            'admin' => redirect()->route('dashboard.index'),
            'secretaire' => redirect()->route('rendezvous.index'),
            'medecin' => redirect()->route('consultations.index'),
            default => redirect('/login'),
        };
    }

    // 🔐 Affiche le formulaire "mot de passe oublié"
    public function showForgotPasswordForm()
    {
        return view('auth.forgot-password');
    }

    // 🔐 Envoie le lien de réinitialisation
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);

        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }

    // 🔐 Affiche le formulaire de réinitialisation du mot de passe
    public function showResetForm($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    // 🔐 Traite la réinitialisation du mot de passe
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'confirmed'],
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}
