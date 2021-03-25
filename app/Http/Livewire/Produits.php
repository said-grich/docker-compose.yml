<?php

namespace App\Http\Livewire;

use App\Models\ModePreparation;
use App\Models\ModeVente;
use Livewire\Component;

class Produits extends Component
{
    public $list_mode_preparations;

    public function renderData()
    {
        $this->list_mode_preparations = ModePreparation::all()->sortBy('nom');
        $this->list_modes_vente = ModeVente::all()->sortBy('nom');
    }

    public function render()
    {
        $this->renderData();
        return view('livewire.produits');
    }
}
