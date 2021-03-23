<?php

namespace App\Http\Livewire\Parametrage;

use App\Models\Tranche;
use Livewire\Component;

class Tranches extends Component
{
    public $nom;
    public $type;
    public $minPoids;
    public $maxPoids;

    public function createTranche()
    {
        //$this->validate();

        $item = new Tranche();
        $item->type = $this->type;
        $item->nom = $this->nom;

        //$item->save();
        //session()->flash('message', 'Le mode de préparation "'.$this->mode_preparation_nom. '" a été crée ');


        //$this->reset(['mode_preparation_nom']);

        $this->emit('saved');
    }

    public function render()
    {
        return view('livewire.parametrage.tranches');
    }
}
