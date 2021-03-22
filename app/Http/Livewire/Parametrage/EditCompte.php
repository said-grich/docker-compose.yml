<?php

namespace App\Http\Livewire\Parametrage;

use App\Models\Compte;
use App\Models\Site;
use App\Models\CompteComptable;
use Livewire\Component;

class EditCompte extends Component
{

    public $name;
    public $typeCompte;
    public $devise;
    public $etat;
    public $paysCompte;
    public $date;
    public $nameBanque;
    public $numCompte;
    public $swift;
    public $siteId;
    public $compte;
    public $codeComptable;
    public $ida;

    protected $rules = [

        'name' => 'required',
    ];

    public function mount()
    {
        $this->ida = request()->ida;
        $this->compte = Compte::findOrFail($this->ida);
        $this->name= $this->compte->name;
        $this->typeCompte= $this->compte->type_compte;
        $this->devise= $this->compte->devise;
        $this->etat= $this->compte->etat;
        $this->paysCompte= $this->compte->pays_compte;
        $this->date= $this->compte->date;
        $this->nameBanque= $this->compte->name_banque;
        $this->numCompte= $this->compte->num_compte;
        $this->swift= $this->compte->swift;
        $this->siteId= $this->compte->site_id;
        $this->codeComptable= $this->compte->code_comptable;
    }

    public function editCompte()
    {
            $this->compte->name = $this->name;
            $this->compte->type_compte =$this->typeCompte;
            $this->compte->devise =$this->devise;
            $this->compte->etat =$this->etat;
            $this->compte->pays_compte =$this->paysCompte;
            $this->compte->date =$this->date;
            $this->compte->name_banque =$this->nameBanque;
            $this->compte->num_compte =$this->numCompte;
            $this->compte->swift =$this->swift;
            $this->compte->site_id =$this->siteId;
            $this->compte->code_comptable =$this->codeComptable;
            $this->compte->save();

            return redirect()->to('/create-compte');

    }


    public function render()
    {
        $list_sites = Site::all()->sortBy('name');
        $list_comptes_comptables = CompteComptable::all()->sortBy('name');
        return view('livewire.Parametrage.edit-compte', [ 'list_sites' => $list_sites, 'list_comptes_comptables' => $list_comptes_comptables  ]);
    }
}
