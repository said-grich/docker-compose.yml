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
            'nom' => 'Cuisine',
        ]);

        ModePreparation::create([
            'nom' => 'Nettoyage',
        ]);



    }
}
