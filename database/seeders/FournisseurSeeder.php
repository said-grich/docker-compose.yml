<?php

namespace Database\Seeders;

use App\Models\Fournisseur;
use Illuminate\Database\Seeder;

class FournisseurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Fournisseur::create([
            'nom' => 'AZUL FISH',
            'tel' => '06666666',
            //'ville' => 'CASABLANCA',
            /* 'contact' => '', */

        ]);

        Fournisseur::create([
            'nom' => 'Scandimar',
            'tel'=> '0523302044',
            //'ville' => 'Mohammedia',
            /* 'contact' => '', */

        ]);

        Fournisseur::create([
            'nom' => 'STE wadii pescados',
            'tel' => '0661330512',
            //'ville' => 'Safi',
            /* 'contact' => '', */

        ]);

        Fournisseur::create([
            'nom' => 'Aabou abdellah',
            'tel' => '0662743055',
            //'ville' => 'LAAYOUNE',
            /* 'contact' => '', */

        ]);

        /* Fournisseur::create([
            'nom' => 'MUSTAPHA MAOUHOUB',
            'tel' => '',
        ]); */

    }
}
