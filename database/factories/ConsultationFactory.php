<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Patient;
use App\Models\Medecin;

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
            'patient_id' => Patient::inRandomOrder()->first()?->id ?? Patient::factory(),
            'medecin_id' => Medecin::inRandomOrder()->first()?->id ?? Medecin::factory(),
            'date_consultation' => $this->faker->date(),
            'motif' => $this->faker->randomElement([
                'Fièvre persistante', 'Douleur thoracique légère', 'Reflux gastrique',
                'Éruption cutanée', 'Contrôle de grossesse'
            ]),
            'traitement' => $this->faker->randomElement([
                'Paracétamol 500mg', 'ECG + bêta-bloquants', 'Oméprazole 20mg',
                'Crème corticoïde', 'Prise de sang + échographie'
            ]),
        ];
    }
}
