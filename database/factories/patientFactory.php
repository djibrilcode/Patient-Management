<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
  public function definition(): array
{
    return [
        'nom' => $this->faker->lastName,
        'prenom' => $this->faker->firstName,
        'date_naissance' => $this->faker->date('Y-m-d', '-18 years'),
        'adresse' => $this->faker->address,
        'telephone' => $this->faker->phoneNumber,
        'email' => $this->faker->unique()->safeEmail,
    ];
}

}
