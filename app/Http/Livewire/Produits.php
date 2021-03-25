<?php

namespace App\Http\Livewire;

use App\Models\Categorie;
use App\Models\ModePreparation;
use App\Models\ModeVente;
use Livewire\Component;

class Produits extends Component
{
    public $list_categories;
    public $list_modes_preparation;
    public $list_modes_vente;

    public function renderData()
    {
        $this->list_categories = Categorie::all()->sortBy('nom');
        $this->list_modes_preparation = ModePreparation::all()->sortBy('nom');
        $this->list_modes_vente = ModeVente::all()->sortBy('nom');
    }

    public function render()
    {
        $this->renderData();
        return view('livewire.produits');
    }
}
