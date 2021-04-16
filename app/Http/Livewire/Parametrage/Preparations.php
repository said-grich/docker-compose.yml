<?php

namespace App\Http\Livewire\Parametrage;

use App\Models\ModePreparation;
use App\Models\Preparation;
use Livewire\Component;

class Preparations extends Component
{
    public $mode_preparation_nom;
    public $preparation_nom;
    public $mode_preparation_id;
    public $list_mode_preparations;

    protected $listeners = ['modePreparationAdded' => 'renderModePreparations'];



    protected $rules = [
        'mode_preparation_nom' => 'required|min:2',
        'preparation_nom' => 'required|min:2',
    ];

    public function renderModePreparations()
    {
        $this->list_mode_preparations = ModePreparation::all()->sortBy('nom');
    }


    public function createModePreparation()
    {
        //$this->validate();

        $item = new ModePreparation();
        $item->nom = $this->mode_preparation_nom;

        $item->save();
        session()->flash('message', 'Le mode de préparation "'.$this->mode_preparation_nom. '" a été crée ');


        $this->reset(['mode_preparation_nom']);

        $this->emit('saved');
    }

    public function createPreparation()
    {
        $souspreparation = Preparation::where('nom', $this->preparation_nom)
        ->where('mode_preparation_id', $this->mode_preparation_id)
        ->first();
            if ($souspreparation === null) {
                //$this->validate();

                $item = new Preparation();
                $item->nom = $this->preparation_nom;
                $item->mode_preparation_id = $this->mode_preparation_id;

                $item->save();

                $mode = ModePreparation::findOrFail($this->mode_preparation_id);
                session()->flash('message', 'La préparation "'.$this->preparation_nom. '" a été créée dans le mode '.$mode->nom);

                $this->reset(['preparation_nom','mode_preparation_id']);

                $this->emit('saved');

            }else {

            session()->flash('message',  'Sous mode prépartion "'.$this->preparation_nom.'" est déja existe');
            }

    }



    public function render()
    {
        $this->renderModePreparations();
        return view('livewire.parametrage.preparations');
    }
}
