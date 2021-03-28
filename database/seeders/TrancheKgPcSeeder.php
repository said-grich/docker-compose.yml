<?php

namespace Database\Seeders;

use App\Models\TranchesKgPc;
use Illuminate\Database\Seeder;

class TrancheKgPcSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        TranchesKgPc::create([
            'nom' => 'Mixte',
            'uid' => "KP".str_replace(".","",microtime(true)).rand(000,999),
        ]);

        TranchesKgPc::create([
            'nom' => 'Petite',
            'uid' => "KP".str_replace(".","",microtime(true)).rand(000,999),
        ]);

        TranchesKgPc::create([
            'nom' => 'Moyenne',
            'uid' => "KP".str_replace(".","",microtime(true)).rand(000,999),
        ]);

    }
}
