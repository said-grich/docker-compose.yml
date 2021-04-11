<?php

namespace Database\Seeders;

use App\Models\Depot;
use Illuminate\Database\Seeder;

class DepotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Depot::create([
            'nom' => 'Marrakech 1',
            'ville_id'=> 2,
            'order_priorite'=> 1,
            'ville_zone_id'=> 137,
        ]);

        Depot::create([
            'nom' => 'Marrakech 2',
            'ville_id'=> 2,
            'order_priorite'=> 1,
            'ville_zone_id'=> 137,
        ]);

        Depot::create([
            'nom' => 'Casablanca 1',
            'ville_id'=> 1,
            'order_priorite'=> 2,
            'ville_zone_id'=> 47,
        ]);

        Depot::create([
            'nom' => 'Casablanca2',
            'ville_id'=> 1,
            'order_priorite'=> 2,
            'ville_zone_id'=> 47,
        ]);

    }
}
