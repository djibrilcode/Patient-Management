<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ordonnance extends Model
{
    use HasFactory;

    protected $fillable = [
        'prescription_id',
        'numero',
        'date_emission',
        'date_validite',
    ];

    protected $casts = [
        'date_emission' => 'date',
        'date_validite' => 'date',
    ];

 public function prescription()
{
    return $this->belongsTo(Prescription::class);
}
}


