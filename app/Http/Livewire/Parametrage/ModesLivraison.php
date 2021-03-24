<?php

namespace App\Http\Livewire\Parametrage;

use App\Models\ModeLivraison;
use Livewire\Component;

class ModesLivraison extends Component
{

    public $nom;

    protected $rules = [
        'nom' => 'required',
    ];

    public function createModeLivraison()
    {
        $this->validate();

        $item = new ModeLivraison();
        $item->nom = $this->nom;
        $item->save();


        session()->flash('message', 'Mode livraison "' . $this->nom . '" a été crée');
        $this->reset(['nom']);

        $this->emit('saved');
    }
    public function render()
    {
        return view('livewire.parametrage.modes-livraison');
    }
}
