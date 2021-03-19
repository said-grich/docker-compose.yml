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
            'name' => '	ESPÈCES',
            'modalites_paiement' => '15jours',
        ]);

        ModePaiement::create([
            'name' => '	CHÈQUE',
            'modalites_paiement' => '20jours',
        ]);

        ModePaiement::create([
            'name' => '	VIREMENT',
            'modalites_paiement' => '30jours',
        ]);


    }
}
