<?php

namespace App\Http\Controllers;

use App\Models\medecin;
use Illuminate\Http\Request;

class MedecinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)

    {
        $medecins = Medecin::query();
        $search = $request->input('search');

        if ($search) {
            // Recherche multicritère sur nom, prénom et téléphone
            $medecins->where(function ($query) use ($search) {
                $query->where('nom', 'like', "%{$search}%")
                      ->orWhere('prenom', 'like', "%{$search}%")
                      ->orWhere('telephone', 'like', "%{$search}%");
            });
        }


        $medecins = medecin::paginate(5);
        return view('medecins.index', compact('medecins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('medecins.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        medecin::create($request->all());
        return redirect()->route('medecins.index')->with('success','medecin created');
    }

    /**
     * Display the specified resource.
     */
    public function show(medecin $medecin)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(medecin $medecin)
    {
        return view('medecins.edit', compact('medecin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, medecin $medecin)
    {
        $medecin->update($request->all());
        return redirect()->route('medecins.index')->with('success', 'medecin updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(medecin $medecin)
    {
        $medecin->delete();
        return redirect()->route('medecins.index')->with('success', 'medecin deleted');
    }
}
