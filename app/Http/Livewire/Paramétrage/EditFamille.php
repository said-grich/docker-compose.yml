<?php

namespace App\Http\Livewire\Paramétrage;

use App\Models\Famille;
use Livewire\Component;

class EditFamille extends Component
{

    public $code;
    public $famille;
    public $ida;

    protected $rules = [
        'code' => 'required|min:2',
        'famille' => 'required|min:2',
    ];

    public function mount()
    {
        $this->ida = request()->ida;
        $famille = Famille::findOrFail($this->ida);
        $this->code= $famille->code;
        $this->famille= $famille->famille;
    }

    public function editFamille()
    {

            $famille = Famille::findOrFail($this->ida);
            $famille->code =$this->code;
            $famille->famille = $this->famille;


            $famille->save();

            return redirect()->to('/create-famille');

    }

    public function render()
    {
        return view('livewire.paramétrage.edit-famille');
    }
}
