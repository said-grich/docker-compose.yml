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
            'code' => 'D00001',
            'name' => 'FLOUKA MAR',
            'site_id'=> 1,
            'adresse' => 'Massar',
            'ville' => 'Marrakech',
            'pays' => 'Maroc',
            'mode_stockage' => '',
        ]);
        Depot::create([
            'code' => 'D00002',
            'name' => 'FLOUKA CASA',
            'site_id'=> 2,
            'adresse' => 'casa',
            'ville' => 'Casablanca',
            'pays' => 'Maroc',
            'mode_stockage' => '',
        ]);
        Depot::create([
            'code' => 'D00003',
            'name' => 'VOIEXPRESS',
            'site_id'=> 3,
            'adresse' => 'casa',
            'ville' => 'Casablanca',
            'pays' => 'Maroc',
            'mode_stockage' => '',
        ]);
        Depot::create([
            'code' => 'D00005',
            'name' => '	EFK',
            'site_id'=> 3,
            'adresse' => 'casa',
            'ville' => 'Casablanca',
            'pays' => 'Maroc',
            'mode_stockage' => '',
        ]);

    }
}
