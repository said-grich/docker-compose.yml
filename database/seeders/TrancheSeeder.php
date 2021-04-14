<?php

namespace Database\Seeders;

use App\Models\Tranche;
use App\Models\TranchesKgPc;
use Illuminate\Database\Seeder;

class TrancheSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        Tranche::create([
            'type' => 'Kg/Pièce',
            'nom' => 'Mixte',
            'uid' => "KP".str_replace(".","",microtime(true)).rand(000,999),
            /* 'mode_vente_id' => 1 */
        ]);

        Tranche::create([
            'type' => 'Kg/Pièce',
            'nom' => 'Petite',
            'uid' => "KP".str_replace(".","",microtime(true)).rand(000,999),
        ]);

        Tranche::create([
            'type' => 'Kg/Pièce',
            'nom' => 'Moyenne',
            'uid' => "KP".str_replace(".","",microtime(true)).rand(000,999),
        ]);

        Tranche::create([
            'type' => 'Poids par pièce',
            'nom' => '3.5 - 4.5',
            'uid' => "PP".str_replace(".","",microtime(true)).rand(000,999),
            'min_poids' => 3.5,
            'max_poids' => 4.5,
        ]);

        Tranche::create([
            'type' => 'Poids par pièce',
            'nom' => '0.4 - 0.8',
            'uid' => "PP".str_replace(".","",microtime(true)).rand(000,999),
            'min_poids' => 0.4,
            'max_poids' => 0.8,
        ]);

        Tranche::create([
            'type' => 'Poids par pièce',
            'nom' => '2.5 - 3.5',
            'uid' => "PP".str_replace(".","",microtime(true)).rand(000,999),
            'min_poids' => 2.5,
            'max_poids' => 3.5,
        ]);

        Tranche::create([
            'type' => 'Poids par pièce',
            'nom' => '1.5 - 2.5',
            'uid' => "PP".str_replace(".","",microtime(true)).rand(000,999),
            'min_poids' => 1.5,
            'max_poids' => 2.5,
        ]);

    }
}
