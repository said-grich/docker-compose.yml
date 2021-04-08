<?php

namespace Database\Seeders;

use App\Models\VilleQuartier;
use App\Models\VilleZone;
use Illuminate\Database\Seeder;

class VilleQuartierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        VilleQuartier::create([
            'nom' => 'Quartier Bayard',
            'ville_zone_id'=> 2,
        ]);

        VilleQuartier::create([
            'nom' => 'Kaat Benahid',
            'ville_zone_id'=> 2,
        ]);

        VilleQuartier::create([
            'nom' => 'Quartier Mabrouka',
            'ville_zone_id'=> 2,
        ]);

        VilleQuartier::create([
            'nom' => 'Quartier Industriel Sidi Ghanem',
            'ville_zone_id'=> 2,
        ]);

        VilleQuartier::create([
            'nom' => 'Lahraouine',
            'ville_zone_id'=> 1,
        ]);

        VilleQuartier::create([
            'nom' => 'Sbata',
            'ville_zone_id'=> 1,
        ]);

        VilleQuartier::create([
            'nom' => 'Hay Riad',
            'ville_zone_id'=> 3,
        ]);

        VilleQuartier::create([
            'nom' => 'Avenue Moustapha Assayeh',
            'ville_zone_id'=> 3,
        ]);

    }
}
