<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/create-fournisseur', \App\Http\Livewire\Paramétrage\CreateFournisseur::class)->name('create-fournisseur');
Route::middleware(['auth:sanctum', 'verified'])->get('/create-famille', \App\Http\Livewire\Paramétrage\CreateFamille::class)->name('create-famille');
Route::middleware(['auth:sanctum', 'verified'])->get('/create-sous-famille', \App\Http\Livewire\Paramétrage\CreateSousFamille::class)->name('create-sous-famille');
Route::middleware(['auth:sanctum', 'verified'])->get('/create-article', \App\Http\Livewire\Paramétrage\CreateArticle::class)->name('create-article');
Route::middleware(['auth:sanctum', 'verified'])->get('/create-departement', \App\Http\Livewire\CreateDepartement::class)->name('create-departement');
Route::middleware(['auth:sanctum', 'verified'])->get('/create-depot', \App\Http\Livewire\Paramétrage\CreateDepot::class)->name('create-depot');
Route::middleware(['auth:sanctum', 'verified'])->get('/create-site', \App\Http\Livewire\Paramétrage\CreateSite::class)->name('create-site');
Route::middleware(['auth:sanctum', 'verified'])->get('/stock', \App\Http\Livewire\Etat\Stock::class)->name('stock');

Route::middleware(['auth:sanctum', 'verified'])->get('/create-demande-achat', \App\Http\Livewire\Achat\CreateDemandeAchat::class)->name('create-demande-achat');
Route::middleware(['auth:sanctum', 'verified'])->get('/edit-demande-achat', \App\Http\Livewire\Achat\EditDemandeAchat::class)->name('edit-demande-achat');

Route::middleware(['auth:sanctum', 'verified'])->get('/assigner-bon-commande', \App\Http\Livewire\Achat\AssigneBonCommande::class)->name('assigner-bon-commande');
Route::middleware(['auth:sanctum', 'verified'])->get('/transfert-bon-commande-vente', \App\Http\Livewire\Vente\TransfertBonCommandeVente::class)->name('transfert-bon-commande-vente');
Route::middleware(['auth:sanctum', 'verified'])->get('/create-bon-commande', \App\Http\Livewire\Achat\CreateBonCommande::class)->name('create-bon-commande');
Route::middleware(['auth:sanctum', 'verified'])->get('/edit-bon-commande', \App\Http\Livewire\Achat\EditBonCommande::class)->name('edit-bon-commande');

Route::middleware(['auth:sanctum', 'verified'])->get('/show-bon-commande', \App\Http\Livewire\Achat\ShowBonCommande::class)->name('show-bon-commande');

Route::middleware(['auth:sanctum', 'verified'])->get('/create-bon-achat', \App\Http\Livewire\Achat\CreateBonAchat::class)->name('create-bon-achat');

Route::middleware(['auth:sanctum', 'verified'])->get('/create-client', \App\Http\Livewire\Paramétrage\CreateClient::class)->name('create-client');
Route::middleware(['auth:sanctum', 'verified'])->get('/edit-client', \App\Http\Livewire\Paramétrage\EditClient::class)->name('edit-client');

Route::middleware(['auth:sanctum', 'verified'])->get('/create-devis', \App\Http\Livewire\Vente\CreateDevis::class)->name('create-devis');
Route::middleware(['auth:sanctum', 'verified'])->get('/edit-devis', \App\Http\Livewire\Vente\EditDevis::class)->name('edit-devis');
Route::middleware(['auth:sanctum', 'verified'])->get('/transfert-devis', \App\Http\Livewire\Vente\TransfertDevis::class)->name('transfert-devis');

Route::middleware(['auth:sanctum', 'verified'])->get('/edit-bon-achat', \App\Http\Livewire\Achat\EditBonAchat::class)->name('edit-bon-achat');

Route::middleware(['auth:sanctum', 'verified'])->get('/create-bon-commande-vente', \App\Http\Livewire\Vente\CreateBonCommandeVente::class)->name('create-bon-commande-vente');
Route::middleware(['auth:sanctum', 'verified'])->get('/edit-bon-commande-vente', \App\Http\Livewire\Vente\EditBonCommandeVente::class)->name('edit-bon-commande-vente');

Route::middleware(['auth:sanctum', 'verified'])->get('/create-bon-livraison', \App\Http\Livewire\Vente\CreateBonLivraison::class)->name('create-bon-livraison');
Route::middleware(['auth:sanctum', 'verified'])->get('/edit-bon-livraison', \App\Http\Livewire\Vente\EditBonLivraison::class)->name('edit-bon-livraison');

Route::middleware(['auth:sanctum', 'verified'])->get('/create-commerciale', \App\Http\Livewire\Paramétrage\CreateCommerciale::class)->name('create-commerciale');
Route::middleware(['auth:sanctum', 'verified'])->get('/create-unite', \App\Http\Livewire\Paramétrage\CreateUnite::class)->name('create-unite');
Route::middleware(['auth:sanctum', 'verified'])->get('/create-compte', \App\Http\Livewire\Paramétrage\CreateCompte::class)->name('create-compte');

Route::middleware(['auth:sanctum', 'verified'])->get('/create-caisse', \App\Http\Livewire\Paramétrage\CreateCaisse::class)->name('create-caisse');


Route::middleware(['role:admin'])->get('/create-roles', \App\Http\Livewire\ParamétrageUtilisateurs\CreateRoles::class)->name('create-roles');

Route::middleware(['role:admin'])->get('/create-permissions', \App\Http\Livewire\ParamétrageUtilisateurs\CreatePermissions::class)->name('create-permissions');

Route::middleware(['role:admin'])->get('/edit-permission', \App\Http\Livewire\ParamétrageUtilisateurs\EditPermissions::class)->name('edit-permission');

