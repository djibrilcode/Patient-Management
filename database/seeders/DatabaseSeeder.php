<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        \App\Models\Patient::factory(20)->create();
        \App\Models\medecin::factory(20)->create();
        \App\Models\Rendezvous::factory()->count(20)->create();
        \App\Models\Consultation::factory()->count(20)->create();
         $this->call([
        UserSeeder::class,
        
    ]);
$this->call(UsersTableSeeder::class);
    }
}
