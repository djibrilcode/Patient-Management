<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Administrateur',
            'email' => 'admin@clinique.com',
            'password' => Hash::make('Admin123!'),
            'role' => 'admin',
            'email_verified_at' => now()
        ]);

        // Médecin
        User::create([
            'name' => 'Dr. Souley',
            'email' => 'souley@clinique.com',
            'password' => Hash::make('Medecin123!'),
            'role' => 'medecin',
            'email_verified_at' => now()
        ]);

        // Secrétaire
        User::create([
            'name' => 'Secrétaire',
            'email' => 'secretaire@clinique.com',
            'password' => Hash::make('Secret123!'),
            'role' => 'secretaire',
            'email_verified_at' => now()
        ]);

        // Patient (exemple)
        // User::create([
        //     'name' => 'Patient Test',
        //     'email' => 'patient@clinique.com',
        //     'password' => Hash::make('Patient123!'),
        //     'role' => 'patient',
        //     'email_verified_at' => now()
        // ]);
    }
}
