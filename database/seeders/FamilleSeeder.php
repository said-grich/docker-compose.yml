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
            'nom' => 'Espadon',
        ]);
        Famille::create([
            'nom' => 'Saumon',
        ]);
         Famille::create([
            'nom' => 'Thon',
        ]);
        Famille::create([
            'nom' => 'Courbine',
        ]);
        Famille::create([
            'nom' => 'Seiche',
        ]);

        Famille::create([
            'nom' => 'Panier',
        ]);

        Famille::create([
            'nom' => 'Moules',
        ]);

        Famille::create([
            'nom' => 'Crevette',
        ]);

        Famille::create([
            'nom' => 'Calamar',
        ]);

        Famille::create([
            'nom' => 'Merlan',
        ]);

        Famille::create([
            'nom' => 'Dorade',
        ]);

        Famille::create([
            'nom' => 'Loup bar',
        ]);

        Famille::create([
            'nom' => 'Langouste',
        ]);
    }
}
