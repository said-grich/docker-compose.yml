<?php

namespace Database\Seeders;

use App\Models\ModePreparation;
use App\Models\Qualite;
use Illuminate\Database\Seeder;

class QualiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Qualite::create([
            'nom' => 'A+',
        ]);

        Qualite::create([
            'nom' => 'A++',
        ]);

        Qualite::create([
            'nom' => 'A-',
        ]);

        Qualite::create([
            'nom' => 'A--',
        ]);
    }
}
