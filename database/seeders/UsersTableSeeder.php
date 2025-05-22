<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Médecin
        User::create([
            'name' => 'Dr. Dupont',
            'email' => 'medecin@example.com',
            'password' => Hash::make('password'),
            'role' => 'medecin',
        ]);

        // Secrétaire
        User::create([
            'name' => 'Secrétaire',
            'email' => 'secretaire@example.com',
            'password' => Hash::make('password'),
            'role' => 'secretaire',
        ]);
    }
}