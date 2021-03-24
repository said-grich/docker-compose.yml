<?php

namespace Database\Seeders;

use App\Models\ModeVente;
use Illuminate\Database\Seeder;

class ModeVenteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ModeVente::create([
            'nom' => 'Poids par pièce',
        ]);

        ModeVente::create([
            'nom' => 'Kg',
        ]);

        ModeVente::create([
            'nom' => 'Pièce',
        ]);



    }
}
