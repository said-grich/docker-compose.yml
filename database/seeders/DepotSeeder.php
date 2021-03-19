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
            'ville' => 'Marrakech',
            'region_id'=> 2,
        ]);
        Depot::create([
            'nom' => 'Casablance',
            'ville' => 'Casablanca',
            'region_id'=> 1,
        ]);

    }
}
