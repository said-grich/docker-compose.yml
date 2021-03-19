<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Client::create([
            'name' => 'ACOmreA',
            'user_id' => 1,
            'date_inscription' => "2000-01-01",
            'industrie' => 'fish',
            'langue' => 'FR',

            'agent_nom' => 'el alawi',
            'agent_prenom' => 'tahaa',
            'tele_agent' => '06016546855',
            'genre_agent' => 'M',
            'email_agent' => 'taha@gmail.com',
            'poste_agent' => 'Commercial',

            'tele_professionnel' => '0524242424',
            'tele_portable' => '0606060606',
            'fax' => '0524242424',
            'email' => 'azsdfulla@gmail.com',
            'site_internet' => 'gcam.com',
            'linkedin' => 'linkedin.com',
            'devise' => 'MAD',

            'mode_paiement' => 'Espéce',
            'capitale' => '10000',

        ]);

        Client::create([

            'name' => 'Oyama',
            'user_id' => 1,
            'date_inscription' => "2000-01-01",
            'industrie' => 'fish',
            'langue' => 'FR',

            'agent_nom' => 'el alawi',
            'agent_prenom' => 'Nora',
            'tele_agent' => '06016546855',
            'genre_agent' => 'F',
            'email_agent' => 'nora@gmail.com',
            'poste_agent' => 'Commercial',

            'tele_professionnel' => '0524242424',
            'tele_portable' => '0606060606',
            'fax' => '0524242424',
            'email' => 'azsdfulla@gmail.com',
            'site_internet' => 'gcam.com',
            'linkedin' => 'linkedin.com',
            'devise' => 'MAD',

            'mode_paiement' => 'Espéce',
            'capitale' => '1000000',

        ]);
    }
}
