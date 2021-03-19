<?php

namespace Database\Seeders;

use App\Models\Commerciale;
use Illuminate\Database\Seeder;

class CommercialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Commerciale::create([
            'name' => 'FATIMZAHRA',
            'phone' => '0123456789',
            'email' => 'f@gmail.com',
            'site_id' => [1,2],
        ]);
        Commerciale::create([
            'name' => 'KAMAR',
            'phone' => '0123456788',
            'email' => 'k@gmail.com',
            'site_id' => [1,2],
        ]);
        Commerciale::create([
            'name' => 'JAMALAIT',
            'phone' => '0123456787',
            'email' => 'j@gmail.com',
            'site_id' => [1,3],
        ]);
        Commerciale::create([
            'name' => 'Com. Interne',
            'phone' => '0123456786',
            'email' => 'c@gmail.com',
            'site_id' => [1,2],
        ]);
    }
}
