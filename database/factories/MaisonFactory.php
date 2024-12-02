<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Maison>
 */
class MaisonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'address' => fake()->address(),
            'price' => fake()->randomFloat(2, 50000, 500000), // Prix aléatoire entre 50k et 500k
            'rooms' => fake()->numberBetween(1, 10), // Nombre de pièces entre 1 et 10
            'size' => fake()->randomFloat(2, 30, 300), // Taille entre 30 et 300 m²
            'description' => fake()->text(200), // Description de 200 caractères
            'created_at' => fake()->dateTimeBetween('-2 months', 'now'),
            'user_id' => User::get()->random()->id,
        ];
    }
}
