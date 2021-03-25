<?php

namespace App\Http\Livewire;

use App\Models\Categorie;
use App\Models\ModePreparation;
use App\Models\ModeVente;
use App\Models\Produit;
use App\Models\TranchesKgPc;
use App\Models\TranchesPoidsPc;
use Livewire\Component;

class Produits extends Component
{
    public $list_categories;
    public $list_modes_preparation;
    public $list_tranches = [];
    public $list_modes_vente = [];

    public $mode_vente;
    public $nom;

    public function updatedModeVente($value){

        $value == 1 ?  $this->list_tranches = TranchesPoidsPc::get()->toArray() : $this->list_tranches = TranchesKgPc::get()->toArray();
        dd($this->list_tranches);
    }



    public function renderData()
    {
        $this->list_categories = Categorie::all()->sortBy('nom');
        $this->list_modes_preparation = ModePreparation::all()->sortBy('nom');
        $this->list_modes_vente = ModeVente::all()->sortBy('nom');

    }

    public function createProduit()
    {
        //$this->validate();

        $item = new Produit();
        $item->nom = $this->nom;
        $item->sous_categorie_id = $this->sous_categorie;
        $item->mode_vente_id = $this->mode_vente;
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
