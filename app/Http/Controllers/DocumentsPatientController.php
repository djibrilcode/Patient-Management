<?php

namespace App\Http\Controllers;

use App\Models\Documents_patient;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentsPatientController extends Controller
{
public function index(Request $request)
{
        $query = Documents_patient::with(['patient'])
        ->when($request->search, function($q, $search){
            $q->wherehas('patient', fn($q2) =>
                $q2->where('nom', 'like', "%{$search}%")
                ->orwhere('titre', 'like', "%{$search}%")
            );
        });
        $documents = $query
        ->latest()
        ->paginate(10)
        ->appends($request->only('search'));
            

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
            'titre'      => 'required|string|max:255',
            'fichier'    => 'required|file|mimes:pdf,jpg,jpeg,png,docx|max:4096',
            'date'       => 'required|date',
        ]);

        $path = $request->file('fichier')->store('documents');

        Documents_patient::create([
            'patient_id' => $request->patient_id,
            'titre'      => $request->titre,
            'fichier'    => $path,
            'date'       => $request->date,
        ]);

        return redirect()->route('documents.index')->with('success', 'Document ajouté avec succès.');
    }

    public function show(Documents_patient $document)
    {
        return view('documents.show', compact('document'));
    }

    public function edit(Documents_patient $document)
    {
        $patients = Patient::all();
        return view('documents.edit', compact('document', 'patients'));
    }

    public function update(Request $request, Documents_patient $document)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'titre'      => 'required|string|max:255',
            'date'       => 'required|date',
            'fichier'    => 'nullable|file|mimes:pdf,jpg,jpeg,png,docx|max:4096',
        ]);

        $data = $request->only(['patient_id', 'titre', 'date']);

        if ($request->hasFile('fichier')) {
            Storage::delete($document->fichier);
            $data['fichier'] = $request->file('fichier')->store('documents');
        }

        $document->update($data);

        return redirect()->route('documents.index')->with('success', 'Document mis à jour avec succès.');
    }

    public function download(Documents_patient $document)
    {
        return Storage::download($document->fichier, basename($document->fichier));
    }

    public function destroy(Documents_patient $document)
    {
        Storage::delete($document->fichier);
        $document->delete();

        return redirect()->route('documents.index')->with('success', 'Document supprimé avec succès.');
    }
}
