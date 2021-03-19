<?php

namespace Database\Seeders;

use App\Models\Famille;
use Illuminate\Database\Seeder;

class FamilleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Famille::create([
            'code' => 'F00001',
            'famille' => 'PACK',
        ]);
        Famille::create([
            'code' => 'F00002',
            'famille' => 'POISSONS CONGELE',
        ]);
         Famille::create([
            'code' => 'F00003',
            'famille' => 'POISSONS FRAIS',
        ]);
        Famille::create([
            'code' => 'F00004',
            'famille' => 'FRITES',
        ]);
        Famille::create([
            'code' => 'F00005',
            'famille' => 'EPICERIE',
        ]);

        Famille::create([
            'code' => 'F00006',
            'famille' => 'SERVICE',
        ]);
    }
}
