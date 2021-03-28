<?php

namespace App\Http\Livewire;

use App\Models\ModeVente;
use App\Models\TranchesKgPc;
use App\Models\TranchesPoidsPc;
use Livewire\Component;

class ShowTranche extends Component
{

    public $mode_vente_name;
    public $nom;
    public $type;
    public $minPoids;
    public $maxPoids;
    public $list_modes_vente;

    protected $listeners = ['modeVenteAdded' => 'renderModeVente'];

    protected $rules = [
        'name' => 'required',
    ];


    public function renderModeVente()
    {
        $this->list_modes_vente = ModeVente::all()->sortBy('nom');
    }


    public function createTranche()
    {
        //$this->validate();

        $uniqueId = str_replace(".", "", microtime(true)) . rand(000, 999);

        if ($this->type == 1) {

            TranchesPoidsPc::create([
                'nom' => $this->minPoids . " - " . $this->maxPoids,
                'min_poids' => $this->minPoids,
                'max_poids' => $this->maxPoids,
                'uid' => "PP" . $uniqueId,
            ]);
        } else {
            TranchesKgPc::create([
                'nom' => $this->nom,
                'uid' => "KP" . $uniqueId,
            ]);
        }

        $this->reset(['nom', 'minPoids', 'maxPoids']);

        session()->flash('message', 'Tranche "' . $this->nom . '" a été crée ');

        $this->emit('trancheAdded');
    }

    public function render()
    {
        $this->renderModeVente();
        return view('livewire.show-tranche');
    }
}
