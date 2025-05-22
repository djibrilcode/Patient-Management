<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function rendezVous()
    {
        return $this->belongsTo('patient_id');

    }
}
