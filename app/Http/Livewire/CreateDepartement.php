<?php

namespace App\Http\Livewire;

use App\Models\Departement;
use Livewire\Component;

class CreateDepartement extends Component
{
    public $code;
    public $departement;

    protected $rules = [
        'code' => 'required|min:2',
        'departement' => 'required|min:2'
    ];


    public function createDepartement()
    {
        $this->validate();

        $item = new Departement();
        $item->code = $this->code;
        $item->departement = $this->departement;
        $item->save();

        $this->emit('saved');
    }

    public function render()
    {
        return view('livewire.create-departement');
    }
}
