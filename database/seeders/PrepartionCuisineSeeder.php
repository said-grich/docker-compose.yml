<?php

namespace Database\Seeders;

use App\Models\PrepartionCuisine;
use Illuminate\Database\Seeder;

class PrepartionCuisineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PrepartionCuisine::create([
            'nom' => 'Four',
        ]);
        PrepartionCuisine::create([
            'nom' => 'Grillade',
        ]);
        PrepartionCuisine::create([
            'nom' => 'Tajine',
        ]);
        PrepartionCuisine::create([
            'nom' => 'Plancha',
        ]);
        PrepartionCuisine::create([
            'nom' => 'Friture',
        ]);

    }
}
