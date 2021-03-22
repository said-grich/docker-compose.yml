<?php

namespace Database\Seeders;

use App\Models\ModePaiement;
use Illuminate\Database\Seeder;

class ModePaiementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ModePaiement::create([
            'nom' => '	ESPÈCES',
        ]);

        ModePaiement::create([
            'nom' => '	CHÈQUE',
        ]);

        ModePaiement::create([
            'nom' => '	VIREMENT',
        ]);


    }
}
