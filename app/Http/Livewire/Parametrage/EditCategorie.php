<?php

namespace App\Http\Livewire\Parametrage;

use App\Models\Categorie;
use Livewire\Component;

class EditCategorie extends Component
{
    public $name;
    public $ida;

    protected $rules = [

        'name' => 'required',
    ];

    public function mount()
    {
        $this->ida = request()->ida;
        $unite = Categorie::findOrFail($this->ida);
        $this->name= $unite->name;
    }

    public function editUnite()
    {

            $unite = Categorie::findOrFail($this->ida);
            $unite->name = $this->name;

            $unite->save();

            return redirect()->to('/categories');

    }

    public function render()
    {
        return view('livewire.Parametrage.edit-unite');
    }
}
