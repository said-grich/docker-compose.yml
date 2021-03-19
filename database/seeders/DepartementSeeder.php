<?php

namespace Database\Seeders;

use App\Models\Departement;
use Illuminate\Database\Seeder;

class DepartementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Departement::create([
            'code' => 'DPR',
            'departement' => 'Production',
        ]);

        Departement::create([
            'code' => 'DA',
            'departement' => 'Achat',
        ]);

        Departement::create([
            'code' => 'DV',
            'departement' => 'Vente',
        ]);

        Departement::create([
            'code' => 'DI',
            'departement' => 'Inventaire',
        ]);

        Departement::create([
            'code' => 'DFC',
            'departement' => 'Finance/Compta',
        ]);
    }
}
