<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Specialite;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Désactive FK pour éviter les blocages au truncate
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('specialites')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Crée les spécialités sans doublons via factory
        Specialite::factory(15)->create();

        // Autres factories
        \App\Models\Medecin::factory(10)->create();
        \App\Models\Patient::factory(10)->create();
        \App\Models\Consultation::factory(10)->create();
        \App\Models\Rendezvous::factory(10)->create();
        \App\Models\Medicament::factory(10)->create();
        \App\Models\Prescription::factory(20)->create();
        \App\Models\Ordonnance::factory(10)->create();
        \App\Models\Facture::factory(10)->create();
       \App\Models\MedicamentPrescription::factory()->count(10)->create();
         $this->call(UserSeeder::class);
    }
}
