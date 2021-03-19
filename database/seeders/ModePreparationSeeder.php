<?php

namespace Database\Seeders;

use App\Models\ModePreparation;
use Illuminate\Database\Seeder;

class ModePreparationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ModePreparation::create([
            'nom' => 'Filet sans peau',
        ]);

        ModePreparation::create([
            'nom' => 'Filet avec peau',
        ]);

        ModePreparation::create([
            'nom' => 'Vidé / Avec écailles / Ouverture dos',
        ]);

        ModePreparation::create([
            'nom' => 'Vidé/ Sans écailles / Ouverture ventre',
        ]);

        ModePreparation::create([
            'nom' => 'Vidé / sans peau / lamelles',
        ]);

        ModePreparation::create([
            'nom' => 'Vidé / sans peau / anneaux',
        ]);


    }
}
