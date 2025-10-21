<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reglement extends Model
{
    use HasFactory;

    protected $fillable = ['facture_id', 'montant', 'mode_paiement', 'date_paiement'];

    public function facture()
    {
        return $this->belongsTo(Facture::class);
    }
}
