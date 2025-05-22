<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    PatientController,
    MedecinController,
    RendezvousController,
    ConsultationController,
    DashboardController,
    AccueilController,
    LoginController,
    FactureController,
    UserController
};

// --- Pages publiques ---
Route::get('/', [AccueilController::class, 'index'])->name('accueil');
Route::view('/contact', 'contact')->name('contact');
Route::view('/apropos', 'about')->name('about');

Route::get('/content', function () {
    return response()->json([
        'html' => '<h3>Contenu chargé depuis Laravel !</h3><p>Ce bloc est affiché sans rechargement complet.</p>'
    ]);
});

// --- Authentification ---
Route::middleware('guest')->group(function() {
    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/login', [LoginController::class, 'doLogin'])->name('doLogin');
});

Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

// --- Tableau de bord commun (tous rôles connectés) ---
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
});

// --- ADMIN : tous les accès ---
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('medecins', MedecinController::class);
    Route::resource('patients', PatientController::class);
    Route::resource('rendezvous', RendezvousController::class);
    Route::resource('consultations', ConsultationController::class);
    Route::resource('factures', FactureController::class);
    Route::post('/factures/export', [FactureController::class, 'export'])->name('factures.export');
    Route::resource('factures', FactureController::class);
Route::get('/factures/{facture}/export', [FactureController::class, 'export'])
    ->name('factures.export');
});

// --- SECRETAIRE : patients & rendezvous ---
Route::middleware(['auth', 'role:secretaire'])->group(function () {
    Route::resource('patients', PatientController::class);
    Route::resource('rendezvous', RendezvousController::class);
});

// --- MEDECIN : consultations uniquement ---
Route::middleware(['auth', 'role:medecin'])->group(function () {
    Route::resource('consultations', ConsultationController::class);
});
