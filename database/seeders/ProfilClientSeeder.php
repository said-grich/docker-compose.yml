<?php

namespace Database\Seeders;

use App\Models\ProfilClient;
use Illuminate\Database\Seeder;

class ProfilClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProfilClient::create([
            'nom' => 'Normal',
        ]);
        ProfilClient::create([
            'nom' => 'Fidèle',
        ]);
        ProfilClient::create([
            'nom' => 'Business',
        ]);

    }
}
