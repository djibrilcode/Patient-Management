<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class Facture extends Model
{
    use HasFactory;

    protected $fillable = [
        'consultation_id',
        'montant',
        'statut_paiement',
        'mode_paiement',
        'date_paiement'
    ];

     // Définir les champs qui doivent être convertis en Carbon
   protected $dates = ['date_paiement', 'created_at', 'updated_at'];


    
    // Nombre de jours de retard
    // (Méthode supprimée car elle était dupliquée plus bas)

    // Relation avec Consultation
    public function consultation()
    {
        return $this->belongsTo(Consultation::class);
    }

    public function reglements()
    {
        return $this->hasMany(Reglement::class);
    }

    /**
     * Vérifie si la facture est en retard
     */
    public function isLate(): bool
    {
        if ($this->statut_paiement !== 'payé' && $this->created_at) {
            return Carbon::parse($this->created_at)->diffInDays(now()) > 30;
        }
        return false;
    }

    /**
     * Retourne le nombre de jours de retard
     */
    public function daysLate(): int
    {
        if ($this->isLate()) {
            return Carbon::parse($this->created_at)->diffInDays(now());
        }
        return 0;
    }

    /**
     * Accessor pour formater le montant
     */
    public function getFormattedMontantAttribute(): string
    {
        return number_format($this->montant, 2) . ' €';
    }

    public function getDatePaiementFormattedAttribute()
{
    if (!$this->date_paiement) {
        return null;
    }
    return Carbon::parse($this->date_paiement)->format('d/m/Y');
}
protected static function boot()
{
    parent::boot();
    
    static::retrieved(function($model) {
        Log::info('Retrieving facture:', $model->toArray());
    });
}

protected $casts = [
    'created_at' => 'datetime',
    'updated_at' => 'datetime',
    'date_paiement' => 'datetime', // si tu as cette colonne
];


}