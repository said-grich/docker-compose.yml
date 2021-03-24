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
            //'ville' => 'Marrakech',
            'ville_id'=> 2,
        ]);
        Depot::create([
            'nom' => 'Casablance',
            //'ville' => 'Casablanca',
            'ville_id'=> 1,
        ]);

    }
}
