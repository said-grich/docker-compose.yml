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


// Route::get('/', function () {
//     return view('livewire.frontend.index');
// });

Route::get('/', \App\Http\Livewire\Frontend\Index::class)->name('index');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/create-fournisseur', \App\Http\Livewire\Parametrage\CreateFournisseur::class)->name('create-fournisseur');
Route::middleware(['auth:sanctum', 'verified'])->get('/create-famille', \App\Http\Livewire\Parametrage\CreateFamille::class)->name('create-famille');
Route::middleware(['auth:sanctum', 'verified'])->get('/create-sous-famille', \App\Http\Livewire\Parametrage\CreateSousFamille::class)->name('create-sous-famille');
Route::middleware(['auth:sanctum', 'verified'])->get('/create-article', \App\Http\Livewire\Parametrage\CreateArticle::class)->name('create-article');
Route::middleware(['auth:sanctum', 'verified'])->get('/create-departement', \App\Http\Livewire\CreateDepartement::class)->name('create-departement');
Route::middleware(['auth:sanctum', 'verified'])->get('/create-site', \App\Http\Livewire\Parametrage\CreateSite::class)->name('create-site');
Route::middleware(['auth:sanctum', 'verified'])->get('/stock', \App\Http\Livewire\Etat\Stock::class)->name('stock');

Route::middleware(['auth:sanctum', 'verified'])->get('/create-demande-achat', \App\Http\Livewire\Achat\CreateDemandeAchat::class)->name('create-demande-achat');
Route::middleware(['auth:sanctum', 'verified'])->get('/edit-demande-achat', \App\Http\Livewire\Achat\EditDemandeAchat::class)->name('edit-demande-achat');

Route::middleware(['auth:sanctum', 'verified'])->get('/assigner-bon-commande', \App\Http\Livewire\Achat\AssigneBonCommande::class)->name('assigner-bon-commande');
Route::middleware(['auth:sanctum', 'verified'])->get('/transfert-bon-commande-vente', \App\Http\Livewire\Vente\TransfertBonCommandeVente::class)->name('transfert-bon-commande-vente');
Route::middleware(['auth:sanctum', 'verified'])->get('/create-bon-commande', \App\Http\Livewire\Achat\CreateBonCommande::class)->name('create-bon-commande');
Route::middleware(['auth:sanctum', 'verified'])->get('/edit-bon-commande', \App\Http\Livewire\Achat\EditBonCommande::class)->name('edit-bon-commande');

Route::middleware(['auth:sanctum', 'verified'])->get('/show-bon-commande', \App\Http\Livewire\Achat\ShowBonCommande::class)->name('show-bon-commande');

Route::middleware(['auth:sanctum', 'verified'])->get('/create-bon-achat', \App\Http\Livewire\Achat\CreateBonAchat::class)->name('create-bon-achat');

Route::middleware(['auth:sanctum', 'verified'])->get('/create-client', \App\Http\Livewire\Parametrage\CreateClient::class)->name('create-client');
Route::middleware(['auth:sanctum', 'verified'])->get('/edit-client', \App\Http\Livewire\Parametrage\EditClient::class)->name('edit-client');

Route::middleware(['auth:sanctum', 'verified'])->get('/create-devis', \App\Http\Livewire\Vente\CreateDevis::class)->name('create-devis');
Route::middleware(['auth:sanctum', 'verified'])->get('/edit-devis', \App\Http\Livewire\Vente\EditDevis::class)->name('edit-devis');
Route::middleware(['auth:sanctum', 'verified'])->get('/transfert-devis', \App\Http\Livewire\Vente\TransfertDevis::class)->name('transfert-devis');

Route::middleware(['auth:sanctum', 'verified'])->get('/edit-bon-achat', \App\Http\Livewire\Achat\EditBonAchat::class)->name('edit-bon-achat');

Route::middleware(['auth:sanctum', 'verified'])->get('/create-bon-commande-vente', \App\Http\Livewire\Vente\CreateBonCommandeVente::class)->name('create-bon-commande-vente');
Route::middleware(['auth:sanctum', 'verified'])->get('/edit-bon-commande-vente', \App\Http\Livewire\Vente\EditBonCommandeVente::class)->name('edit-bon-commande-vente');

Route::middleware(['auth:sanctum', 'verified'])->get('/create-bon-livraison', \App\Http\Livewire\Vente\CreateBonLivraison::class)->name('create-bon-livraison');
Route::middleware(['auth:sanctum', 'verified'])->get('/edit-bon-livraison', \App\Http\Livewire\Vente\EditBonLivraison::class)->name('edit-bon-livraison');

