<?php

namespace App\Http\Livewire\Achat;

use App\Models\Fournisseur;
use App\Models\ModePaiement;
use Livewire\Component;

class ShowFournisseur extends Component
{
    public $name;
    public $ice;
    public $designation;
    public $idFiscal;
    public $adresse;
    public $code_postal;
    public $code_comptable;
    public $ville;
    public $pays;
    public $canton;
    public $phone;
    public $telephone_fixe;
    public $fax;
    public $email;
    public $modePaiementId;

    protected $rules = [
        'name' => 'required',
        'ice' => 'required',
        'idFiscal' => 'required',
        'designation' => 'required',
        'adresse' => 'required',
        'ville' => 'required',
        'pays' => 'required',
        'phone' => 'required|min:10',
        'telephone_fixe' => 'required|min:10',
        'email' => 'required',
        'modePaiementId' => 'required',
    ];


    public function createFournisseur()
    {
        $this->validate();

        $item = new Fournisseur();
        $item->name = $this->name;
        $item->ice = $this->ice;
        $item->idFiscal = $this->idFiscal;
        $item->designation = $this->designation;
        $item->adresse = $this->adresse;
        $item->code_comptable = $this->code_comptable;
        $item->code_postal = $this->code_postal;
        $item->ville = $this->ville;
        $item->pays = $this->pays;
        $item->canton = $this->canton;
        $item->phone = $this->phone;
        $item->telephone_fixe = $this->telephone_fixe;
        $item->fax = $this->fax;
        $item->email = $this->email;
        $item->mode_paiement_id = $this->modePaiementId;
        $item->save();


        $this->reset(['name', 'ice','idFiscal','designation','adresse','code_comptable','code_postal','ville','pays','canton','phone','telephone_fixe','fax','email','modePaiementId']);


        session()->flash('message', 'Fournisseur successfully added.');

        $this->emit('fournisseurAdded');

    }

    public function render()
    {
        $list_paiements = ModePaiement::all()->sortBy('name');
        return view('livewire.achat.show-fournisseur', [ 'list_paiements' => $list_paiements ]);
    }
}
