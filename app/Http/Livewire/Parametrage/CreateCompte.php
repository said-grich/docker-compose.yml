<?php

namespace App\Http\Livewire\Parametrage;

use App\Models\Compte;
use App\Models\Site;
use App\Models\CompteComptable;
use Livewire\Component;

class CreateCompte extends Component
{
    public $codeComptable;
    public $name;
    public $siteId;
    public $date;
    public $nameBanque;
    public $numCompte;
    public $swift;
    public $typeCompte;
    public $devise;
    public $etat;
    public $paysCompte;
    public $compteComptableId;

    protected $rules = [

        'name' => 'required',
        'siteId' => 'required|min:1',
    ];


    public function createCompte()
    {
        $this->validate();

        $item = new Compte();
        $item->name = $this->name;
        $item->type_compte = $this->typeCompte;
        $item->devise = $this->devise;
        $item->etat = $this->etat;
        $item->pays_compte = $this->paysCompte;
        $item->date = $this->date;
        $item->name_banque = $this->nameBanque;
        $item->num_compte = $this->numCompte;
        $item->swift = $this->swift;
        $item->site_id = $this->siteId;
        $item->compte_comptable_id = $this->compteComptableId;
        $item->code_comptable = $this->codeComptable;
        //dd($item);
        $item->save();

        $this->reset(['name','typeCompte','devise','etat','paysCompte','date','nameBanque','numCompte','swift','siteId','compteComptableId','codeComptable']);

        $this->emit('saved');
    }

    public function render()
    {
        $list_sites = Site::all()->sortBy('name');
        $list_comptes_comptables = CompteComptable::all()->sortBy('name');
        return view('livewire.Parametrage.create-compte', [ 'list_sites' => $list_sites, 'list_comptes_comptables' => $list_comptes_comptables ]);
    }
}
