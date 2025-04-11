<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\medecin>
 */
class medecinFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'nom' => $this->faker->lastName(),
            'prenom' => $this->faker->firstName(),
            'spécialité' =>$this->faker->randomElement
            ($array = ['dentiste','chirugie','neurochirurgie','génétique','allergologie','hématologie','hépato-gastro-entérologie']),
            'telephone' =>$this->faker->phoneNumber(),
            'email'=> $this->faker->unique()->safeEmail(),
        ];
    }
}
