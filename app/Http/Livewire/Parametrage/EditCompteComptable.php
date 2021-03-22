<?php

namespace App\Http\Livewire\Parametrage;

use App\Models\CompteComptable;
use Livewire\Component;

class EditCompteComptable extends Component
{

    public $code;
    public $name;
    public $compte_comptable;
    public $ida;

    protected $rules = [

        'code' => 'required|min:2',
        'name' => 'required',
    ];

    public function mount()
    {
        $this->ida = request()->ida;
        $this->compte_comptable = CompteComptable::findOrFail($this->ida);
        $this->code= $this->compte_comptable->code;
        $this->name= $this->compte_comptable->name;

    }

    public function editCompteComptable()
    {

            $this->compte_comptable->code = $this->code;
            $this->compte_comptable->name =$this->name;
            $this->compte_comptable->save();

            return redirect()->to('/create-compte-comptable');

    }

    public function render()
    {
        return view('livewire.Parametrage.edit-compte-comptable');
    }
}
