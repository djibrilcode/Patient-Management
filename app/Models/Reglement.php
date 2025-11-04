<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reglement extends Model
{
    use HasFactory;

    protected $fillable = ['facture_id', 'montant_regle', 'mode', 'date_reglement'];

    public function facture()
    {
        return $this->belongsTo(Facture::class);
    }
    protected $casts = [
    'date_reglement' => 'date',
];

}
