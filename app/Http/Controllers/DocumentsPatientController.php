<?php

namespace App\Http\Controllers;

use App\Models\Documents_patient;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentsPatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $documents = Documents_patient::with('patient')->paginate(10);
        return view('documents.index', compact('documents'));
    }

    public function create()
    {
        $patients = Patient::all();
        return view('documents.create', compact('patients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'titre' => 'required|string|max:255',
            'fichier' => 'required|file|mimes:pdf,jpg,jpeg,png,docx',
        ]);

        $path = $request->file('fichier')->store('documents');

        Documents_patient::create([
            'patient_id' => $request->patient_id,
            'titre' => $request->titre,
            'chemin_fichier' => $path,
        ]);

        return redirect()->route('documents.index')->with('success', 'Document ajouté.');
    }

    public function show(Documents_patient $document)
    {
        return view('documents.show', compact('document'));
    }

    public function download(Documents_patient $document)
    {
        return Storage::download($document->chemin_fichier, $document->titre);
    }

    public function destroy(Documents_patient $document)
    {
        Storage::delete($document->chemin_fichier);
        $document->delete();

        return redirect()->route('documents.index')->with('success', 'Document supprimé.');
    }
}
