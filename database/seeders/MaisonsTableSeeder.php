<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Maison;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MaisonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Maison::factory()
            ->count(10)
            ->create();

        Image::factory()
            ->count(10)
            ->create();
    }
}
