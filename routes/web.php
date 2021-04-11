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


Route::middleware(['role:admin'])->get('/create-roles', \App\Http\Livewire\ParametrageUtilisateurs\CreateRoles::class)->name('create-roles');

Route::middleware(['role:admin'])->get('/create-permissions', \App\Http\Livewire\ParametrageUtilisateurs\CreatePermissions::class)->name('create-permissions');

Route::middleware(['role:admin'])->get('/edit-permission', \App\Http\Livewire\ParametrageUtilisateurs\EditPermissions::class)->name('edit-permission');

Route::middleware(['role:admin'])->get('/edit-role', \App\Http\Livewire\ParametrageUtilisateurs\EditRoles::class)->name('edit-role');

Route::middleware(['role:admin'])->get('/create-users', \App\Http\Livewire\ParametrageUtilisateurs\CreateUsers::class)->name('create-users');
Route::middleware(['auth:sanctum', 'verified'])->get('/edit-user', \App\Http\Livewire\ParametrageUtilisateurs\EditUser::class)->name('edit-user');



// Routes Of Fluoka

// Primary | Routes Backend
Route::middleware(['auth:sanctum', 'verified'])->get('/produits', \App\Http\Livewire\Produits::class)->name('produits');
Route::middleware(['auth:sanctum', 'verified'])->get('/entree-stock', \App\Http\Livewire\Stock::class)->name('entree-stock');
Route::middleware(['auth:sanctum', 'verified'])->get('/commandes', \App\Http\Livewire\Commandes::class)->name('commandes');
Route::middleware(['auth:sanctum', 'verified'])->get('/controle-qualite', \App\Http\Livewire\ControleQualite::class)->name('controle-qualite');


// Paramétrage | Routes Backend

// Paramétrage Produits | Routes Backend
Route::middleware(['auth:sanctum', 'verified'])->get('/categories', \App\Http\Livewire\Parametrage\Categories::class)->name('categories');
Route::middleware(['auth:sanctum', 'verified'])->get('/familles', \App\Http\Livewire\Parametrage\Familles::class)->name('familles');
Route::middleware(['auth:sanctum', 'verified'])->get('/unites', \App\Http\Livewire\Parametrage\Unites::class)->name('unites');
Route::middleware(['auth:sanctum', 'verified'])->get('/preparations', \App\Http\Livewire\Parametrage\Preparations::class)->name('preparations');
Route::middleware(['auth:sanctum', 'verified'])->get('/tranches', \App\Http\Livewire\Parametrage\Tranches::class)->name('tranches');
Route::middleware(['auth:sanctum', 'verified'])->get('/qualite', \App\Http\Livewire\Parametrage\Qualite::class)->name('qualite');
Route::middleware(['auth:sanctum', 'verified'])->get('/fournisseurs', \App\Http\Livewire\Parametrage\Fournisseurs::class)->name('fournisseurs');
Route::middleware(['auth:sanctum', 'verified'])->get('/clients', \App\Http\Livewire\Parametrage\Clients::class)->name('clients');
Route::middleware(['auth:sanctum', 'verified'])->get('/livraison', \App\Http\Livewire\Parametrage\Livraison::class)->name('livraison');

Route::middleware(['auth:sanctum', 'verified'])->get('/bon-reception', \App\Http\Livewire\GestionAchat\ListeBonReception::class)->name('bon-reception');
Route::middleware(['auth:sanctum', 'verified'])->get('/designation-prix', \App\Http\Livewire\Vente\DesignationPrix::class)->name('designation-prix');
Route::middleware(['auth:sanctum', 'verified'])->get('/bon-livraison', \App\Http\Livewire\Vente\BonLivraison::class)->name('bon-livraison');


Route::middleware(['auth:sanctum', 'verified'])->get('/etat-stock', \App\Http\Livewire\Stock\EtatStock::class)->name('etat-stock');

// Paramétrage Stock | Routes Backend
Route::middleware(['auth:sanctum', 'verified'])->get('/depots', \App\Http\Livewire\Parametrage\Depots::class)->name('depots');

// Paramétrage Commandes | Routes Backend
Route::middleware(['auth:sanctum', 'verified'])->get('/modes-paiement', \App\Http\Livewire\Parametrage\ModesPaiement::class)->name('modes-paiement');
Route::middleware(['auth:sanctum', 'verified'])->get('/modes-livraison', \App\Http\Livewire\Parametrage\ModesLivraison::class)->name('modes-livraison');
Route::middleware(['auth:sanctum', 'verified'])->get('/livreurs', \App\Http\Livewire\Parametrage\Livreurs::class)->name('livreurs');

// Primary | Routes Frontend
Route::middleware(['auth:sanctum', 'verified'])->get('/boutique', \App\Http\Livewire\Frontend\Boutique::class)->name('boutique');
Route::middleware(['auth:sanctum', 'verified'])->get('/produit', \App\Http\Livewire\Frontend\ProduitInfo::class)->name('produit');
Route::middleware(['auth:sanctum', 'verified'])->get('/panier', \App\Http\Livewire\Frontend\Panier::class)->name('panier');
Route::middleware(['auth:sanctum', 'verified'])->get('/blog', \App\Http\Livewire\Frontend\Blog::class)->name('blog');
Route::middleware(['auth:sanctum', 'verified'])->get('/apropos', \App\Http\Livewire\Frontend\Apropos::class)->name('apropos');
Route::middleware(['auth:sanctum', 'verified'])->get('/contact', \App\Http\Livewire\Frontend\Contact::class)->name('contact');
