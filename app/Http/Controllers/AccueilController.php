<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Medecin;

class AccueilController extends Controller
{
    public function index()
    {
             // Compte les médecins

        // Tu peux aussi récupérer tous les patients :
        // $patients = Patient::all();

        return view('accueil');
    }
}