Route::middleware(['auth:sanctum', 'verified'])->get('/create-commerciale', \App\Http\Livewire\Parametrage\CreateCommerciale::class)->name('create-commerciale');
Route::middleware(['auth:sanctum', 'verified'])->get('/create-compte', \App\Http\Livewire\Parametrage\CreateCompte::class)->name('create-compte');

Route::middleware(['auth:sanctum', 'verified'])->get('/create-caisse', \App\Http\Livewire\Parametrage\CreateCaisse::class)->name('create-caisse');


Route::middleware(['role:admin'])->get('/create-roles', \App\Http\Livewire\ParametrageUtilisateurs\CreateRoles::class)->name('create-roles');

Route::middleware(['role:admin'])->get('/create-permissions', \App\Http\Livewire\ParametrageUtilisateurs\CreatePermissions::class)->name('create-permissions');

Route::middleware(['role:admin'])->get('/edit-permission', \App\Http\Livewire\ParametrageUtilisateurs\EditPermissions::class)->name('edit-permission');

Route::middleware(['role:admin'])->get('/edit-role', \App\Http\Livewire\ParametrageUtilisateurs\EditRoles::class)->name('edit-role');

Route::middleware(['role:admin'])->get('/create-users', \App\Http\Livewire\ParametrageUtilisateurs\CreateUsers::class)->name('create-users');
Route::middleware(['auth:sanctum', 'verified'])->get('/edit-user', \App\Http\Livewire\ParametrageUtilisateurs\EditUser::class)->name('edit-user');

Route::middleware(['auth:sanctum', 'verified'])->get('/transfert-bon-commande', \App\Http\Livewire\Achat\TransfertBonCommande::class)->name('transfert-bon-commande');

Route::middleware(['auth:sanctum', 'verified'])->get('/create-mode-paiement', \App\Http\Livewire\Parametrage\CreateModePaiement::class)->name('create-mode-paiement');
Route::middleware(['auth:sanctum', 'verified'])->get('/situation', \App\Http\Livewire\Situation::class)->name('situation');


Route::middleware(['auth:sanctum', 'verified'])->get('/edit-site', \App\Http\Livewire\Parametrage\EditSite::class)->name('edit-site');
Route::middleware(['auth:sanctum', 'verified'])->get('/edit-depot', \App\Http\Livewire\Parametrage\EditDepot::class)->name('edit-depot');
Route::middleware(['auth:sanctum', 'verified'])->get('/edit-famille', \App\Http\Livewire\Parametrage\EditFamille::class)->name('edit-famille');
Route::middleware(['auth:sanctum', 'verified'])->get('/edit-sous-famille', \App\Http\Livewire\Parametrage\EditSousFamille::class)->name('edit-sous-famille');
Route::middleware(['auth:sanctum', 'verified'])->get('/edit-unite', \App\Http\Livewire\Parametrage\EditUnite::class)->name('edit-unite');
Route::middleware(['auth:sanctum', 'verified'])->get('/edit-compte', \App\Http\Livewire\Parametrage\EditCompte::class)->name('edit-compte');
Route::middleware(['auth:sanctum', 'verified'])->get('/edit-caisse', \App\Http\Livewire\Parametrage\EditCaisse::class)->name('edit-caisse');
Route::middleware(['auth:sanctum', 'verified'])->get('/edit-mode-paiement', \App\Http\Livewire\Parametrage\EditModePaiement::class)->name('edit-mode-paiement');
Route::middleware(['auth:sanctum', 'verified'])->get('/edit-fournisseur', \App\Http\Livewire\Parametrage\EditFournisseur::class)->name('edit-fournisseur');
Route::middleware(['auth:sanctum', 'verified'])->get('/create-compte-comptable', \App\Http\Livewire\Parametrage\CreateCompteComptable::class)->name('create-compte-comptable');
Route::middleware(['auth:sanctum', 'verified'])->get('/edit-compte-comptable', \App\Http\Livewire\Parametrage\EditCompteComptable::class)->name('edit-compte-comptable');

Route::middleware(['auth:sanctum', 'verified'])->get('/edit-article', \App\Http\Livewire\Parametrage\EditArticle::class)->name('edit-article');

Route::middleware(['auth:sanctum', 'verified'])->get('/edit-commerciale', \App\Http\Livewire\Parametrage\EditCommerciale::class)->name('edit-commerciale');

Route::middleware(['auth:sanctum', 'verified'])->get('/create-reglement-fournisseur', \App\Http\Livewire\Achat\CreateReglementFournisseur::class)->name('create-reglement-fournisseur');

