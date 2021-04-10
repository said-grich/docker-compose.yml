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
    public $type_nom;
    public $minPoids;
    public $maxPoids;
    public $list_modes_vente;

    protected $listeners = ['modeVenteAdded' => 'renderModeVente'];

    protected $rules = [
        'nom' => 'unique:tranches,nom',
    ];

    protected $messages = [
        'nom.unique' => 'Tranche existe déja',
    ];


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

        $uniqueId = str_replace(".","",microtime(true)).rand(000,999);

        /* switch ($this->type) {
            case '1':
                $this->type_nom = "Poids par pièce";
                break;
            case '2':
                $this->type_nom = "Kg";
                break;
            case '3':
                $this->type_nom = "Pièce";
                break;
        } */

        $this->type == 1 ? $this->nom =  $this->minPoids." - ".$this->maxPoids : $this->nom;
        $this->validate();


        Tranche::create([
            'nom' => $this->nom,
            'type' => $this->type == 1 ? "Poids par pièce" : "Kg/Pièce",
            'min_poids' => $this->minPoids,
            'max_poids' => $this->maxPoids,
            'uid' => $this->type == 1 ? "PP".$uniqueId : "KP".$uniqueId,
        ]);


        session()->flash('message', 'Tranche "'.$this->nom. '" a été crée ');



        $this->reset(['nom','minPoids','maxPoids']);

        $this->emit('saved');
    }

    public function createTrancheOld()
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
