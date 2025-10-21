<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documents_patient extends Model
{
     use HasFactory;

    protected $fillable = ['patient_id', 'titre', 'chemin_fichier', 'date'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}