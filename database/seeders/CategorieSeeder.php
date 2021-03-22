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
            'nom' => 'Légumes',
        ]);
        Categorie::create([
            'nom' => 'Fruits',
        ]);
        Categorie::create([
            'nom' => 'Compléments alimentaires',
        ]);

        Categorie::create([
            'nom' => 'Produits élaborés',
        ]);

        Categorie::create([
            'nom' => 'Epicerie',
        ]);

        Categorie::create([
            'nom' => 'poissons',
        ]);

    }
}
