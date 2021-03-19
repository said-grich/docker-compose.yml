<?php

namespace Database\Seeders;

use App\Models\Ventilation;
use Illuminate\Database\Seeder;

class VentilationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $ventilation7 = collect([
            ['Achats non immobilisés' =>
                ['151' => "Achat à l'importation",
                '152' => "Achat à l'intérieur",
                '169' => "Autres immobilisations",
                ],
            ],
        ]);

        $ventilation10 = collect([
            ['Achats non immobilisés' =>
                ['142' => "Opération de banque",
                '143' => "Hôtels & immobilier touristique",
                '144' => "Opérations avocats, interprètes, notaires, vétérinaires",
                '153' => "Autres prestations de services ",
                '149' => "Achat à l'importation",
                '150' => "Achat à l'interieur",
                ],
            ],
        ]);

        $ventilation14 = collect([
            ['Achats non immobilisés' =>
                ['141' => "Transport",
                '147' => "Achat à l'importation",
                '148' => "Achat à l'interieur",
                ],
            ],
            ['Immobilisations' =>
                [' 168 ' => "Autres immobilisations"],
            ],
        ]);

        $ventilation20 = collect([
            ['Achats non immobilisés' =>
                ['140' => "Prestation de services",
                '145' => "Achat a l'importation",
                '146' => "Achat a l'interieur",
                '155' => "Travaux a façon",
                '156' => "Sous traitance (travaux immobiliers)",
                ],
            ],
            ['Immobilisations' =>
                ['162' => "Achat a l'importation",
                '163' => "Achat a l'interieur",
                '164' => "Livraison a soi-meme autre que les constructions",
                '165' => "Installation & pose",
                '166' => "Constructions",
                '167' => "Livraison a soi-meme de constructions"

                ],

            ],
        ]);

        Ventilation::create([
            'taux' => 7,
            'details' =>  $ventilation7->toArray(),
        ]);

        Ventilation::create([
            'taux' => 10,
            'details' =>  $ventilation10->toArray(),
        ]);

        Ventilation::create([
            'taux' => 14,
            'details' =>  $ventilation14->toArray(),
        ]);

        Ventilation::create([
            'taux' => 20,
            'details' =>  $ventilation20->toArray(),
        ]);
        /* Ventilation::create([
            'taux' => 20,
            'type' => "ACHATS NON IMMOBILISÉS",
            'code' => 140,
            'libelle' => 'PRESTATION DE SERVICES',
        ]);
        Ventilation::create([
            'taux' => 20,
            'type' => "ACHATS NON IMMOBILISÉS",
            'code' => 145,
            'libelle' => "ACHAT A L'IMPORTATION",
        ]);
        Ventilation::create([
            'taux' => 20,
            'type' => "ACHATS NON IMMOBILISÉS",
            'code' => 146,
            'libelle' => "ACHAT A L'INTERIEUR",
        ]);
        Ventilation::create([
            'taux' => 20,
            'type' => "ACHATS NON IMMOBILISÉS",
            'code' => 155,
            'libelle' => "TRAVAUX A FAÇON",
        ]);
        Ventilation::create([
            'taux' => 20,
            'type' => "ACHATS NON IMMOBILISÉS",
            'code' => 156,
            'libelle' => "SOUS TRAITANCE (TRAVAUX IMMOBILIERS)",
        ]); */
    }
}
