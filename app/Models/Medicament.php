<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Medicament_Prescription;
use App\Models\Prescription;


class Medicament extends Model
{
    use HasFactory;
    protected $fillable = ['nom', 'description'];

    public function medicamentPrescriptions()
    {
        return $this->hasMany(Medicament_Prescription::class);
    }

    
    public function prescriptions()
{
    return $this->belongsToMany(Prescription::class, 'medicament_prescriptions')
                ->withPivot('dosage', 'duree')
                ->withTimestamps();
}
}
