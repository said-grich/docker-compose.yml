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
            'nom' => 'Marrakech',
            'ville_id'=> 2,
            'order_priorite'=> 1,
            'zone_id'=> 137,
        ]);
        Depot::create([
            'nom' => 'Casablance',
            'ville_id'=> 1,
            'order_priorite'=> 2,
            'zone_id'=> 47,
        ]);

    }
}
