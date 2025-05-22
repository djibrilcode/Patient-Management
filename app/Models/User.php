<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role'
    ];

    protected $hidden = [
        'password', 'remember_token',
         'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Rôles disponibles
    public const ROLES = [
        'admin' => 'Administrateur',
        'medecin' => 'Médecin',
        'secretaire' => 'Secrétaire'
    ];

    // Vérifier les rôles
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isMedecin(): bool
    {
        return $this->role === 'medecin';
    }

    public function isSecretaire(): bool
    {
        return $this->role === 'secretaire';
    }
}