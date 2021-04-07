<?php

namespace Database\Seeders;

use App\Models\Ville;
use Illuminate\Database\Seeder;

class VilleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ville::create([
            'nom' => 'Casablance',
            'region_id'=> 1,
        ]);
        Ville::create([
            'nom' => 'Marrakech',
            'region_id'=> 2,
        ]);

        Ville::create([
            'nom' => 'Mohammedia',
            'region_id'=> 1,
        ]);

        Ville::create([
            'nom' => 'Rabat',
            'region_id'=> 3,
        ]);

        /* Ville::create([
            'nom' => 'Aïn Harrouda',
            'region_id'=> 6,
        ]);

        Ville::create([
            'nom' => 'Ben Yakhlef',
            'region_id'=> 6,
        ]);

        Ville::create([
            'nom' => 'Bouskoura',
            'region_id'=> 6,
        ]);

        Ville::create([
            'nom' => 'Casablanca',
            'region_id'=> 6,
        ]);

        Ville::create([
            'nom' => 'Médiouna',
            'region_id'=> 6,
        ]);

        Ville::create([
            'nom' => 'Mohammadia',
            'region_id'=> 6,
        ]);

        Ville::create([
            'nom' => 'Tit Mellil',
            'region_id'=> 6,
        ]);

        Ville::create([
            'nom' => 'Ben Yakhlef',
            'region_id'=> 6,
        ]);

        Ville::create([
            'nom' => 'Bejaâd',
            'region_id'=> 5,
        ]);

        Ville::create([
            'nom' => 'Ben Ahmed',
            'region_id'=> 6,
        ]);

        Ville::create([
            'nom' => 'Benslimane',
            'region_id'=> 6,
        ]);

        Ville::create([
            'nom' => 'Berrechid',
            'region_id'=> 6,
        ]);

        Ville::create([
            'nom' => 'Boujniba',
            'region_id'=> 5,
        ]);

        Ville::create([
            'nom' => 'Boulanouare',
            'region_id'=> 5,
        ]);

        Ville::create([
            'nom' => 'Bouznika',
            'region_id'=> 6,
        ]);

        Ville::create([
            'nom' => 'Deroua',
            'region_id'=> 6,
        ]);

        Ville::create([
            'nom' => 'El Borouj',
            'region_id'=> 6,
        ]);

        Ville::create([
            'nom' => 'El Gara',
            'region_id'=> 6,
        ]);

        Ville::create([
            'nom' => 'Guisser',
            'region_id'=> 6,
        ]);

        Ville::create([
            'nom' => 'Hattane',
            'region_id'=> 5,
        ]);

        Ville::create([
            'nom' => 'Khouribga',
            'region_id'=> 5,
        ]);

        Ville::create([
            'nom' => 'Loulad',
            'region_id'=> 6,
        ]);

        Ville::create([
            'nom' => 'Oued Zem',
            'region_id'=> 5,
        ]);

        Ville::create([
            'nom' => 'Oulad Abbou',
            'region_id'=> 6,
        ]);

        Ville::create([
            'nom' => "Oulad H''Riz Sahel",
            'region_id'=> 6,
        ]);

        Ville::create([
            'nom' => "Oulad Abbou",
            'region_id'=> 6,
        ]);

        Ville::create([
            'nom' => "Oulad H''Riz Sahel",
            'region_id'=> 6,
        ]);

        Ville::create([
            'nom' => "Oulad M''rah",
            'region_id'=> 6,
        ]);

        Ville::create([
            'nom' => "Oulad Saïd",
            'region_id'=> 6,
        ]);

        Ville::create([
            'nom' => "Oulad Sidi Ben Daoud",
            'region_id'=> 6,
        ]);

        Ville::create([
            'nom' => "Ras El Aïn",
            'region_id'=> 6,
        ]);

        Ville::create([
            'nom' => "Settat",
            'region_id'=> 6,
        ]);

        Ville::create([
            'nom' => "Sidi Rahhal Chataï",
            'region_id'=> 6,
        ]);

        Ville::create([
            'nom' => "Soualem",
            'region_id'=> 6,
        ]);

        Ville::create([
            'nom' => "Azemmour",
            'region_id'=> 6,
        ]);

        Ville::create([
            'nom' => "Bir Jdid",
            'region_id'=> 6,
        ]);

        Ville::create([
            'nom' => "Bouguedra",
            'region_id'=> 7,
        ]);

        Ville::create([
            'nom' => "Echemmaia",
            'region_id'=> 7,
        ]);

        Ville::create([
            'nom' => "El Jadida",
            'region_id'=> 6,
        ]);

        Ville::create([
            'nom' => "Hrara",
            'region_id'=> 7,
        ]);

        Ville::create([
            'nom' => "Ighoud",
            'region_id'=> 7,
        ]);

        Ville::create([
            'nom' => "Jamâat Shaim",
            'region_id'=> 7,
        ]);

        Ville::create([
            'nom' => "Jorf Lasfar",
            'region_id'=> 6,
        ]);

        Ville::create([
            'nom' => "Khemis Zemamra",
            'region_id'=> 6,
        ]);

        Ville::create([
            'nom' => "Laaounate",
            'region_id'=> 6,
        ]);

        Ville::create([
            'nom' => "Moulay Abdallah",
            'region_id'=> 6,
        ]);

        Ville::create([
            'nom' => "Oualidia",
            'region_id'=> 6,
        ]);

        Ville::create([
            'nom' => "Oulad Amrane",
            'region_id'=> 6,
        ]);

        Ville::create([
            'nom' => "Oulad Frej",
            'region_id'=> 6,
        ]);

        Ville::create([
            'nom' => "Oulad Ghadbane",
            'region_id'=> 6,
        ]);

        Ville::create([
            'nom' => "Safi",
            'region_id'=> 7,
        ]);

        Ville::create([
            'nom' => "Sebt El Maârif",
            'region_id'=> 6,
        ]);

        Ville::create([
            'nom' => "Sebt Gzoula",
            'region_id'=> 7,
        ]);

        Ville::create([
            'nom' => "Sidi Ahmed",
            'region_id'=> 7,
        ]);

        Ville::create([
            'nom' => "Sidi Ali Ban Hamdouche",
            'region_id'=> 6,
        ]);

        Ville::create([
            'nom' => "Sidi Bennour",
            'region_id'=> 6,
        ]);

        Ville::create([
            'nom' => "Sidi Bouzid",
            'region_id'=> 6,
        ]);

        Ville::create([
            'nom' => "Sidi Smaïl",
            'region_id'=> 6,
        ]);

        Ville::create([
            'nom' => "Youssoufia",
            'region_id'=> 7,
        ]);

        Ville::create([
            'nom' => "Fès",
            'region_id'=> 3,
        ]);

        Ville::create([
            'nom' => "Aïn Cheggag",
            'region_id'=> 3,
        ]);

        Ville::create([
            'nom' => "Bhalil",
            'region_id'=> 3,
        ]); */



    }
}
