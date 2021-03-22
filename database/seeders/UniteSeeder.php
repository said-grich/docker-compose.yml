<?php

namespace Database\Seeders;

use App\Models\Unite;
use Illuminate\Database\Seeder;

class UniteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Unite::create([
            'nom' => 'Kg',
        ]);
        Unite::create([
            'nom' => 'Bloc',
        ]);
        Unite::create([
            'nom' => 'Barqt.',
        ]);

        Unite::create([
            'nom' => 'Pan.',
        ]);
        Unite::create([
            'nom' => 'Pavé',
        ]);
        Unite::create([
            'nom' => 'Pièce',
        ]);
        Unite::create([
            'nom' => 'Plat',
        ]);
        Unite::create([
            'nom' => 'Sachet.',
        ]);
        Unite::create([
            'nom' => 'Étui',
        ]);
        Unite::create([
            'nom' => 'Bande',
        ]);
        Unite::create([
            'nom' => 'Plaqt.',
        ]);
        Unite::create([
            'nom' => '6 Pièces',
        ]);

    }
}
