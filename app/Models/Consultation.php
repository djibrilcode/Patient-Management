<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class consultation extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

  protected $casts = [
    'date_prescription' => 'date',
];


    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function medecin()
    {
        return $this->belongsTo(Medecin::class);
    }

     public function facture()
    {
        return $this->hasOne(Facture::class, 'consultation_id');
    }

}
