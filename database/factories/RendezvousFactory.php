<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Patient;
use App\Models\Medecin;

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
        'patient_id' => Patient::inRandomOrder()->first()?->id ?? Patient::factory(),
        'medecin_id' => Medecin::inRandomOrder()->first()?->id ?? Medecin::factory(),
        'date' => $this->faker->date(),
        'heure' => $this->faker->time(),
        'motif' => $this->faker->sentence,
        'statut' => $this->faker->randomElement(['prévu', 'annulé', 'terminé', 'confirmé', 'en attente']),
    ];
}

}
