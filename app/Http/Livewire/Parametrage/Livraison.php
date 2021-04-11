<?php

namespace App\Http\Livewire\Parametrage;

use App\Models\Ville;
use Livewire\Component;

class Livraison extends Component
{
    public $liste_villes = [];

    public function renderData()
    {
        $this->liste_villes = Ville::all()->sortBy('nom');
    }

    public function render()
    {
        $this->renderData();
        return view('livewire.parametrage.livraison');
    }
}
