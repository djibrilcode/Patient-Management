<?php

namespace App\Http\Controllers;

use App\Models\consultation;
use Illuminate\Http\Request;

class ConsultationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $consultation = Consultation::all();
        return view('consultation.index', compact('consultation'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('consultation.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        consultation::create($request->all());
        return redirect()->route('consultation.index',compact('consultation'))->with('succes','Consultation ajouté');

    }

    /**
     * Display the specified resource.
     */
    public function show(consultation $consultation)
    {
        //
        return view('consultation.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(consultation $consultation)
    {
        //
        return view('consultation.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, consultation $consultation)
    {
        //
        $consultation->update($request->all());
        return redirect()->route('consultation.index',compact('consultation'))->with('succes','Consultation update');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(consultation $consultation)
    {
        //
        $consultation->delete();
        return redirect()->route('consultation.index',compact('consultation'))->with('succes', 'Consultation delete');;
    }
}
