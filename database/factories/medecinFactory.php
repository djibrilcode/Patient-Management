<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Specialite;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Medecin>
 */
class MedecinFactory extends Factory
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
            'specialite_id' => Specialite::inRandomOrder()->first()?->id ?? Specialite::factory(),
            'telephone' => $this->faker->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
        ];
    }

}
