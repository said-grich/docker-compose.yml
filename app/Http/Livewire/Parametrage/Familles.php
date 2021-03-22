<?php

namespace App\Http\Livewire\Parametrage;

use App\Models\Famille;
use Livewire\Component;

class Familles extends Component
{
    public $nom;

    protected $rules = [
        'nom' => 'required|min:2',
    ];


    public function createFamille()
    {
        $this->validate();

        $item = new Famille();
        $item->nom = $this->nom;

        $item->save();

        $this->reset(['nom']);

        $this->emit('saved');
    }
    public function render()
    {
        return view('livewire.parametrage.familles');
    }
}
