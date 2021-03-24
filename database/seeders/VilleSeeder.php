<?php

namespace Database\Seeders;

use App\Models\Ville;
use Illuminate\Database\Seeder;

class VilleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ville::create([
            'nom' => 'Casablance',
            'region_id'=> 1,
        ]);
        Ville::create([
            'nom' => 'Marrakech',
            'region_id'=> 2,
        ]);

        Ville::create([
            'nom' => 'Mohammedia',
            'region_id'=> 1,
        ]);

        Ville::create([
            'nom' => 'Rabat',
            'region_id'=> 3,
        ]);

    }
}
