<?php

use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\MedecinController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\RendezvousController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('accueil');
});

// route pour patients


Route::resource('patients', PatientController::class);

// route pour medecin
 Route::resource('medecin',MedecinController::class);

 //  route pour rendez vous
 Route::resource('rendez-vous',RendezvousController::class);

 //  route pour consultation
 Route::resource('consultation',ConsultationController::class);
