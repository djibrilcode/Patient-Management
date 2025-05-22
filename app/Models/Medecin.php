<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class medecin extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function rendezVous()
    {
        return $this->belongsTo('medecin_id');

    }

}
