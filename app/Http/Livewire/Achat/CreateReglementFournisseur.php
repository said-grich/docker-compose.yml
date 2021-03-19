<?php

namespace App\Http\Livewire\Achat;

use App\Models\BonAchat;
use App\Models\Caisse;
use App\Models\Fournisseur;
use App\Models\Site;
use App\Models\ModePaiement;
use App\Models\ReglementFournisseur;
use App\Models\Compte;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CreateReglementFournisseur extends Component
{

    public $fournisseurId;
    public $siteId;
    public $modePaiementId;
    public $ref;
    public $montant;
    public $dateEcheance;
    public $CompteDebiteurId;
    public $CompteCrediteurId;
    public $remise;
    public $dateEncaissement;
    public $datemiseBanque;
    public $dateEntreeFeuille;
    public $dateImpaye;
    public $ValidationPaiement;
    public $caisse_id;
    public $showCompteCrediteur = false ;
    public $list_bon_reception = [] ;
    //public $impaye = false;


    protected $rules = [
        'fournisseurId' => 'required|min:1',
        'siteId' => 'required|min:1',
        'modePaiementId' => 'required',
        'montant' => 'required',

    ];

    public function updatedFournisseurId($value)
    {
        $fournisseur = Fournisseur::where('id', $value)->first();
        $fournisseur->interne == true ? $this->showCompteCrediteur = true :  $this->showCompteCrediteur = false;

        /* $this->list_bon_reception = BonAchat::join('bon_achat_lines', 'bon_achat_lines.bon_achat_ref', '=' , 'bon_achats.ref')
            ->where('bon_achats.fournisseur_id', $value)
            ->get(['bon_achats.date','bon_achats.ref', 'bon_achat_lines.montant']); */

        $this->list_bon_reception = BonAchat::where('fournisseur_id', $value)
        ->get(['date','ref', 'total_ttc']);
        //dd($this->list_bon_reception);
    }

    public function createReglementFournisseur()
    {

        //$this->validate();
        $item = new ReglementFournisseur();
        $item->fournisseur_id = $this->fournisseurId;
        $item->site_id = $this->siteId;
        $item->mode_paiement_id = $this->modePaiementId;
        $item->ref = $this->ref;
        $item->montant = $this->montant;
        $item->date_echeance = $this->dateEcheance;
        $item->compte_debiteur_id = $this->CompteDebiteurId;
        $item->compte_crediteur_id = $this->CompteCrediteurId;
        $item->remise = $this->remise;
        $item->validation_paiement = $this->ValidationPaiement;
        //$item->impaye = $this->impaye;
        $item->date_mise_banque = $this->datemiseBanque;
        $item->date_entree_feuille = $this->dateEntreeFeuille;
        $item->date_encaissement = $this->dateEncaissement;
        $item->date_impaye = $this->dateImpaye;
        $item->caisse_id = $this->caisse_id;
        //dd($item);
        //$item->deuxime_mise = $this->deuxime_mise;

        $item->save();


        $this->reset(['fournisseurId', 'siteId','modePaiementId','ref','ValidationPaiement','montant','dateEcheance','CompteDebiteurId','CompteCrediteurId','remise','dateEncaissement','datemiseBanque','dateEntreeFeuille','dateImpaye','caisse_id']);


        session()->flash('message', 'Règlement fournisseur successfully added.');
        $this->emit('saved');

    }



    public function render()
    {
        $list_fournisseurs = Fournisseur::all()->sortBy('name');
        $list_sites = Site::all()->sortBy('name');
        $list_paiements = ModePaiement::all()->sortBy('name');
        $list_comptes = Compte::where('site_id',$this->siteId)->get();
        $list_caisses = Caisse::where('site_id',$this->siteId)->get();

        return view('livewire.achat.create-reglement-fournisseur', [ 'list_fournisseurs' => $list_fournisseurs, 'list_sites' => $list_sites, 'list_paiements' => $list_paiements, 'list_comptes' => $list_comptes, 'list_caisses' => $list_caisses ]);
    }
}
