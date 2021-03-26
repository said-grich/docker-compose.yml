<?php

namespace App\Http\Livewire;

use App\Models\Categorie;
use App\Models\Famille;
use App\Models\ModePreparation;
use App\Models\ModeVente;
use App\Models\Preparation;
use App\Models\PreparationType;
use App\Models\Produit;
use App\Models\ProduitTranche;
use App\Models\TranchesKgPc;
use App\Models\TranchesPoidsPc;
use App\Models\Unite;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class Produits extends Component
{

    use WithFileUploads;

    public $list_categories;
    public $list_modes_preparation;
    public $list_tranches = [];
    public $list_modes_vente = [];
    public $list_preparations = [];
    public $list_familles = [];
    public $list_unite = [];
    public $code_comptable;
    public $code_analytique;

    public $mode_vente;
    public $mode_preparation;
    public $nom;
    public $famille;
    public $sous_categorie;
    public $unite;
    public $tranches=[];
    public $preparations = [];
    public $photo_principale;
    public $photos = [];
    public $active = false;

    public function updatedModeVente($value){

        $value == 1 ?  $this->list_tranches = TranchesPoidsPc::get() : $this->list_tranches = TranchesKgPc::get();
    }

    public function updatedModePreparation($value){

        $mode = ModePreparation::find($value);
        $this->list_preparations = $mode->preparations;
    }


    public function updatedPhoto()
    {
        $this->validate([
            'photo' => 'image|max:1024', // 1MB Max
        ]);
    }


    public function renderData()
    {
        $this->list_categories = Categorie::all()->sortBy('nom');
        $this->list_modes_preparation = ModePreparation::all()->sortBy('nom');
        $this->list_modes_vente = ModeVente::all()->sortBy('nom');
        $this->list_unite = Unite::all()->sortBy('nom');
        $this->list_familles = Famille::all()->sortBy('nom');
       /*  $p = Produit::where('id',1)->first(); */
        // dd($p->preparations->first()->preparation->nom);

    }

    public function createProduit()
    {
        //$this->validate();

        DB::transaction(function () {

            $photo_principale = $this->photo_principale->storeAs('public/produits/' . $this->nom . '/principale', date("Y-m-d") . "-" . $this->nom . "." . $this->photo_principale->guessExtension());

            $paths = [];
            foreach ($this->photos as $key => $photo) {
                $extension = $photo->getClientOriginalExtension();
                $filename  = "photo-$key-" . time() . '.' . $extension;
                $paths[$key] = $photo->storeAs("public/produits/$this->nom/photos", $filename);
            }

            $item = new Produit();
            $item->nom = $this->nom;
            $item->sous_categorie_id = $this->sous_categorie;
            $item->mode_vente_id = $this->mode_vente;
            $item->mode_preparation_id = $this->mode_preparation;
            $item->famille_id = $this->famille;
            $item->unite_id = $this->unite;
            $item->code_comptable = $this->code_comptable;
            $item->code_analytique = $this->code_analytique;
            $item->photo_principale = $photo_principale;
            $item->photos = json_encode($paths, JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES| JSON_FORCE_OBJECT);
            $item->active = $this->active;

            $item->save();

            foreach ($this->preparations as $key => $value) {
                PreparationType::create([
                    'produit_id' => $item->id,
                    'preparation_id' => $this->preparations[$key],
                ]);
            }

            foreach ($this->tranches as $key => $value) {
                ProduitTranche::create([
                    'produit_id' => $item->id,
                    'tranche_id' => $this->tranches[$key],
                ]);
            }
        });

        session()->flash('message', 'Produit "'. $this->nom. '" a été crée ');
        $this->reset(['nom', 'sous_categorie', 'mode_vente', 'mode_preparation', 'famille', 'unite', 'code_comptable', 'code_analytique', 'photos', 'photo_principale', 'active']);

        $this->emit('saved');
    }

    public function render()
    {
        $this->renderData();
        return view('livewire.produits');
    }
}
