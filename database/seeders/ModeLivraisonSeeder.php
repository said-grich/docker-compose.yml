<?php

namespace Database\Seeders;

use App\Models\ModeLivraison;
use App\Models\ModePaiement;
use Illuminate\Database\Seeder;

class ModeLivraisonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ModeLivraison::create([
            'nom' => 'À la livraison',
        ]);

        ModeLivraison::create([
            'nom' => 'Sur place',
        ]);

    }
}
