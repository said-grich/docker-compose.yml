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

        $this->call(RegionSeeder::class);
        $this->call(VilleSeeder::class);
        $this->call(VilleZoneSeeder::class);
        $this->call(VilleQuartierSeeder::class);
        $this->call(DepotSeeder::class);
        $this->call(FamilleSeeder::class);
        $this->call(CategorieSeeder::class);
        $this->call(SousCategorieSeeder::class);
        $this->call(QualiteSeeder::class);
        $this->call(FournisseurSeeder::class);
        $this->call(LaratrustSeeder::class);
        $this->call(ModePaiementSeeder::class);
        $this->call(ModeLivraisonSeeder::class);
        $this->call(ModePreparationSeeder::class);
        $this->call(ModeVenteSeeder::class);
        $this->call(ProfilClientSeeder::class);
        $this->call(PreparationSeeder::class);
        $this->call(UniteSeeder::class);
        $this->call(TrancheKgPcSeeder::class);
        $this->call(TranchePoidsPcSeeder::class);
        $this->call(LivreurSeeder::class);

        // \App\Models\User::factory(10)->create();
    }
}
