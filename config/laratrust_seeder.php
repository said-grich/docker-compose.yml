<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => true,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'admin' => [
            'utilisateurs' => 'c,r,u,d,au',
            'demande achat' => 'c,r,u,d,au',
            'bon commande' => 'c,r,u,d,au',
            'bon reception' => 'c,r,u,d',
            'devis' => 'c,r,u,d',
            'factures' => 'c,r,u,d',
            'bon livraison' => 'c,r,u,d',
        ],
        'magasinier' => [
            'demande achat' => 'c,r,u',
        ],
        /* 'directeur_achats' => [
            'demande achat' => 'c,r,u,d,au',
            'bon commande' => 'r,u',
        ],
        'responsable_achats' => [
            'demande achat' => 'c,r,u,d',
            'bon commande' => 'r,u',
            'bon reception' => 'r,u',
        ],
        'compta' => [
            'factures' => 'r',
        ], */
    ],

    'permissions_map' => [
        'c' => 'création',
        'r' => 'consultation',
        'u' => 'modification',
        'd' => 'suppression',
        'au' => 'autorisation',
    ]
];
