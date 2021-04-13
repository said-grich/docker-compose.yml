<?php

namespace App\Http\Livewire\Parametrage;

use App\Models\Depot;
use App\Models\Ville;
use App\Models\VilleZone;
use Livewire\Component;

class Depots extends Component
{

    public $nom;
    public $ville;
    public $order_priorite;
    public $zone_ville;
    public $list_zones_ville = [];
    public $list_villes;

    public function mount(){
        $this->list_villes = Ville::all()->sortBy('nom');
    }

    public function updatedVille($value){
        $this->list_zones_ville = VilleZone::where('ville_id',$value)->get();
    }

    public function createDepot()
    {
        //$this->validate();

        $item = new Depot();
        $item->nom = $this->nom;
        $item->ville_id = $this->ville;
        $item->order_priorite = $this->order_priorite;
        $item->ville_zone_id = $this->zone_ville;
        $item->save();


        session()->flash('message', 'Dépôt "' . $this->nom . '" a été crée');
        $this->reset(['nom','ville']);

        $this->emit('saved');
    }

    public function render()
    {
        return view('livewire.parametrage.depots');
    }
}