Route::middleware(['role:admin'])->get('/edit-role', \App\Http\Livewire\ParamétrageUtilisateurs\EditRoles::class)->name('edit-role');

Route::middleware(['role:admin'])->get('/create-users', \App\Http\Livewire\ParamétrageUtilisateurs\CreateUsers::class)->name('create-users');
Route::middleware(['auth:sanctum', 'verified'])->get('/edit-user', \App\Http\Livewire\ParamétrageUtilisateurs\EditUser::class)->name('edit-user');

Route::middleware(['auth:sanctum', 'verified'])->get('/transfert-bon-commande', \App\Http\Livewire\Achat\TransfertBonCommande::class)->name('transfert-bon-commande');

Route::middleware(['auth:sanctum', 'verified'])->get('/create-mode-paiement', \App\Http\Livewire\Paramétrage\CreateModePaiement::class)->name('create-mode-paiement');
Route::middleware(['auth:sanctum', 'verified'])->get('/situation', \App\Http\Livewire\Situation::class)->name('situation');


Route::middleware(['auth:sanctum', 'verified'])->get('/edit-site', \App\Http\Livewire\Paramétrage\EditSite::class)->name('edit-site');
Route::middleware(['auth:sanctum', 'verified'])->get('/edit-depot', \App\Http\Livewire\Paramétrage\EditDepot::class)->name('edit-depot');
Route::middleware(['auth:sanctum', 'verified'])->get('/edit-famille', \App\Http\Livewire\Paramétrage\EditFamille::class)->name('edit-famille');
Route::middleware(['auth:sanctum', 'verified'])->get('/edit-sous-famille', \App\Http\Livewire\Paramétrage\EditSousFamille::class)->name('edit-sous-famille');
Route::middleware(['auth:sanctum', 'verified'])->get('/edit-unite', \App\Http\Livewire\Paramétrage\EditUnite::class)->name('edit-unite');
Route::middleware(['auth:sanctum', 'verified'])->get('/edit-compte', \App\Http\Livewire\Paramétrage\EditCompte::class)->name('edit-compte');
Route::middleware(['auth:sanctum', 'verified'])->get('/edit-caisse', \App\Http\Livewire\Paramétrage\EditCaisse::class)->name('edit-caisse');
Route::middleware(['auth:sanctum', 'verified'])->get('/edit-mode-paiement', \App\Http\Livewire\Paramétrage\EditModePaiement::class)->name('edit-mode-paiement');
Route::middleware(['auth:sanctum', 'verified'])->get('/edit-fournisseur', \App\Http\Livewire\Paramétrage\EditFournisseur::class)->name('edit-fournisseur');
Route::middleware(['auth:sanctum', 'verified'])->get('/create-compte-comptable', \App\Http\Livewire\Paramétrage\CreateCompteComptable::class)->name('create-compte-comptable');
Route::middleware(['auth:sanctum', 'verified'])->get('/edit-compte-comptable', \App\Http\Livewire\Paramétrage\EditCompteComptable::class)->name('edit-compte-comptable');

Route::middleware(['auth:sanctum', 'verified'])->get('/edit-article', \App\Http\Livewire\Paramétrage\EditArticle::class)->name('edit-article');

Route::middleware(['auth:sanctum', 'verified'])->get('/edit-commerciale', \App\Http\Livewire\Paramétrage\EditCommerciale::class)->name('edit-commerciale');

Route::middleware(['auth:sanctum', 'verified'])->get('/create-reglement-fournisseur', \App\Http\Livewire\Achat\CreateReglementFournisseur::class)->name('create-reglement-fournisseur');

Route::middleware(['role:admin'])->get('/create-charge', \App\Http\Livewire\ComptaFinance\CreateCharges::class)->name('create-charge');
Route::middleware(['role:admin'])->get('/create-charge-indirecte', \App\Http\Livewire\ComptaFinance\CreateChargeIndirecte::class)->name('create-charge-indirecte');
Route::middleware(['role:admin'])->get('/edit-charge', \App\Http\Livewire\ComptaFinance\EditCharge::class)->name('edit-charge');


Route::middleware(['auth:sanctum', 'verified'])->get('/edit-reglement-fournisseur', \App\Http\Livewire\Achat\EditReglementFournisseur::class)->name('edit-reglement-fournisseur');
Route::middleware(['auth:sanctum', 'verified'])->get('/journal-caisse', \App\Http\Livewire\JournalCaisse::class)->name('journal-caisse');
Route::middleware(['auth:sanctum', 'verified'])->get('/journal-banque', \App\Http\Livewire\JournalBanque::class)->name('journal-banque');


Route::middleware(['auth:sanctum', 'verified'])->get('/employes', \App\Http\Livewire\Employes::class)->name('employes');

Route::middleware(['auth:sanctum', 'verified'])->get('/journal-achat', \App\Http\Livewire\JournalAchat::class)->name('journal-achat');
Route::middleware(['auth:sanctum', 'verified'])->get('/create-production-parametre-fixe', \App\Http\Livewire\Paramétrage\CreateProductionParametreFixe::class)->name('create-production-parametre-fixe');
Route::middleware(['auth:sanctum', 'verified'])->get('/create-production-opération', \App\Http\Livewire\Paramétrage\CreateProductionOpération::class)->name('create-production-opération');
Route::middleware(['auth:sanctum', 'verified'])->get('/create-production-transformation', \App\Http\Livewire\Paramétrage\CreateProductionTransformation::class)->name('create-production-transformation');
Route::middleware(['auth:sanctum', 'verified'])->get('/pro-show', \App\Http\Livewire\Paramétrage\ProShow::class)->name('pro-show');

