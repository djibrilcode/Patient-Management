<?php

namespace App\Http\Controllers;

use App\Models\medecin;
use Illuminate\Http\Request;

class MedecinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $medecins = medecin::paginate(10);
        return view('medecin.index', compact('medecins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('medecin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        medecin::create($request->all());
        return redirect()->route('medecin.index')->with('success','medecin created');
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
        return view('medecin.edit', compact('medecin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, medecin $medecin)
    {
        $medecin->update($request->all());
        return redirect()->route('medecin.index')->with('success', 'medecin updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(medecin $medecin)
    {
        $medecin->delete();
        return redirect()->route('medecin.index')->with('success', 'medecin deleted');
    }
}
