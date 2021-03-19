<?php

namespace Database\Seeders;

use App\Models\PrepartionNettoyage;
use Illuminate\Database\Seeder;

class PrepartionNettoyageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PrepartionNettoyage::create([
            'nom' => 'Non écaille',
        ]);
        PrepartionNettoyage::create([
            'nom' => 'Ecaille',
        ]);
        PrepartionNettoyage::create([
            'nom' => 'Filet',
        ]);
        PrepartionNettoyage::create([
            'nom' => 'Vidé',
        ]);
        PrepartionNettoyage::create([
            'nom' => 'Ouverture ventre',
        ]);
        PrepartionNettoyage::create([
            'nom' => 'Ouverture dos',
        ]);
        PrepartionNettoyage::create([
            'nom' => 'Décortiquee',
        ]);
        PrepartionNettoyage::create([
            'nom' => 'Décoquille',
        ]);
        PrepartionNettoyage::create([
            'nom' => 'Pave',
        ]);
        PrepartionNettoyage::create([
            'nom' => 'Darne',
        ]);
        PrepartionNettoyage::create([
            'nom' => 'Avec peau',
        ]);
        PrepartionNettoyage::create([
            'nom' => 'Sans peau',
        ]);
        PrepartionNettoyage::create([
            'nom' => 'Demi coquille',
        ]);
        PrepartionNettoyage::create([
            'nom' => 'Brochette',
        ]);
        PrepartionNettoyage::create([
            'nom' => 'Anneaux',
        ]);
        PrepartionNettoyage::create([
            'nom' => 'Avec coquilles',
        ]);
        PrepartionNettoyage::create([
            'nom' => 'Non décortiqué',
        ]);
        PrepartionNettoyage::create([
            'nom' => 'étêter',
        ]);
        PrepartionNettoyage::create([
            'nom' => 'Non étêter',
        ]);
        PrepartionNettoyage::create([
            'nom' => 'SANS PEAU CÔTÉ DOS',
        ]);
        PrepartionNettoyage::create([
            'nom' => 'Lamelles',
        ]);
        PrepartionNettoyage::create([
            'nom' => 'Steak',
        ]);

    }
}
