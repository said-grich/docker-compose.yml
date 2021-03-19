<?php

namespace Database\Seeders;

use App\Models\Caisse;
use Illuminate\Database\Seeder;

class CaisseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Caisse::create([
            'code_comptable_caisse' => '5161',
            'name' => 'CAISSE CASA',
            'adresse'=>'Casablanca',
            'site_id'=> 1
        ]);
        Caisse::create([
            'code_comptable_caisse' => '5161',
            'name' => 'CAISSE MAR',
            'adresse'=>'Marrakech',
            'site_id'=> 2
        ]);
        Caisse::create([
            'code_comptable_caisse' => '5161',
            'name' => 'CAISSE RAB',
            'adresse'=>'RABAT',
            'site_id'=> 3
        ]);

    }
}
