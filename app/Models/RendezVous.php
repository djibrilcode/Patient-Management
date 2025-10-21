<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rendezvous extends Model
{
    use HasFactory;

    // Protège l'ID contre les assignations de masse
protected $fillable = ['patient_id', 'medecin_id', 'date', 'heure', 'statut', 'motif'];

    protected $table = 'rendezvous';
    protected $casts = [
    'date' => 'date', // ou 'datetime' selon le type
];



    /**
     * Relation avec le patient
     */
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * Relation avec le médecin
     */
    public function medecin(): BelongsTo
    {
        return $this->belongsTo(Medecin::class);
    }
}
