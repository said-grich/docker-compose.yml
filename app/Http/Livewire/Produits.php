<?php

namespace App\Http\Livewire;

use App\Models\Categorie;
use App\Models\ModePreparation;
use App\Models\ModeVente;
use App\Models\Preparation;
use App\Models\Produit;
use App\Models\TranchesKgPc;
use App\Models\TranchesPoidsPc;
use App\Models\Unite;
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
    public $list_unite = [];
    public $code_comptable;
    public $code_analytique;

    public $mode_vente;
    public $mode_preparation;
    public $nom;
    public $sous_categorie;
    public $unite;
    public $tranches=[];
    public $preparations = [];
    public $photo_principale;
    public $active = false;

    public function updatedModeVente($value){

        $value == 1 ?  $this->list_tranches = TranchesPoidsPc::get() : $this->list_tranches = TranchesKgPc::get();
    }

    public function updatedModePreparation($value){

        $mode = ModePreparation::find($value);
        $this->list_preparations = $mode->preparations;
    }



    public function renderData()
    {
        $this->list_categories = Categorie::all()->sortBy('nom');
        $this->list_modes_preparation = ModePreparation::all()->sortBy('nom');
        $this->list_modes_vente = ModeVente::all()->sortBy('nom');
        $this->list_unite = Unite::all()->sortBy('nom');

    }

    public function createProduit()
    {
        //$this->validate();

        $filename = $this->photo_principale->storeAs('public/produits', date("Y-m-d")."-".$this->nom.".".$this->photo_principale->guessExtension());
        dd($filename);

        $item = new Produit();
        $item->nom = $this->nom;
        $item->sous_categorie_id = $this->sous_categorie;
        $item->mode_vente_id = $this->mode_vente;
        $item->mode_preparation_id = $this->mode_preparation;
        $item->code_comptable = $this->code_comptable;
        $item->code_analytique = $this->code_analytique;
        $item->active = $this->active;
        dd($item);

        $item->save();

        session()->flash('message', 'Catégorie "'.$this->categorie_name. '" a été créée ');
        $this->reset(['categorie_name']);

        $this->emit('saved');
    }

    public function render()
    {
        $this->renderData();
        return view('livewire.produits');
    }
}
