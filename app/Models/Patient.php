<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Consultation;
use App\Models\Prescription;
use App\Models\Rendezvous;
use App\Models\Dossiers_medicaux;
use App\Models\DocumentPatient;

class Patient extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom', 'prenom', 'telephone','adresse', 'email', 'date_naissance'
    ];

    public function consultations()
    {
        return $this->hasMany(Consultation::class);
    }

    public function prescriptions()
    {
        return $this->hasMany(Prescription::class);
    }

    public function rendezvous()
    {
        return $this->hasMany(Rendezvous::class);
    }

    public function dossierMedical()
    {
        return $this->hasOne(Dossiers_medicaux::class);
    }

    public function documents()
    {
        return $this->hasMany(Documents_patient::class);
    }
}

