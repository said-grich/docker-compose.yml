<?php

namespace App\Http\Livewire\Paramétrage;

use App\Models\SousFamille;
use Livewire\Component;

class CreateSousFamille extends Component
{

    public $code;
    public $name;

    protected $rules = [
        'code' => 'required|min:2',
        'name' => 'required|min:2',
    ];


    public function createSousFamille()
    {
        $this->validate();

        $item = new SousFamille();
        $item->code = $this->code;
        $item->name = $this->name;
        $item->save();

        $this->reset(['code', 'name']);

        $this->emit('saved');
    }
    public function render()
    {
        return view('livewire.paramétrage.create-sous-famille');
    }
}
