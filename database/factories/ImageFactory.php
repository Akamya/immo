<?php

namespace Database\Factories;

use App\Models\Maison;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $maisonIds = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];

        // Choisir un ID de maison en fonction de l'index courant de la boucle
        static $index = 0;
        if ($index >= count($maisonIds)) {
            $index = 0; // Réinitialise l'index une fois que tous les IDs ont été utilisés
        }

        $maisonId = $maisonIds[$index++];

        return [
            'maison_id' => $maisonId,
            'path' => function () {
                $randomName = Str::uuid();
                $imageUrl = "https://picsum.photos/seed/house-{$randomName}/1024/768.webp";
                $path = "images/{$randomName}.webp";
                Storage::disk('public')->put($path, file_get_contents($imageUrl));

                return $path;
            },
        ];
    }
}
