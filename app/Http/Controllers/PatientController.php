<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $patients = Patient::query()
            ->when($search, function ($query) use ($search) {
                $query->where('nom', 'like', "%{$search}%")
                      ->orWhere('prenom', 'like', "%{$search}%")
                      ->orWhere('telephone', 'like', "%{$search}%");
            })
            ->paginate(5);

        return view('patients.index', compact('patients'));
    }

    public function create()
    {
        return view('patients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'date_naissance' => 'required|date',
            'adresse' => 'required',
            'telephone' => 'required',
            'email' => 'required|email|unique:patients,email'
        ]);

        Patient::create($request->all());
        return redirect()->route('patients.index')->with('success', 'Patient ajouté avec succès');
    }

    public function show(Patient $patient)
    {
        return view('patients.show', compact('patient'));
    }

    public function edit(Patient $patient)
    {
        return view('patients.edit', compact('patient'));
    }

    public function update(Request $request, Patient $patient)
    {
        $request->validate([
            'nom' => 'required',
            'prenom' => 'required',
            'date_naissance' => 'required|date',
            'adresse' => 'required',
            'telephone' => 'required',
            'email' => 'required|email|unique:patients,email,' . $patient->id
        ]);

        $patient->update($request->all());
        return redirect()->route('patients.index')->with('success', 'Patient mis à jour avec succès');
    }

    public function destroy(Patient $patient)
    {
        $patient->delete();
        return redirect()->route('patients.index')->with('success', 'Patient supprimé avec succès');
    }
}