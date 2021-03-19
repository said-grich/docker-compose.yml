<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ArticleSeeder::class);
        $this->call(CaisseSeeder::class);
        $this->call(ClientSeeder::class);
        $this->call(CommercialSeeder::class);
        $this->call(CompteComptableSeeder::class);
        $this->call(CompteSeeder::class);
        $this->call(DepartementSeeder::class);
        $this->call(DepotSeeder::class);
        $this->call(FamilleSeeder::class);
        $this->call(FournisseurSeeder::class);
        $this->call(LaratrustSeeder::class);
        $this->call(ModePaiementSeeder::class);
        $this->call(SiteSeeder::class);
        $this->call(SousFamilleSeeder::class);
        $this->call(UniteSeeder::class);
        $this->call(VentilationSeeder::class);

        // \App\Models\User::factory(10)->create();
    }
}
