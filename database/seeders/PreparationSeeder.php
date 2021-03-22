<?php

namespace Database\Seeders;

use App\Models\Preparation;
use Illuminate\Database\Seeder;

class PreparationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //preparations cuisine
        Preparation::create([
            'nom' => 'Four',
            'mode_preparation_id'=> 1,
        ]);
        Preparation::create([
            'nom' => 'Grillade',
            'mode_preparation_id'=> 1,
        ]);
        Preparation::create([
            'nom' => 'Tajine',
            'mode_preparation_id'=> 1,
        ]);
        Preparation::create([
            'nom' => 'Plancha',
            'mode_preparation_id'=> 1,
        ]);
        Preparation::create([
            'nom' => 'Friture',
            'mode_preparation_id'=> 1,
        ]);

        //preparations nettoyage
        Preparation::create([
            'nom' => 'Non écaille',
            'mode_preparation_id'=> 2,
        ]);
        Preparation::create([
            'nom' => 'Ecaille',
            'mode_preparation_id'=> 2,
        ]);
        Preparation::create([
            'nom' => 'Filet',
            'mode_preparation_id'=> 2,
        ]);
        Preparation::create([
            'nom' => 'Vidé',
            'mode_preparation_id'=> 2,
        ]);
        Preparation::create([
            'nom' => 'Ouverture ventre',
            'mode_preparation_id'=> 2,
        ]);
        Preparation::create([
            'nom' => 'Ouverture dos',
            'mode_preparation_id'=> 2,
        ]);
        Preparation::create([
            'nom' => 'Décortiquee',
            'mode_preparation_id'=> 2,
        ]);
        Preparation::create([
            'nom' => 'Décoquille',
            'mode_preparation_id'=> 2,
        ]);
        Preparation::create([
            'nom' => 'Pave',
            'mode_preparation_id'=> 2,
        ]);
        Preparation::create([
            'nom' => 'Darne',
            'mode_preparation_id'=> 2,
        ]);
        Preparation::create([
            'nom' => 'Avec peau',
            'mode_preparation_id'=> 2,
        ]);
        Preparation::create([
            'nom' => 'Sans peau',
            'mode_preparation_id'=> 2,
        ]);
        Preparation::create([
            'nom' => 'Demi coquille',
            'mode_preparation_id'=> 2,
        ]);
        Preparation::create([
            'nom' => 'Brochette',
            'mode_preparation_id'=> 2,
        ]);
        Preparation::create([
            'nom' => 'Anneaux',
            'mode_preparation_id'=> 2,
        ]);
        Preparation::create([
            'nom' => 'Avec coquilles',
            'mode_preparation_id'=> 2,
        ]);
        Preparation::create([
            'nom' => 'Non décortiqué',
            'mode_preparation_id'=> 2,
        ]);
        Preparation::create([
            'nom' => 'Étêter',
            'mode_preparation_id'=> 2,
        ]);
        Preparation::create([
            'nom' => 'Non étêter',
            'mode_preparation_id'=> 2,
        ]);
        Preparation::create([
            'nom' => 'Sans peau côté dos',
            'mode_preparation_id'=> 2,
        ]);
        Preparation::create([
            'nom' => 'Lamelles',
            'mode_preparation_id'=> 2,
        ]);
        Preparation::create([
            'nom' => 'Steak',
            'mode_preparation_id'=> 2,
        ]);

    }
}
