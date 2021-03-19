<?php

namespace App\Http\Livewire;

use App\Models\EtatReglement;
use Livewire\Component;

class CreateEtatReglement extends Component
{

    public $deuxime_mise;
    public $date_mise_banque;
    public $date_encaissement;

    protected $rules = [
        'deuxime_remise' => 'required',


    ];

    public function createEtatReglement()
    {
        //dd($this);
        $this->validate();

        $item = new EtatReglement();

        $item->date_mise_banque = $this->date_mise_banque;
        $item->date_encaissement = $this->date_encaissement;


        $item->deuxime_mise = $this->deuxime_mise;

        $item->save();


        $this->reset(['deuxime_mise','date_mise_banque','date_encaissement']);


        session()->flash('message', 'Règlement fournisseur successfully added.');
        $this->emit('saved');

    }
    public function render()
    {
        return view('livewire.create-etat-reglement');
    }
}
