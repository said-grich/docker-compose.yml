<?php

namespace App\Http\Livewire\Paramétrage;
use Illuminate\Support\Facades\DB;
use App\Models\ProductionParametreFixe;
use Livewire\Component;

class CreateProductionParametreFixe extends Component
{

    public $matiere;
    public $prix;

    protected $rules = [
        'matiere' => 'required',
        'prix' => 'required',
    ];

    public function createparametrefixe(){

        //$this->validation();

        $item = new ProductionParametreFixe();
        $item->matiere = $this->matiere;
        $item->prix = $this->prix;
        $item->save();

        $this->reset(['matiere']);
        $this->emit('saved');
    }

    public function render()
    {
        return view('livewire.paramétrage.create-production-parametre-fixe');
    }
}
