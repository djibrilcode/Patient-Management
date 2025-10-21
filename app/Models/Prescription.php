<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Medecin;
use App\Models\Patient;
use App\Models\Consultation;
use App\Models\Medicament;


class Prescription extends Model
{
    use HasFactory;
    protected $fillable = [
        'medecin_id',
        'patient_id',
        'consultation_id',  // n’oublie pas de l’ajouter ici aussi
        'date_prescription',
        'instructions',
    ];

    public function medecin()
    {
        return $this->belongsTo(Medecin::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    // **La relation manquante**
    public function consultation()
    {
        return $this->belongsTo(Consultation::class);
    }

public function medicaments()
{
    return $this->belongsToMany(Medicament::class, 'medicament_prescriptions')
                ->withPivot('dosage', 'duree')
                ->withTimestamps();
}

    public function ordonnance()
    {
        return $this->hasOne(Ordonnance::class);
    }
}

