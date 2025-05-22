<?php

namespace Database\Factories;

use App\Models\Patient;
use App\Models\Medecin;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rendezvous>
 */
class RendezvousFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'patient_id' => Patient::factory(), // crée aussi un patient automatiquement
            'medecin_id' => Medecin::factory(), // crée aussi un médecin automatiquement
            'date' => $this->faker->date(),
            'heure' => $this->faker->time(),
            'statut' => $this->faker->randomElement(['En attente', 'Confirmé', 'Annulé']),
        ];
    }
}
