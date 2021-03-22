<?php

namespace App\Http\Livewire\Parametrage;

use App\Models\Famille;
use Livewire\Component;

class CreateFamille extends Component
{
    public $code;
    public $famille;

    protected $rules = [
        'code' => 'required|min:2',
        'famille' => 'required|min:2',
    ];


    public function createFamille()
    {
        $this->validate();

        $item = new Famille();
        $item->code = $this->code;
        $item->famille = $this->famille;
        
        $item->save();

        $this->reset(['code', 'famille']);

        $this->emit('saved');
    }

    public function render()
    {
        
        return view('livewire.Parametrage.create-famille');
    }
}
