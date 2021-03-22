<?php

namespace App\Http\Livewire\Parametrage;

use App\Models\Unite;
use Livewire\Component;

class EditUnite extends Component
{
    public $name;
    public $ida;

    protected $rules = [

        'name' => 'required',
    ];

    public function mount()
    {
        $this->ida = request()->ida;
        $unite = Unite::findOrFail($this->ida);
        $this->name= $unite->name;
    }

    public function editUnite()
    {

            $unite = Unite::findOrFail($this->ida);
            $unite->name = $this->name;


            $unite->save();

            return redirect()->to('/create-unite');

    }

    public function render()
    {
        return view('livewire.Parametrage.edit-unite');
    }
}
