<?php

namespace Database\Seeders;

use App\Models\CompteComptable;
use Illuminate\Database\Seeder;

class CompteComptableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CompteComptable::create([
            'code' => '4411',
            'name' => 'Fournisseurs',
        ]);

        CompteComptable::create([
            'code' => '44111',
            'name' => 'Fournisseurs - catégorie A',
        ]);

        CompteComptable::create([
            'code' => '44112',
            'name' => 'Fournisseurs - catégorie B',
        ]);

        CompteComptable::create([
            'code' => '4413',
            'name' => 'Fournisseurs - retenues de garantie',
        ]);

        CompteComptable::create([
            'code' => '3455',
            'name' => 'Etat - TVA récupérable',
        ]);

        CompteComptable::create([
            'code' => '34552',
            'name' => 'Etat - TVA récupérable sur charges',
        ]);

        CompteComptable::create([
            'code' => '3456',
            'name' => 'Etat - crédit de TVA (suivant déclaration)',
        ]);

        CompteComptable::create([
            'code' => '3458',
            'name' => 'Etat - autres comptes débiteurs',
        ]);

        CompteComptable::create([
            'code' => '34551',
            'name' => 'Etat - TVA récupérable sur immobilisations',
        ]);

        CompteComptable::create([
            'code' => '61',
            'name' => 'CHARGES D\'EXPLOITATION',
        ]);
        CompteComptable::create([
            'code' => '611',
            'name' => 'Achats revendus de marchandises',
        ]);
        CompteComptable::create([
            'code' => '6111',
            'name' => 'Achats de marchandises "groupe A"',
        ]);
        CompteComptable::create([
            'code' => '6112',
            'name' => 'Achats de marchandises "groupe B"',
        ]);

        CompteComptable::create([
            'code' => '6114',
            'name' => 'Variation de stocks de marchandises',
        ]);
        CompteComptable::create([
            'code' => '6118',
            'name' => 'Achats revendus de marchandises des exercices antérieurs',
        ]);
        CompteComptable::create([
            'code' => '6119',
            'name' => 'Rabais, remises et ristournes obtenus sur achats de marchandises',
        ]);
        CompteComptable::create([
            'code' => '612',
            'name' => 'Achats consommés de matières et fournitures',
        ]);
        CompteComptable::create([
            'code' => '6121',
            'name' => '	Achats de matières premières',
        ]);
        CompteComptable::create([
            'code' => '61211',
            'name' => '	Achats de matières premières A',
        ]);
        CompteComptable::create([
            'code' => '61212',
            'name' => '	Achats de matières premières B',
        ]);
        CompteComptable::create([
            'code' => '61223',
            'name' => 'Achats de combustibles',
        ]);
        CompteComptable::create([
            'code' => '61224',
            'name' => 'Achats de fournitures magasin',
        ]);

    }
}
