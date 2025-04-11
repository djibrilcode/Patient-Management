<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class rendezVous extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function patient()
    {
        return $this->hasMany('patient_id');
    }

    public function medecin()
    {
        return $this->HasMany('medecin_id');
    }
}
