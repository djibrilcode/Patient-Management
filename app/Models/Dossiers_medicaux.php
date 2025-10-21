<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dossiers_medicaux extends Model
{
        use HasFactory;

protected $fillable = [
        'patient_id',
        'medecin_id',
        'antecedents_personnels',
        'antecedents_familiaux',
        'allergies',
        'traitements_chroniques',
        'habitudes',
        'remarques',
    ];

    protected $table = 'dossiers_medicaux';


  public function patient()
{
    return $this->belongsTo(Patient::class);
}

public function medecin()
{
    return $this->belongsTo(Medecin::class);
}

}
