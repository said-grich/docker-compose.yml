<?php

namespace App\Http\Livewire\Paramétrage;

use Illuminate\Support\Facades\DB;
use App\Models\Unite;
use Livewire\Component;

class CreateUnite extends Component
{

    public $name;

    protected $rules = [
        'name' => 'required',
    ];

    public function createUnite()
    {
        $this->validate();

        $item = new Unite();
        $item->name = $this->name;
        $item->save();

        $this->reset(['name']);

        $this->emit('saved');
    }

    public function render()
    {
        return view('livewire.paramétrage.create-unite');
    }
}
