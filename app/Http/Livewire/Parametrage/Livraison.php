<?php

namespace App\Http\Livewire\Parametrage;

use App\Models\Ville;
use Livewire\Component;

class Livraison extends Component
{
    public $liste_villes = [];
    public $ville;
    public $heure;
    public $jours=[];
    public $jour_livraison = [];

    public function renderData()
    {
        $this->liste_villes = Ville::all()->sortBy('nom');
        $this->jours = ['Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi','Dimanche'];
    }

    public function createLivraison()
    {
        dd($this->jour_livraison);
    }

    public function render()
    {
        $this->renderData();
        return view('livewire.parametrage.livraison');
    }
}
