<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Prescription;
use App\Models\Specialite;
class Medecin extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom', 'prenom', 'specialite_id', 'telephone', 'email'
    ];

       public function specialite()
    {
        return $this->belongsTo(Specialite::class);
    }

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
}