Route::middleware(['role:admin'])->get('/create-charge', \App\Http\Livewire\ComptaFinance\CreateCharges::class)->name('create-charge');
Route::middleware(['role:admin'])->get('/create-charge-indirecte', \App\Http\Livewire\ComptaFinance\CreateChargeIndirecte::class)->name('create-charge-indirecte');
Route::middleware(['role:admin'])->get('/edit-charge', \App\Http\Livewire\ComptaFinance\EditCharge::class)->name('edit-charge');


Route::middleware(['auth:sanctum', 'verified'])->get('/edit-reglement-fournisseur', \App\Http\Livewire\Achat\EditReglementFournisseur::class)->name('edit-reglement-fournisseur');
Route::middleware(['auth:sanctum', 'verified'])->get('/journal-caisse', \App\Http\Livewire\JournalCaisse::class)->name('journal-caisse');
Route::middleware(['auth:sanctum', 'verified'])->get('/journal-banque', \App\Http\Livewire\JournalBanque::class)->name('journal-banque');


Route::middleware(['auth:sanctum', 'verified'])->get('/employes', \App\Http\Livewire\Employes::class)->name('employes');

Route::middleware(['auth:sanctum', 'verified'])->get('/journal-achat', \App\Http\Livewire\JournalAchat::class)->name('journal-achat');
Route::middleware(['auth:sanctum', 'verified'])->get('/create-production-parametre-fixe', \App\Http\Livewire\Parametrage\CreateProductionParametreFixe::class)->name('create-production-parametre-fixe');
Route::middleware(['auth:sanctum', 'verified'])->get('/create-production-opération', \App\Http\Livewire\Parametrage\CreateProductionOpération::class)->name('create-production-opération');
Route::middleware(['auth:sanctum', 'verified'])->get('/create-production-transformation', \App\Http\Livewire\Parametrage\CreateProductionTransformation::class)->name('create-production-transformation');
Route::middleware(['auth:sanctum', 'verified'])->get('/pro-show', \App\Http\Livewire\Parametrage\ProShow::class)->name('pro-show');












// Routes Of Fluoka

// Primary | Routes
Route::middleware(['auth:sanctum', 'verified'])->get('/produits', \App\Http\Livewire\Produits::class)->name('produits');
Route::middleware(['auth:sanctum', 'verified'])->get('/stock', \App\Http\Livewire\Stock::class)->name('stock');
Route::middleware(['auth:sanctum', 'verified'])->get('/commandes', \App\Http\Livewire\Commandes::class)->name('commandes');

// Paramétrage | Routes

// Paramétrage Produits | Routes
Route::middleware(['auth:sanctum', 'verified'])->get('/categories', \App\Http\Livewire\Parametrage\Categories::class)->name('categories');
Route::middleware(['auth:sanctum', 'verified'])->get('/familles', \App\Http\Livewire\Parametrage\Familles::class)->name('familles');
Route::middleware(['auth:sanctum', 'verified'])->get('/unites', \App\Http\Livewire\Parametrage\Unites::class)->name('unites');
Route::middleware(['auth:sanctum', 'verified'])->get('/preparations', \App\Http\Livewire\Parametrage\Preparations::class)->name('preparations');
Route::middleware(['auth:sanctum', 'verified'])->get('/tranches', \App\Http\Livewire\Parametrage\Tranches::class)->name('tranches');
Route::middleware(['auth:sanctum', 'verified'])->get('/qualite', \App\Http\Livewire\Parametrage\Qualite::class)->name('qualite');
Route::middleware(['auth:sanctum', 'verified'])->get('/fournisseurs', \App\Http\Livewire\Parametrage\Fournisseurs::class)->name('fournisseurs');
Route::middleware(['auth:sanctum', 'verified'])->get('/clients', \App\Http\Livewire\Parametrage\Clients::class)->name('clients');

// Paramétrage Stock | Routes
Route::middleware(['auth:sanctum', 'verified'])->get('/depots', \App\Http\Livewire\Parametrage\Depots::class)->name('depots');

// Paramétrage Commandes | Routes
Route::middleware(['auth:sanctum', 'verified'])->get('/modes-paiement', \App\Http\Livewire\Parametrage\ModesPaiement::class)->name('modes-paiement');
Route::middleware(['auth:sanctum', 'verified'])->get('/modes-livraison', \App\Http\Livewire\Parametrage\ModesLivraison::class)->name('modes-livraison');
Route::middleware(['auth:sanctum', 'verified'])->get('/livreurs', \App\Http\Livewire\Parametrage\Livreurs::class)->name('livreurs');
