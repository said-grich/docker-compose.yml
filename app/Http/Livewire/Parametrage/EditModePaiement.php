<?php

namespace App\Http\Livewire\Parametrage;

use App\Models\ModePaiement;
use Livewire\Component;

class EditModePaiement extends Component
{
    public $name;
    public $modalites_paiement;
    public $modePaiement;
    public $ida;


    protected $rules = [
        'name' => 'required',
        'modalites_paiement' => 'required',
    ];

    public function mount()
    {
        $this->ida = request()->ida;
        $this->modePaiement = ModePaiement::findOrFail($this->ida);
        $this->name= $this->modePaiement->name;
        $this->modalites_paiement= $this->modePaiement->modalites_paiement;
    }

    public function editModePaiement()
    {

            $this->modePaiement->name = $this->name;
            $this->modePaiement->modalites_paiement = $this->modalites_paiement;
            $this->modePaiement->save();

            return redirect()->to('/create-mode-paiement');

    }

    public function render()
    {
        return view('livewire.Parametrage.edit-mode-paiement');
    }
}
