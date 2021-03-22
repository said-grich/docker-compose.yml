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
        /* $this->call(ArticleSeeder::class);
        $this->call(CaisseSeeder::class);
        $this->call(ClientSeeder::class);
        $this->call(CommercialSeeder::class);
        $this->call(CompteComptableSeeder::class);
        $this->call(CompteSeeder::class);*/
        $this->call(RegionSeeder::class);
        $this->call(DepotSeeder::class);
        $this->call(FamilleSeeder::class);
        $this->call(CategorieSeeder::class);
        $this->call(SousCategorieSeeder::class);
        $this->call(FournisseurSeeder::class);
        $this->call(LaratrustSeeder::class);
        $this->call(ModePaiementSeeder::class);
        $this->call(ModePreparationSeeder::class);
        $this->call(ProfilClientSeeder::class);
        $this->call(PreparationSeeder::class);
        //$this->call(PrepartionNettoyageSeeder::class);
        $this->call(UniteSeeder::class);

        // \App\Models\User::factory(10)->create();
    }
}
