<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicamentPrescription extends Model
{
    use HasFactory;
    protected $table = 'medicament_prescriptions';

    protected $fillable = [
        'prescription_id',
        'medicament_id',
        'dosage',
        'duree',
    ];
    

    public function medicament()
    {
        return $this->belongsTo(Medicament::class);
    }

    public function prescription()
    {
        return $this->belongsTo(Prescription::class);
    }
}

