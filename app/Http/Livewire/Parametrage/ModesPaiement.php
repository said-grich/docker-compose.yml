<?php

namespace App\Http\Livewire\Parametrage;

use App\Models\ModePaiement;
use Livewire\Component;

class ModesPaiement extends Component
{

    public $nom;

    protected $rules = [
        'nom' => 'required',
    ];

    public function createModePaiement()
    {
        $this->validate();

        $item = new ModePaiement();
        $item->nom = $this->nom;
        $item->save();


        session()->flash('message', 'Mode paiement "' . $this->nom . '" a été crée');
        $this->reset(['nom']);

        $this->emit('saved');
    }

    public function render()
    {
        return view('livewire.parametrage.modes-paiement');
    }
}
