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
        ]);
        Depot::create([
            'nom' => 'Casablance',
            'ville' => 'Casablanca',
        ]);
        /* Depot::create([
            'code' => 'D00003',
            'nom' => 'VOIEXPRESS',
            'site_id'=> 3,
            'adresse' => 'casa',
            'ville' => 'Casablanca',
            'pays' => 'Maroc',
            'mode_stockage' => '',
        ]);
        Depot::create([
            'code' => 'D00005',
            'nom' => '	EFK',
            'site_id'=> 3,
            'adresse' => 'casa',
            'ville' => 'Casablanca',
            'pays' => 'Maroc',
            'mode_stockage' => '',
        ]); */

    }
}
