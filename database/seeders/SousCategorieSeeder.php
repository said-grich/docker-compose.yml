<?php

namespace Database\Seeders;

use App\Models\SousCategorie;
use Illuminate\Database\Seeder;

class SousCategorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        ///// Poissons congelés

        SousCategorie::create([
            'nom' => 'Crustacés',
            'categorie_id' => 1 ,
        ]);

        SousCategorie::create([
            'nom' => 'Poissons nobles',
            'categorie_id' => 1 ,
        ]);

        SousCategorie::create([
            'nom' => 'Cephalopodes',
            'categorie_id' => 1 ,
        ]);

        SousCategorie::create([
            'nom' => 'Coquillages',
            'categorie_id' => 1 ,
        ]);

        SousCategorie::create([
            'nom' => 'Poissons bleus',
            'categorie_id' => 1 ,
        ]);

        SousCategorie::create([
            'nom' => 'Autres poissons',
            'categorie_id' => 1 ,
        ]);

        SousCategorie::create([
            'nom' => 'Panier',
            'categorie_id' => 1 ,
        ]);

        ///// Poissons frais

        SousCategorie::create([
            'nom' => 'Crustacés',
            'categorie_id' => 2 ,
        ]);

        SousCategorie::create([
            'nom' => '	Poissons bleus',
            'categorie_id' => 2 ,
        ]);

        SousCategorie::create([
            'nom' => 'Coquillages',
            'categorie_id' => 2 ,
        ]);

        SousCategorie::create([
            'nom' => 'Poissons nobles',
            'categorie_id' => 2 ,
        ]);

        SousCategorie::create([
            'nom' => 'Cephalopodes',
            'categorie_id' => 2 ,
        ]);

        SousCategorie::create([
            'nom' => 'Autres poissons',
            'categorie_id' => 2 ,
        ]);

        SousCategorie::create([
            'nom' => 'Epicerie',
            'categorie_id' => 2 ,
        ]);

        SousCategorie::create([
            'nom' => 'Poisson pour Friture',
            'categorie_id' => 2 ,
        ]);

        SousCategorie::create([
            'nom' => 'Poissons pour Four et Tajine',
            'categorie_id' => 2 ,
        ]);


        // ///// Poissons élaborés

        // SousCategorie::create([
        //     'nom' => 'Viande',
        //     'categorie_id' => 6 ,
        // ]);

        // SousCategorie::create([
        //     'nom' => 'Fish',
        //     'categorie_id' => 6 ,
        // ]);

        // SousCategorie::create([
        //     'nom' => 'Fish',
        //     'categorie_id' => 6 ,
        // ]);

        ///// Poissons Epicerie

        // SousCategorie::create([
        //     'nom' => 'Epicerie produits de mer',
        //     'categorie_id' => 7 ,
        // ]);


    }
}
