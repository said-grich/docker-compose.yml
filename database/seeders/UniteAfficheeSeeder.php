<?php

namespace Database\Seeders;

use App\Models\UniteAffichee;
use Illuminate\Database\Seeder;

class UniteAfficheeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UniteAffichee::create([
            'nom' => 'Kg',
        ]);
        UniteAffichee::create([
            'nom' => 'Bloc',
        ]);
        UniteAffichee::create([
            'nom' => 'Barqt.',
        ]);

        UniteAffichee::create([
            'nom' => 'Pan.',
        ]);
        UniteAffichee::create([
            'nom' => 'Pavé',
        ]);
        UniteAffichee::create([
            'nom' => 'Pièce',
        ]);
        UniteAffichee::create([
            'nom' => 'Plat',
        ]);
        UniteAffichee::create([
            'nom' => 'Sachet.',
        ]);
        UniteAffichee::create([
            'nom' => 'Étui',
        ]);
        UniteAffichee::create([
            'nom' => 'Bande',
        ]);
        UniteAffichee::create([
            'nom' => 'Plaqt.',
        ]);
        UniteAffichee::create([
            'nom' => '6 Pièces',
        ]);

    }
}
