<?php

namespace App\Http\Livewire\Parametrage;

use Illuminate\Support\Facades\DB;
use App\Models\Unite;
use Livewire\Component;

class Unites extends Component
{

    public $nom;

    protected $rules = [
        'nom' => 'required',
    ];

    public function createUnite()
    {
        $this->validate();

        $item = new Unite();
        $item->nom = $this->nom;
        $item->save();

        $this->reset(['nom']);

        $this->emit('saved');
    }

    public function render()
    {
        return view('livewire.parametrage.unites');
    }
}
