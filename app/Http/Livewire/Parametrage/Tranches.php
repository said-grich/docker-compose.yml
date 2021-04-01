<?php

namespace App\Http\Livewire\Parametrage;

use App\Models\ModeVente;
use App\Models\Tranche;
use App\Models\TranchesKgPc;
use App\Models\TranchesPoidsPc;
use Livewire\Component;

class Tranches extends Component
{
    public $mode_vente_name;
    public $nom;
    public $type;
    public $minPoids;
    public $maxPoids;
    public $list_modes_vente;

    protected $listeners = ['modeVenteAdded' => 'renderModeVente'];


    public function renderModeVente()
    {
        $this->list_modes_vente = ModeVente::all()->sortBy('nom');
    }

    public function createModeVente()
    {
        $this->validate();

        $item = new ModeVente();
        $item->nom = $this->mode_vente_name;
        $item->save();

        session()->flash('message', 'Le mode de vente "'.$this->mode_vente_name. '" a été crée ');

        $this->reset(['mode_vente_name']);

        $this->emit('saved');
    }

    public function createTranche()
    {
        /* $this->validate([
            'nom' => 'required|unique:tranches,ref',
        ]); */
        $uniqueId = str_replace(".","",microtime(true)).rand(000,999);

        if($this->type == 1){

            TranchesPoidsPc::create([
                'nom' => $this->minPoids." - ".$this->maxPoids,
                'min_poids' => $this->minPoids,
                'max_poids' => $this->maxPoids,
                'uid' => "PP".$uniqueId,
            ]);



        }else{
            TranchesKgPc::create([
                'nom' => $this->nom,
                'uid' => "KP".$uniqueId,
            ]);

        }
        session()->flash('message', 'Tranche "'.$this->nom. '" a été crée ');



        $this->reset(['nom','minPoids','maxPoids']);

        $this->emit('saved');
    }

    public function render()
    {
        $this->renderModeVente();
        return view('livewire.parametrage.tranches');
    }
}
