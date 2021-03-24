<?php

namespace App\Http\Livewire\Parametrage;

use App\Models\Qualite as ModelsQualite;
use Livewire\Component;

class Qualite extends Component
{

    public $nom;

    protected $rules = [
        'nom' => 'required|min:2',
    ];


    public function createQualite()
    {
        $this->validate();

        $item = new ModelsQualite();
        $item->nom = $this->nom;
        $item->save();

        session()->flash('message', 'Qualité "'.$this->nom. '" a été créée ');

        $this->reset(['nom']);

        $this->emit('saved');
    }
    public function render()
    {
        return view('livewire.parametrage.qualite');
    }
}
