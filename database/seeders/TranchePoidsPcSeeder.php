<?php

namespace Database\Seeders;

use App\Models\TranchesKgPc;
use App\Models\TranchesPoidsPc;
use Illuminate\Database\Seeder;

class TranchePoidsPcSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        TranchesPoidsPc::create([
            'nom' => '3.5 - 4.5',
            'uid' => "PP".str_replace(".","",microtime(true)).rand(000,999),
            'min_poids' => 3.5,
            'max_poids' => 4.5,
        ]);

        TranchesPoidsPc::create([
            'nom' => '0.4 - 0.8',
            'uid' => "PP".str_replace(".","",microtime(true)).rand(000,999),
            'min_poids' => 0.4,
            'max_poids' => 0.8,
        ]);

        TranchesPoidsPc::create([
            'nom' => '2.5 - 3.5',
            'uid' => "PP".str_replace(".","",microtime(true)).rand(000,999),
            'min_poids' => 2.5,
            'max_poids' => 3.5,
        ]);

        TranchesPoidsPc::create([
            'nom' => '1.5 - 2.5',
            'uid' => "PP".str_replace(".","",microtime(true)).rand(000,999),
            'min_poids' => 1.5,
            'max_poids' => 2.5,
        ]);

    }
}
