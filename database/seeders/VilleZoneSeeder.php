<?php

namespace Database\Seeders;

use App\Models\VilleZone;
use Illuminate\Database\Seeder;

class VilleZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        VilleZone::create([
            'nom' => '2 Mars',
            'ville_id'=> 1,
        ]);
        VilleZone::create([
            'nom' => 'Marrakech',
            'ville_id'=> 2,
        ]);

        VilleZone::create([
            'nom' => 'Mohammedia',
            'ville_id'=> 1,
        ]);

        VilleZone::create([
            'nom' => 'Rabat',
            'ville_id'=> 3,
        ]);

    }
}
