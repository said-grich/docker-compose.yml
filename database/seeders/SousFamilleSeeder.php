<?php

namespace Database\Seeders;

use App\Models\SousFamille;
use Illuminate\Database\Seeder;

class SousFamilleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SousFamille::create([
            'code' => 'SF00001',
            'name' => 'Sous famille 1',
        ]);

        SousFamille::create([
            'code' => 'SF00002',
            'name' => 'Sous famille 2',
        ]);
    }
}
