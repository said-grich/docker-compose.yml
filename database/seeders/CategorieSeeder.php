<?php

namespace Database\Seeders;

use App\Models\Categorie;
use Illuminate\Database\Seeder;

class CategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Categorie::create([
            'nom' => 'Poissons congelés',
        ]);
        
        Categorie::create([
            'nom' => 'Poissons frais',
        ]);

        Categorie::create([
            'nom' => 'Epicerie',
        ]);


    }
}
