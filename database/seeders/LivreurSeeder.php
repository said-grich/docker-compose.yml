<?php

namespace Database\Seeders;

use App\Models\Livreur;
use Illuminate\Database\Seeder;

class LivreurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Livreur::create([
            'nom' => 'Alex',
            'cin' => 'EE1234',
            'tel' => '1234567890',
            'type' => 'Interne',
            'ville_id' => 1,
        ]);

        Livreur::create([
            'nom' => 'John',
            'cin' => 'EE1235',
            'tel' => '0123456789',
            'type' => 'Externe',
            'ville_id' => 2,
        ]);

    }
}
