<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Prescription;
use App\Models\Medicament;
use App\Models\MedicamentPrescription;

class MedicamentPrescriptionFactory extends Factory
{
    protected $model = MedicamentPrescription::class;

    public function definition(): array
    {
        return [
            'prescription_id' => Prescription::inRandomOrder()->first()?->id ?? Prescription::factory(),
            'medicament_id'   => Medicament::inRandomOrder()->first()?->id ?? Medicament::factory(),
            'dosage'          => $this->faker->randomElement([
                '1 comprimé toutes les 6 heures',
                '500 mg 3 fois par jour',
                '1 gélule le matin',
                '2 inhalations par crise',
                '1 comprimé après repas',
            ]),
            'duree' => $this->faker->randomElement([
                '5 jours', '7 jours', '10 jours', '3 jours', 'Selon besoin'
            ]),
        ];
    }
}
