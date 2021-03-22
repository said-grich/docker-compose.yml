<?php

namespace App\Http\Livewire\Parametrage;

use App\Models\CompteComptable;
use Livewire\Component;

class CreateCompteComptable extends Component
{

    public $code;
    public $name;

    protected $rules = [
        
        'code' => 'required|min:2',
        'name' => 'required',
    ];

    public function createCompteComptable()
    {
        $this->validate();

        $item = new CompteComptable();
        $item->code = $this->code;
        $item->name = $this->name;
        $item->save();

        $this->reset(['code','name']);

        $this->emit('saved');
    }


    public function render()
    {
        return view('livewire.Parametrage.create-compte-comptable');
    }
}
