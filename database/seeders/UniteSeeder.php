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
            'name' => 'Kg',
        ]);
        Unite::create([
            'name' => 'Bloc',
        ]);
        Unite::create([
            'name' => 'Barqt.',
        ]);

        Unite::create([
            'name' => 'Pan.',
        ]);
        Unite::create([
            'name' => 'Pavé',
        ]);
        Unite::create([
            'name' => 'Pièce',
        ]);
        Unite::create([
            'name' => 'Plat',
        ]);
        Unite::create([
            'name' => 'Sachet.',
        ]);
        Unite::create([
            'name' => 'Étui',
        ]);
        Unite::create([
            'name' => 'Bande',
        ]);
        Unite::create([
            'name' => 'Plaqt.',
        ]);
        Unite::create([
            'name' => '6 Pièces',
        ]);

    }
}
