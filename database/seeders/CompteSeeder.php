<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Compte;


class CompteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Compte::create([
            'name' => 'CIH AZU-1',
            'site_id' => 1,
            'date' => '12/12/2020',
            'name_banque' => 'CIH',
            'num_compte' => '745643567468',
            'swift' => '75432541324',
            'type_compte' => 'Compte bancaire épargne/placement ',
            'pays_compte' => ' Maroc ',
            'devise' => 'MAD',
            'etat' => 'Ouvert',
            'compte_comptable_id' => 1,
            'code_comptable' => '5141',

        ]);

        Compte::create([
            'name' => 'CIH HOR-1',
            'site_id' => 3,
            'date' => '12/12/2020',
            'name_banque' => 'CIH',
            'num_compte' => '54524554587',
            'swift' => '4545455454',
            'pays_compte' => ' Maroc ',
            'type_compte' => 'Compte caisse/liquide',
            'devise' => 'MAD',
            'etat' => 'Ouvert',
            'compte_comptable_id' => 2,
            'code_comptable' => '5141',

        ]);

        Compte::create([
            'name' => 'CIH SFS-1',
            'site_id' => 2,
            'date' => '12/12/2020',
            'name_banque' => 'CIH',
            'num_compte' => '54524554587',
            'swift' => '4545455454',
            'pays_compte' => ' Maroc ',
            'type_compte' => 'Compte caisse/liquide',
            'devise' => 'MAD',
            'etat' => 'Ouvert',
            'compte_comptable_id' => 2,
            'code_comptable' => '5141',

        ]);




    }
}
