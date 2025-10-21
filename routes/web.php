<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AccueilController,
    LoginController,
    DashboardController,
    UserController,
    MedecinController,
    PatientController,
    RendezvousController,
    ConsultationController,
    FactureController,
    SpecialiteController,
    MedicamentController,
    PrescriptionController,
    OrdonnanceController,
    DossiersMedicauxController,
    DocumentsPatientController,
    ReglementController,
};

/*
|--------------------------------------------------------------------------
| Routes publiques (pas besoin d’être connecté)
|--------------------------------------------------------------------------
*/

// Page d’accueil
Route::get('/', [AccueilController::class, 'index'])->name('accueil');

// Pages statiques
Route::view('/contact', 'contact')->name('contact');
Route::view('/apropos', 'about')->name('about');

// API simple ou contenu AJAX
Route::get('/content', function () {
    return response()->json([
        'html' => '<h3>Contenu chargé depuis Laravel !</h3><p>Pas besoin de recharger toute la page.</p>'
    ]);
});

// Calendrier rendez-vous
Route::get('/rendezvous/calendar', [RendezvousController::class, 'calendar'])->name('rendezvous.calendar');

/*
|--------------------------------------------------------------------------
| Auth (invités uniquement)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    // Connexion
    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/login', [LoginController::class, 'doLogin'])->name('doLogin');

    // Mot de passe oublié
    Route::get('/forgot-password', [LoginController::class, 'showForgotPasswordForm'])->name('password.request');
    Route::post('/forgot-password', [LoginController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/reset-password/{token}', [LoginController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [LoginController::class, 'resetPassword'])->name('password.update');
});

/*
|--------------------------------------------------------------------------
| Déconnexion (auth uniquement)
|--------------------------------------------------------------------------
*/
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

/*
|--------------------------------------------------------------------------
| Routes protégées : utilisateurs connectés (auth)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    /*
    |--------------------------------------------------------------------------
    | Routes admin (rôle: admin)
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:admin')->group(function () {
        Route::resource('users', UserController::class);
        Route::resource('medecins', MedecinController::class);
        Route::resource('patients', PatientController::class);
        Route::resource('rendezvous', RendezvousController::class)->parameters([
            'rendezvous' => 'rendezvous'
        ]);
        Route::resource('consultations', ConsultationController::class);
        Route::resource('factures', FactureController::class);
        Route::resource('specialites', SpecialiteController::class);
        Route::resource('medicaments', MedicamentController::class);
        Route::resource('prescriptions', PrescriptionController::class);
        Route::resource('ordonnances', OrdonnanceController::class);
        Route::resource('dossiers', DossiersMedicauxController::class);
        Route::resource('documents', DocumentsPatientController::class);
        Route::resource('reglements',  ReglementController::class);

        // Export global factures (form POST)
        Route::post('/factures/export', [FactureController::class, 'export'])->name('factures.export');

        // Export PDF individuel d’une facture (GET)
      Route::get('/factures/{facture}/export', [FactureController::class, 'exportPdf'])
    ->name('factures.export.pdf');



        // Reçu rendez-vous PDF
        Route::get('/rendezvous/{id}/recu', [RendezvousController::class, 'recu'])->name('rendezvous.recu');

        // Ordonnance PDF
        Route::get('/ordonnances/{ordonnance}/pdf', [OrdonnanceController::class, 'downloadPdf'])->name('ordonnances.pdf');
    });

    /*
    |--------------------------------------------------------------------------
    | Routes secrétaire (rôle: secretaire)
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:secretaire')->group(function () {
        Route::resource('patients', PatientController::class)->except(['destroy']);
        Route::resource('rendezvous', RendezvousController::class)->only(['index', 'create', 'store', 'edit', 'update']);
        Route::resource('factures', FactureController::class)->only(['index', 'show']);

        // Export PDF individuel (GET)
        Route::get('/factures/{facture}/export', [FactureController::class, 'exportPdf'])->name('factures.export.pdf');
    });

    /*
    |--------------------------------------------------------------------------
    | Routes médecin (rôle: medecin)
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:medecin')->group(function () {
        Route::resource('consultations', ConsultationController::class);
        Route::resource('rendezvous', RendezvousController::class)->only(['index']);
    });
});
