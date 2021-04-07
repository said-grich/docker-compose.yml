<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Region::create([
            'nom' => 'Casablanca et voisinage',
        ]);
        Region::create([
            'nom' => 'Marrakech',
        ]);
         Region::create([
            'nom' => 'Rabat',
        ]);

        /* Region::create([
            'nom' => 'Tanger-Tétouan-Al Hoceïma',
        ]);

        Region::create([
            'nom' => "l'Oriental",
        ]);

        Region::create([
            'nom' => "Fès-Meknès",
        ]);

        Region::create([
            'nom' => "Rabat-Salé-Kénitra",
        ]);

        Region::create([
            'nom' => "Béni Mellal-Khénifra",
        ]);

        Region::create([
            'nom' => "Casablanca-Settat",
        ]);

        Region::create([
            'nom' => "Marrakech-Safi",
        ]);

        Region::create([
            'nom' => "Drâa-Tafilalet",
        ]);

        Region::create([
            'nom' => "Souss-Massa",
        ]);

        Region::create([
            'nom' => "Guelmim-Oued Noun",
        ]);

        Region::create([
            'nom' => "Laâyoune-Sakia El Hamra",
        ]);

        Region::create([
            'nom' => "Dakhla-Oued Ed Dahab",
        ]); */

    }
}
