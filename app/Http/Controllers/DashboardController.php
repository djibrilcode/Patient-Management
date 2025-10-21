<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Patient;
use App\Models\Medecin;
use App\Models\Rendezvous;
use App\Models\Consultation;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Variables dynamiques initialisées
        $patientCount = null;
        $medecinCount = null;
        $rdvCount = null;
        $consultationCount = null;
        $recentPatients = [];

        // Admin voit tout
        if ($user->role === 'admin') {
            $patientCount = Patient::count();
            $medecinCount = Medecin::count();
            $rdvCount = Rendezvous::count();
            $consultationCount = Consultation::count();
            $recentPatients = Patient::latest()->take(5)->get();
        }

        // Secrétaire voit seulement patients et rendez-vous
        if ($user->role === 'secretaire') {
            $patientCount = Patient::count();
            $rdvCount = Rendezvous::count();
            $recentPatients = Patient::latest()->take(5)->get();
        }

        // Médecin voit consultations, patients, rdv
        if ($user->role === 'medecin') {
            $patientCount = Patient::count();
            $rdvCount = Rendezvous::count();
            $consultationCount = Consultation::count();
            $recentPatients = Patient::latest()->take(5)->get();
        }

        // Statistiques des rendez-vous par mois (12 mois)
        $rdvsParMois = Rendezvous::select(
            DB::raw('MONTH(created_at) as mois'),
            DB::raw('COUNT(*) as total')
        )
        ->whereYear('created_at', now()->year)
        ->groupBy(DB::raw('MONTH(created_at)'))
        ->pluck('total', 'mois');

        // Créer un tableau complet (index 1 à 12)
        $rdvChartData = [];
        for ($i = 1; $i <= 12; $i++) {
            $rdvChartData[] = $rdvsParMois[$i] ?? 0;
        }

        return view('dashboard.index', compact(
            'patientCount',
            'medecinCount',
            'rdvCount',
            'consultationCount',
            'recentPatients',
            'rdvChartData'
        ));
    }
}
