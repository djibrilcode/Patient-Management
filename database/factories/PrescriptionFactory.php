<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Prescription;
use App\Models\Patient;
use App\Models\Medecin;
use App\Models\consultation;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Prescription>
 */
class PrescriptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'medecin_id' => Medecin::inRandomOrder()->first()?->id ?? Medecin::factory(),
            'patient_id' => Patient::inRandomOrder()->first()?->id ?? Patient::factory(),
            'consultation_id' => Consultation::inRandomOrder()->first()?->id ?? null,
            'date_prescription' => $this->faker->date(),
            'instructions' => $this->faker->randomElement([
                'Prendre après les repas pendant 5 jours',
                '2 fois par jour, matin et soir',
                'À jeun le matin, ne pas dépasser 7 jours',
                'Appliquer sur la zone affectée 2x/jour',
                'Respecter la posologie prescrite par jour',
            ]),
        ];
    }
}
