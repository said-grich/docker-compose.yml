<?php

namespace App\Http\Livewire\Paramétrage;

use App\Models\Fournisseur;
use App\Models\ModePaiement;
use Livewire\Component;

class EditFournisseur extends Component
{

    public $name;
    public $adresse;
    public $code_comptable;
    public $code_postal;
    public $ville;
    public $pays;
    public $canton;
    public $phone;
    public $telephone_fixe;
    public $fax;
    public $email;
    public $modePaiementId;
    public $fournisseur;
    public $ida;

    protected $rules = [
        'name' => 'required|min:2',
        'adresse' => 'required',
        'code_postal' => 'required',
        'ville' => 'required',
        'pays' => 'required',
        'canton' => 'required',
        'phone' => 'required|min:10',
        'telephone_fixe' => 'required',
        'fax' => 'required',
        'email' => 'required',
        'modePaiementId' => 'required',

        //'activer' => 'required',
    ];

    public function mount()
    {
        $this->ida = request()->ida;
        $this->fournisseur = Fournisseur::findOrFail($this->ida);
        $this->name= $this->fournisseur->name;
        $this->adresse= $this->fournisseur->adresse;
        $this->code_comptable= $this->fournisseur->code_comptable;
        $this->code_postal= $this->fournisseur->code_postal;
        $this->ville= $this->fournisseur->ville;
        $this->pays= $this->fournisseur->pays;
        $this->canton= $this->fournisseur->canton;
        $this->phone= $this->fournisseur->phone;
        $this->telephone_fixe= $this->fournisseur->telephone_fixe;
        $this->fax= $this->fournisseur->fax;
        $this->email= $this->fournisseur->email;
        $this->modePaiementId= $this->fournisseur->mode_paiement_id;

    }

    public function editFournisseur()
    {

            $this->fournisseur->name = $this->name;
            $this->fournisseur->adresse = $this->adresse;
            $this->fournisseur->code_comptable = $this->code_comptable;
            $this->fournisseur->code_postal = $this->code_postal;
            $this->fournisseur->ville = $this->ville;
            $this->fournisseur->pays = $this->pays;
            $this->fournisseur->canton = $this->canton;
            $this->fournisseur->phone = $this->phone;
            $this->fournisseur->code_postal = $this->code_postal;
            $this->fournisseur->telephone_fixe = $this->telephone_fixe;
            $this->fournisseur->fax = $this->fax;
            $this->fournisseur->email = $this->email;
            $this->fournisseur->mode_paiement_id = $this->modePaiementId;
            $this->fournisseur->save();

            return redirect()->to('/create-fournisseur');

    }


    public function render()
    {
        $list_paiements = ModePaiement::all()->sortBy('name');
        return view('livewire.paramétrage.edit-fournisseur', [ 'list_paiements' => $list_paiements ]);
    }
}
