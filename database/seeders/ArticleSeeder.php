<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        Article::create([
            'code' => 'AR00089',
            'code_fournisseur' => 'AR50089',
            'libelle' => 'PUNTILLA-0.5KG-BLOC//',
            'famille_id' => 1,
            'fournisseur_id' => [1,2],
            'code_comptable' => 3,
            'assujetti_tva' => 'Oui',
            'tva' => 10,
            'qte_minimum' => '300',
            'qte_securite' => '600',
            'unite_achat_id' => 3,
            'unite_vente_id' => 7,
            'unite_affichee_id' => 7,
            'sous_famille_id' => 1,
            'marge' => 120,

        ]);


        Article::create([
            'code' => 'AR00087',
            'code_fournisseur' => 'AR57089',
            'libelle' => 'SAUMON-0.6KG-BLOC//',
            'famille_id' => 2,
            'fournisseur_id' => [1,2],
            'code_comptable' => 2,
            'assujetti_tva' => 'Oui',
            'tva' => 20,
            'qte_minimum' => '400',
            'qte_securite' => '600',
            'unite_achat_id' => 5,
            'unite_vente_id' => 7,
            'unite_affichee_id' => 7,
            'sous_famille_id' => 1,
            'marge' => 100,

        ]);

        Article::create([
            'code' => 'AR00088',
            'code_fournisseur' => 'AR54089',
            'libelle' => 'ABADECHE-VRAC//',
            'famille_id' => 2,
            'fournisseur_id' => [1,2],
            'code_comptable' => 1,
            'assujetti_tva' => 'Oui',
            'tva' => 20,
            'qte_minimum' => '400',
            'qte_securite' => '600',
            'unite_achat_id' => 5,
            'unite_vente_id' => 7,
            'unite_affichee_id' => 7,
            'sous_famille_id' => 1,
            'marge' => 180,

        ]);

        Article::create([
            'code' => 'AR00086',
            'code_fournisseur' => 'AR500089',
            'libelle' => 'MOULES-DECOQUILLES-100/200-1KG-SACHT//',
            'famille_id' => 2,
            'fournisseur_id' => [1,2],
            'code_comptable' => 1,
            'assujetti_tva' => 'Oui',
            'tva' => 20,
            'qte_minimum' => '400',
            'qte_securite' => '600',
            'unite_achat_id' => 5,
            'unite_vente_id' => 7,
            'unite_affichee_id' => 7,
            'sous_famille_id' => 1,
            'marge' => 80,

        ]);

        Article::create([
            'code' => 'AR00085',
            'code_fournisseur' => 'AR50088',
            'libelle' => 'STEAK-ESPADON-1KG-SACHT//',
            'famille_id' => 2,
            'fournisseur_id' => [1,2],
            'code_comptable' => 1,
            'assujetti_tva' => 'Oui',
            'tva' => 14,
            'qte_minimum' => '400',
            'qte_securite' => '600',
            'unite_achat_id' => 5,
            'unite_vente_id' => 7,
            'unite_affichee_id' => 7,
            'sous_famille_id' => 1,
            'marge' => 160,

        ]);

        Article::create([
            'code' => 'AR00084',
            'code_fournisseur' => 'AR50086',
            'libelle' => 'CIGALA-0.5KG-BARQT//',
            'famille_id' => 1,
            'fournisseur_id' => [1,2],
            'code_comptable' => 1,
            'assujetti_tva' => 'Oui',
            'tva' => 14,
            'qte_minimum' => '400',
            'qte_securite' => '600',
            'unite_achat_id' => 5,
            'unite_vente_id' => 7,
            'unite_affichee_id' => 7,
            'sous_famille_id' => 1,
            'marge' => 200,

        ]);

        Article::create([
            'code' => 'AR00083',
            'code_fournisseur' => 'AR50079',
            'libelle' => 'PLAQ-SAUMON-FUME-50GRS//',
            'famille_id' => 1,
            'fournisseur_id' => [1,2],
            'code_comptable' => 1,
            'assujetti_tva' => 'Oui',
            'tva' => 10,
            'qte_minimum' => '400',
            'qte_securite' => '600',
            'unite_achat_id' => 5,
            'unite_vente_id' => 7,
            'unite_affichee_id' => 7,
            'sous_famille_id' => 1,
            'marge' => 100,

        ]);

        Article::create([
            'code' => 'AR00082',
            'code_fournisseur' => 'AR60089',
            'libelle' => 'CR.GRISES-40/50-2KG/BRUTE-ETUI//',
            'famille_id' => 1,
            'fournisseur_id' => [1,2],
            'code_comptable' => 1,
            'assujetti_tva' => 'Oui',
            'tva' => 14,
            'qte_minimum' => '400',
            'qte_securite' => '600',
            'unite_achat_id' => 5,
            'unite_vente_id' => 7,
            'unite_affichee_id' => 7,
            'sous_famille_id' => 1,
            'marge' => 90,

        ]);

        Article::create([
            'code' => 'AR00081',
            'code_fournisseur' => 'AR50086',
            'libelle' => 'CALAMAR-NETOY-PATAG-0.5KG-BARQT//',
            'famille_id' => 2,
            'fournisseur_id' => [1,2],
            'code_comptable' => 1,
            'assujetti_tva' => 'Oui',
            'tva' => 7,
            'qte_minimum' => '400',
            'qte_securite' => '600',
            'unite_achat_id' => 5,
            'unite_vente_id' => 7,
            'unite_affichee_id' => 7,
            'sous_famille_id' => 1,
            'marge' => 100,

        ]);

        Article::create([
            'code' => 'AR00080',
            'code_fournisseur' => 'AR500899',
            'libelle' => 'FRITES-10/10-10KG//',
            'famille_id' => 2,
            'fournisseur_id' => [1,2],
            'code_comptable' => 1,
            'assujetti_tva' => 'Oui',
            'tva' => 7,
            'qte_minimum' => '400',
            'qte_securite' => '600',
            'unite_achat_id' => 5,
            'unite_vente_id' => 7,
            'unite_affichee_id' => 7,
            'sous_famille_id' => 1,
            'marge' => 80,

        ]);

        Article::create([
            'code' => 'AR00070',
            'code_fournisseur' => 'AR50079',
            'libelle' => 'FRITES-7/7-10KG//',
            'famille_id' => 1,
            'fournisseur_id' => [1,2],
            'code_comptable' => 1,
            'assujetti_tva' => 'Oui',
            'tva' => 20,
            'qte_minimum' => '400',
            'qte_securite' => '600',
            'unite_achat_id' => 5,
            'unite_vente_id' => 7,
            'unite_affichee_id' => 7,
            'sous_famille_id' => 1,
            'marge' => 100,

        ]);

    }
}
