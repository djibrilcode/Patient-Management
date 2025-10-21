<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Prescription;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ordonnance>
 */
class OrdonnanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
  public function definition(): array
{
    return [
        'prescription_id' => Prescription::inRandomOrder()->first()?->id ?? Prescription::factory(),
        'numero' => strtoupper($this->faker->unique()->bothify('ORD-####')),
        'date_emission' => $this->faker->date(),
        'date_validite' => $this->faker->optional()->date(),
    ];
}

}
