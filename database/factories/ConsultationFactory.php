<?php

namespace Database\Factories;

use App\Models\Patient;
use App\Models\Medecin;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Consultation>
 */
class ConsultationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'patient_id' => Patient::factory(),
            'medecin_id' => Medecin::factory(),
            'date_consultation' => $this->faker->date(),
            'motif' => $this->faker->sentence(5), // petit texte pour le motif
            'traitement' => $this->faker->sentence(8), // petit texte pour le traitement
        ];
    }
}
