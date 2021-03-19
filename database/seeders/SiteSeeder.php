<?php

namespace Database\Seeders;

use App\Models\Site;
use Illuminate\Database\Seeder;

class SiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Site::create([
            'code' => 'S0001',
            'name' => 'AZU',
            'adresse' => 'CASA',
            'ville' => 'CASABLANCA',
            'pays' => 'Maroc',

        ]);
        Site::create([
            'code' => 'S0003',
            'name' => 'SFS',
            'adresse' => 'LAAYOUNE',
            'ville' => 'LAAYOUNE',
            'pays' => 'Maroc',

        ]);
        Site::create([
            'code' => 'S0004',
            'name' => 'HOR',
            'adresse' => 'LAAYOUNE',
            'ville' => 'LAAYOUNE',
            'pays' => 'Maroc',

        ]);
    }
}
