<?php

namespace App\Http\Livewire\Parametrage;

use App\Models\ModePaiement;
use Livewire\Component;

class CreateModePaiement extends Component
{

    public $name;
    public $modalites_paiement;

    protected $rules = [
        'name' => 'required',
        'modalites_paiement' => 'required',
    ];

    public function createModePaiement()
    {
        $this->validate();

        $item = new ModePaiement();
        $item->name = $this->name;
        $item->modalites_paiement = $this->modalites_paiement;
        $item->save();

        $this->reset(['name', 'modalites_paiement']);

        $this->emit('saved');
    }


    public function render()
    {
        return view('livewire.Parametrage.create-mode-paiement');
    }
}
