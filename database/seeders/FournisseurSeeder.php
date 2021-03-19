<?php

namespace Database\Seeders;

use App\Models\Fournisseur;
use Illuminate\Database\Seeder;

class FournisseurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Fournisseur::create([
            'name' => 'DELTA SEA FOOD',
            'ice' => 123456789000057,
            'code_comptable' => '4411',
            'designation' => 'Poissonnerie et commercialisation des produits de la mer',
            'idFiscal' => 123456789000157,
            'adresse' => 'CASA',
            'code_postal' => '20253',
            'ville' => 'CASABLANCA',
            'pays' => 'Maroc',
            'canton' => '',
            'phone' => '0603998685',
            'telephone_fixe' => '0503995687',
            'fax' => '',
            'email' => '',
            'mode_paiement_id' => 2,

        ]);

        Fournisseur::create([
            'name' => 'ABN SOFT',
            'code_comptable' => '4411',
            'ice' => 123456789000054,
            'designation' => 'Développement de logiciels de gestion spécialisés',
            'idFiscal' => 123456789000154,
            'adresse' => 'Casa',
            'code_postal' => '20253',
            'ville' => 'CASABLANCA',
            'pays' => 'Maroc',
            'canton' => '',
            'phone' => '0603997712',
            'telephone_fixe' => '0507835687',
            'fax' => '',
            'email' => '',
            'mode_paiement_id' => 2,

        ]);

        Fournisseur::create([
            'name' => 'AIR LIQUIDE',
            'code_comptable' => '4411',
            'ice' => 123456789000052,
            'designation' => 'Gaz industriels',
            'idFiscal' => 123456789000152,
            'adresse' => 'Casa',
            'code_postal' => '20253',
            'ville' => 'CASABLANCA',
            'pays' => 'Maroc',
            'canton' => '',
            'phone' => '0603997712',
            'telephone_fixe' => '0507835687',
            'fax' => '',
            'email' => '',
            'mode_paiement_id' => 2,

        ]);
        Fournisseur::create([
            'name' => 'YOZI FOOD',
            'code_comptable' => '4411',
            'ice' => 123456789000059,
            'designation' => 'Distribution des produits de la mer à la restauration, collectivités et traiteurs',
            'idFiscal' => 123456789000159,
            'adresse' => 'Marrakech',
            'code_postal' => '40000',
            'ville' => 'Marrakech',
            'pays' => 'Maroc',
            'canton' => '',
            'phone' => '0603997712',
            'telephone_fixe' => '0507835687',
            'fax' => '',
            'email' => '',
            'mode_paiement_id' => 2,
            'site_id' => 2,
            'interne' => true

        ]);

    }
}
