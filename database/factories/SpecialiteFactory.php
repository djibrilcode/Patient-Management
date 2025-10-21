<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SpecialiteFactory extends Factory
{
    protected $model = \App\Models\Specialite::class;

    public function definition()
    {
        return [
            'nom' => $this->faker->unique()->randomElement([
                'Cardiologie', 'Dermatologie', 'Pédiatrie', 'Gastro-entérologie', 'Gynécologie',
                'Neurologie', 'Oncologie', 'Ophtalmologie', 'Orthopédie', 'Psychiatrie',
                'ORL', 'Endocrinologie', 'Rhumatologie', 'Urologie', 'Médecine interne',
            ]),
        ];
    }
}
