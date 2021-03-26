<?php

namespace App\Http\Livewire;

use App\Models\Fournisseur;
use App\Models\Lot;
use App\Models\Produit;
use App\Models\Qualite;
use Livewire\Component;

class Stock extends Component
{
    public $lot_num;
    public $date_capture;
    public $date_entree;
    public $date_preemption;
    public $pas;
    public $fournisseur;
    public $qualite;
    public $produit;
    public $active = false;

    public $list_fournisseurs = [];
    public $list_qualites = [];
    public $list_produits = [];

    public function renderData()
    {
        $this->list_fournisseurs = Fournisseur::all()->sortBy('nom');
        $this->list_qualites = Qualite::all()->sortBy('nom');
        $this->list_produits = Produit::all()->sortBy('nom');

    }

    public function createLot(){

        $item = new Lot();
        $item->lot_num = $this->lot_num;
        $item->date_capture = $this->date_capture;
        $item->date_entree = $this->date_entree;
        $item->date_preemption = $this->date_preemption;
        $item->pas = $this->pas;
        $item->fournisseur_id = $this->fournisseur;
        $item->qualite_id = $this->qualite;
        $item->produit_id = $this->produit;
        $item->active = $this->active;

        $item->save();
    }

    public function render()
    {
        $this->renderData();
        return view('livewire.stock');
    }
}
