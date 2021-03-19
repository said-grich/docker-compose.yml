<?php

namespace App\Http\Livewire\Achat;

use App\Models\BonAchat;
use App\Models\Caisse;
use App\Models\Fournisseur;
use App\Models\Site;
use App\Models\ModePaiement;
use App\Models\Compte;
use App\Models\ReglementFournisseur;
use Livewire\Component;

class EditReglementFournisseur extends Component
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
    public $ValidationPaiement;
    //public $impaye;
    public $dateImpaye;
    public $reglementFournisseur;
    public $ida;
    public $showCompteCrediteur ;
    public $showCheque = false ;
    public $showEspeces = false ;
    public $showVirement = false ;

    public $showDateEncaissement = false ;
    public $showDateImpaye = false ;


    protected $rules = [
        'fournisseurId' => 'required|min:1',
        'siteId' => 'required|min:1',
        'modePaiementId' => 'required',
        'montant' => 'required',
        'dateEcheance' => 'required',

    ];

    public function updatedFournisseurId($value)
    {
        $fournisseur = Fournisseur::where('id', $value)->first();
        $fournisseur->interne == true ? $this->showCompteCrediteur = true :  $this->showCompteCrediteur = false;

        $this->list_bon_reception = BonAchat::where('fournisseur_id', $value)
        ->get(['date','ref', 'total_ttc']);

        //$test = ReglementFournisseur::where('mode_paiement_id', $value)->first();

        //dd($test);

    }

    public function mount()
    {
        $this->ida = request()->ida;
        $this->reglementFournisseur = ReglementFournisseur::findOrFail($this->ida);
        $this->fournisseurId= $this->reglementFournisseur->fournisseur_id;
        $this->siteId= $this->reglementFournisseur->site_id;

        $this->modePaiementId= $this->reglementFournisseur->mode_paiement_id;
        if($this->modePaiementId == 1){
            $this->showEspeces = true ;
        }else if( $this->modePaiementId == 2 ){
            $this->showCheque = true;
        }else if( $this->modePaiementId == 3 ){
            $this->showVirement = true;
        }
        //dd($this->showVirement);
        $this->ref= $this->reglementFournisseur->ref;
        $this->montant= $this->reglementFournisseur->montant;
        $this->dateEcheance= $this->reglementFournisseur->date_echeance;
        $this->CompteDebiteurId= $this->reglementFournisseur->compte_debiteur_id;
        $this->CompteCrediteurId= $this->reglementFournisseur->compte_crediteur_id;
        $this->remise= $this->reglementFournisseur->remise;
        $this->ValidationPaiement= $this->reglementFournisseur->validation_paiement;
        if($this->ValidationPaiement == "Payé"){
            $this->showDateEncaissement = true ;
        }else if( $this->ValidationPaiement == "Impayé"){
            $this->showDateImpaye = true;
        }
        //dd($this->showDateImpaye);
        $this->datemiseBanque= $this->reglementFournisseur->date_mise_banque;
        $this->dateEntreeFeuille= $this->reglementFournisseur->date_entree_feuille;
        $this->dateEncaissement= $this->reglementFournisseur->date_encaissement;
        //$this->impaye= $this->reglementFournisseur->impaye;
        $this->dateImpaye= $this->reglementFournisseur->date_impaye;
        $this->caisse_id= $this->reglementFournisseur->caisse_id;
    }

    public function editReglementFournisseur()
    {
        $this->reglementFournisseur->fournisseur_id = $this->fournisseurId;
        $this->reglementFournisseur->site_id =$this->siteId;
        $this->reglementFournisseur->mode_paiement_id = $this->modePaiementId;
        $this->reglementFournisseur->ref =$this->ref;
        $this->reglementFournisseur->montant =$this->montant;
        $this->reglementFournisseur->date_echeance =$this->dateEcheance;
        $this->reglementFournisseur->compte_debiteur_id =$this->CompteDebiteurId;
        $this->reglementFournisseur->compte_crediteur_id = $this->CompteCrediteurId;
        $this->reglementFournisseur->remise =$this->remise;
        $this->reglementFournisseur->validation_paiement = $this->ValidationPaiement;
        $this->reglementFournisseur->date_mise_banque =$this->datemiseBanque;
        $this->reglementFournisseur->date_entree_feuille =$this->dateEntreeFeuille;
        $this->reglementFournisseur->date_encaissement =$this->dateEncaissement;
        //$this->reglementFournisseur->impaye =$this->impaye;
        $this->reglementFournisseur->date_impaye =$this->dateImpaye;
        $this->reglementFournisseur->caisse_id =$this->caisse_id;
        $this->reglementFournisseur->save();

        return redirect()->to('/create-reglement-fournisseur');

    }


    public function render()
    {
        $list_fournisseurs = Fournisseur::all()->sortBy('name');
        $list_sites = Site::all()->sortBy('name');
        $list_paiements = ModePaiement::all()->sortBy('name');

        $list_comptes = Compte::where('site_id',$this->siteId)->get();
        $list_caisses = Caisse::where('site_id',$this->siteId)->get();
        return view('livewire.achat.edit-reglement-fournisseur', [ 'list_fournisseurs' => $list_fournisseurs, 'list_sites' => $list_sites, 'list_paiements' => $list_paiements, 'list_comptes' => $list_comptes, 'list_caisses' => $list_caisses]);
    }
}
