<?php

namespace App\Http\Livewire\Parametrage;

use App\Models\SousFamille;
use Livewire\Component;

class EditSousFamille extends Component
{

    public $code;
    public $name;
    public $sous_famille;
    public $ida;

    protected $rules = [
        'code' => 'required|min:2',
        'name' => 'required|min:2',
    ];

    public function mount()
    {
        $this->ida = request()->ida;
        $this->sous_famille = SousFamille::findOrFail($this->ida);
        $this->code= $this->sous_famille->code;
        $this->name= $this->sous_famille->name;
    }

    public function editSousFamille()
    {

            $this->sous_famille->code =$this->code;
            $this->sous_famille->name = $this->name;
            $this->sous_famille->save();

            return redirect()->to('/create-sous-famille');

    }
    public function render()
    {
        return view('livewire.Parametrage.edit-sous-famille');
    }
}
