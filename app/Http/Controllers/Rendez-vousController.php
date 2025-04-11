<?php

namespace App\Http\Controllers;

use App\Models\rendezVous;
use Illuminate\Http\Request;

class RendezvousController extends Controller
{
    public function index() {
        $rendez_vous = rendezVous::all();
        return view('rendez_vous.index', compact('rendez_vous'));
    }

    public function create() {
        return view('rendez_vous.create');
    }

    public function store(Request $request) {
        rendezVous::create($request->all());
        return redirect()->route('rendez_vous.index')->with('success', 'rendez-vous pris successfuly');
    }

    public function edit(rendezVous $rendez_vous)
    {
        return view('rendez_vous.edit', compact('rendez_vous'));
    }

    public function update(Request $request,rendezVous $rendez_vous){
        $rendez_vous->update($request->all());
        return redirect()->route('rendez_vous.index')->with('success', 'rendez-vous updated successfuly');
    }

    public function destroy(rendezVous $rendez_vous){
        $rendez_vous->delete();
        return redirect()->route('rendez_vous.index')->with('success', 'rendez-vous deleted successfuly');
    }
}
