<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Consultation;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Facture>
 */
class FactureFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
   public function definition(): array
{
    return [
        'consultation_id' => Consultation::inRandomOrder()->first()?->id ?? Consultation::factory(),
        'montant' => $this->faker->randomFloat(2, 100, 500),
        'statut_paiement' => $this->faker->randomElement(['payé', 'impayé', 'partiel']),
        'mode_paiement' => $this->faker->optional()->randomElement(['espèce', 'carte', 'chèque', 'virement']),
        'date_paiement' => $this->faker->optional()->date(),
    ];
}

}
