<?php

namespace App\Http\Livewire\ComptaFinance;

use App\Models\Article;
use App\Models\BonAchat;
use App\Models\BonAchatLine;
use App\Models\Charge;
use App\Models\ChargeLine;
use App\Models\CompteComptable;
use App\Models\Fournisseur;
use App\Models\Produit;
use App\Models\Site;
use App\Models\Ventilation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CreateCharges extends Component
{

    public $libelle = [];
    public $montant = [];
    public $montantTva = [];
    public $montantTtc = [];
    public $tauxTva = [];
    public $compteComptable = [];
    public $totalHts = [];
    public $totalTtcs = [];
    public $totalTvas = [];
    public $refCharge;
    public $bcRef;
    public $totalHt;
    public $totalTtc;
    public $totalTva;
    public $siteId;
    public $numFacture = [];
    public $date = [];
    public $fournisseurId = [];
    public $compteComptableFournisseur = [];
    public $compteComptableHT = [];
    public $compteComptableTVA = [];
    public $libelleCompteComptableHT = [];
    public $list_bc = [];
    public $listVentilation=[];
    public $ventilation=[];
    public $showlistVentilation = false;
    public $ventilationTaux;
    public $list_fournisseurs=[];
    public $selectedTaux = [];
    public $selectedTaux10 = [];
    public $selectedTaux20 = [];
    public $selectedTaux14 = [];
    public $selectedTaux7 = [];
    public $factureDetails = [];
    public $listTauxTva=[];
    public $mt = [];
    public $tvaInputs = [];
    public $factureMtHt =[];
    public $factureMtTva = [];
    public $factureMtTtc = [];
    public $codeVentilation =[];
    public $listeCodeVentilation = [];
    public $listeCompteHt=[];
    public $listeCompteTva=[];



    protected $rules = [
        'refCharge' => 'required',
        'bcRef' => 'required',
        'siteId' => 'required',
    ];

    protected $listeners = ['fournisseurAdded' => 'renderFournisseurs'];

    public $inputs = [];
    public $detailsInputs  =[];
    public $i = 0;
    public $j = 0;

    public function renderFournisseurs()
    {
        $this->list_fournisseurs = Fournisseur::all()->sortBy('name');
    }

    /* public function updatedCodeVentilation($value)
    {
        $this->ventilation[$this->i] = $value;
        $this->showlistVentilation = false;

    } */



    public function updatedSelectedTaux($value,$selectedTaux){
            array_push($this->detailsInputs, $this->j);

            array_push($this->tvaInputs,$this->selectedTaux[$selectedTaux]);


            $this->selectedTaux[$selectedTaux] != 0 ? $this->ventilation[$selectedTaux] = Ventilation::firstWhere('taux',strval($this->selectedTaux[$selectedTaux]))->toArray() :$this->ventilation[$selectedTaux]=[] ;

            //$this->listVentilation = json_decode($this->ventilation[$tauxTva]['details'], true);
            $value != 0 ? $this->listVentilation[$this->j] = $this->ventilation[$selectedTaux]['details']: [];

            $this->factureDetails[$this->j] = $this->numFacture[$selectedTaux];
            //$this->selectedTaux[$this->j] = $this->selectedTaux[$selectedTaux];

            $this->montant[$this->j] = ((float)$this->mt[$selectedTaux])/ (1+(intval($this->tvaInputs[$this->j])/100));

            $this->montantTva[$this->j] = ((float)$this->mt[$selectedTaux]) - ($this->montant[$this->j]);
            $this->montantTtc[$this->j] = (float)$this->mt[$selectedTaux];


            if (isset($this->montantTtc[$this->j])) {
                $this->totalHt = 0;
                $this->totalTtc = 0;
                $this->totalTva = 0;

                $this->totalHts = [];
                $this->totalTtcs = [];
                $this->totalTvas = [];



                for ($i = 0; $i < count($this->tvaInputs); $i++) {

                    if (array_key_exists(strval($this->tvaInputs[$i]), $this->totalTvas)) {
                        $this->totalTvas[strval($this->tvaInputs[$i])] += $this->montantTva[$i];

                        $this->totalHts[strval($this->tvaInputs[$i])] = $this->totalHts[strval($this->tvaInputs[$i])] + $this->montant[$i];
                        $this->totalTtcs[strval($this->tvaInputs[$i])] = $this->totalHts[strval($this->tvaInputs[$i])] + $this->totalTvas[strval($this->tvaInputs[$i])];
                    } else {
                        // dd($this);
                        $this->totalTvas[strval($this->tvaInputs[$i])] = $this->montantTva[$i];

                        $this->totalHts[strval($this->tvaInputs[$i])] =  $this->montant[$i];
                        $this->totalTtcs[strval($this->tvaInputs[$i])] = $this->totalHts[strval($this->tvaInputs[$i])] + $this->totalTvas[strval($this->tvaInputs[$i])];
                    }
                }


                $this->totalHt = 0;
                for ($i = 0; $i < count($this->montant); $i++) {
                    $this->totalHt += $this->montant[$i];
                }

                $this->totalTva = 0;
                for ($i = 0; $i < count($this->montantTva); $i++) {
                    $this->totalTva += $this->montantTva[$i];
                }

                $this->totalTtc = $this->totalHt + $this->totalTva;
            }


            $this->factureMtHt = [];
            $this->factureMtTva = [];


            /* foreach ($this->factureDetails as $key => $value) {


                if (array_key_exists(strval($this->factureDetails[$key]), $this->factureMtHt) && array_key_exists(strval($this->tvaInputs[$key]), $this->factureMtHt[strval($this->factureDetails[$key])])) {
                    $this->factureMtHt[strval($value)][strval($this->tvaInputs[$key])] += $this->montant[$key];

                }else{
                    $this->factureMtHt[strval($value)][strval($this->tvaInputs[$key])] = $this->montant[$key];

                }

                if (array_key_exists(strval($this->factureDetails[$key]), $this->factureMtTva) && array_key_exists(strval($this->tvaInputs[$key]), $this->factureMtTva[strval($this->factureDetails[$key])])) {
                    $this->factureMtTva[strval($value)][strval($this->tvaInputs[$key])] += $this->montantTva[$key];
                } else {
                    $this->factureMtTva[strval($value)][strval($this->tvaInputs[$key])] = $this->montantTva[$key];
                }



            } */

            $this->mt[$selectedTaux] = [];

            $this->j++;
            $this->selectedTaux[$selectedTaux] = false;


   }

   /* public function updatedcodeVentilation($value,$index){

       $this->listeCodeVentilation=[];
       foreach ($this->factureDetails as $key => $value) {
           //dd($value);
            $this->listeCodeVentilation[$value][strval($this->tvaInputs[$key])] = [$this->codeVentilation[$key]];
        }


   } */


    public function updatedTauxTva($value)
    {
        isset($value) && ($value != 0) ? $this->showlistVentilation = true : $this->showlistVentilation = false;

        $ventilationContent = Ventilation::firstWhere('taux',$value)->toArray();
        $this->ventilationTaux = $value;
        $this->listVentilation = json_decode($ventilationContent['details'], true);

    }


    public function updatedFournisseurId($value,$fournisseurId)
    {
        if (isset($this->fournisseurId)) {
            $fournisseur = Fournisseur::where('id', $this->fournisseurId[$fournisseurId])->first();
            $this->compteComptableFournisseur[$fournisseurId] = $fournisseur->code_comptable;

        }

    }

    public function updatedNumFacture($value,$numFacture)
    {
        $fournisseur = Fournisseur::where('id', $this->fournisseurId[$numFacture])->first();
        $this->libelle[$numFacture] = "FN ".$this->numFacture[$numFacture]." ".$fournisseur->name;

    }

    public function updatedSiteId($siteId)
    {
        $this->list_bc = BonAchat::where('site_id', $this->siteId)->get();
    }

    /* public function updatedCompteComptableHT($value,$compteComptableHT)
    {
        $compte = CompteComptable::where('id',$value)->first();
        $this->libelleCompteComptableHT[$compteComptableHT] = $compte->name;
    } */


    public function add()
    {
        $this->i++;
        array_push($this->inputs, $this->i);
    }

    public function addDetails()
    {
        $this->j++;
        array_push($this->detailsInputs, $this->j);
    }

    public function remove($i)
    {
        array_splice($this->inputs, $i - 1, 1);
        $this->i--;
        array_splice($this->libelle, $i, 1);
        array_splice($this->montant, $i, 1);
        //$this->updateData(0);
    }


    public function saveCharge()
    {

        $this->validate();

        DB::transaction(function () {
            $item = new Charge();
            $item->ref = $this->refCharge;
            $item->montant_total_ht = $this->totalHt;
            $item->montant_total_ttc = $this->totalTtc;
            $item->site_id = $this->siteId;
            $item->bon_reception_ref = $this->bcRef;
            $item->is_valid = true;
            $item->user_id = Auth::user()->id;
            //dd($item);
            $item->save();


            $this->factureMtHt = [];
            $this->factureMtTva = [];
            $this->factureMtTtc = [];
            $this->listeCodeVentilation=[];
            $this->listeCompteHt=[];
            $this->listeCompteTva=[];



            foreach ($this->factureDetails as $key => $value) {


                if (array_key_exists(strval($this->factureDetails[$key]), $this->factureMtHt) && array_key_exists(strval($this->tvaInputs[$key]), $this->factureMtHt[strval($this->factureDetails[$key])])) {
                    $this->factureMtHt[strval($value)][strval($this->tvaInputs[$key])] += $this->montant[$key];

                }else{
                    $this->factureMtHt[strval($value)][strval($this->tvaInputs[$key])] = $this->montant[$key];

                }

                if (array_key_exists(strval($this->factureDetails[$key]), $this->factureMtTva) && array_key_exists(strval($this->tvaInputs[$key]), $this->factureMtTva[strval($this->factureDetails[$key])])) {
                    $this->factureMtTva[strval($value)][strval($this->tvaInputs[$key])] += $this->montantTva[$key];
                } else {
                    $this->factureMtTva[strval($value)][strval($this->tvaInputs[$key])] = $this->montantTva[$key];
                }

                if (array_key_exists(strval($this->factureDetails[$key]), $this->factureMtTtc) && array_key_exists(strval($this->tvaInputs[$key]), $this->factureMtTtc[strval($this->factureDetails[$key])])) {
                    $this->factureMtTtc[strval($value)][strval($this->tvaInputs[$key])] += $this->montantTva[$key];
                } else {
                    $this->factureMtTtc[strval($value)][strval($this->tvaInputs[$key])] = $this->montantTtc[$key];
                }
                //dd( $this->codeVentilation[0]);
                /* if (isset($this->codeVentilation[$key])) {
                    dd($this->codeVentilation[$key]);
                    $this->listeCodeVentilation[strval($this->montant[$key])] = $this->codeVentilation[$key];
                } */
                $this->listeCodeVentilation[$value][strval($this->tvaInputs[$key])] = $this->codeVentilation[$key];
                $this->listeCompteHt[$value][strval($this->tvaInputs[$key])] = $this->compteComptableHT[$key];
                $this->listeCompteTva[$value][strval($this->tvaInputs[$key])] = $this->compteComptableTVA[$key];


            }

            /* $this->listeCodeVentilation=[];
            foreach ($this->factureDetails as $key => $value) {
                //dd($value);
                $this->listeCodeVentilation[$value][strval($this->tvaInputs[$key])] = $this->codeVentilation[$key];

            } */

            foreach ($this->numFacture as $key => $value) {


                ChargeLine::create([
                    'charge_ref' => $this->refCharge,
                    'date' => $this->date[$key],
                    'fournisseur_id' => $this->fournisseurId[$key],
                    'compte_comptable_fournisseur_id' => $this->compteComptableFournisseur[$key],
                    'num_facture' => $this->numFacture[$key],
                    'libelle' => $this->libelle[$key],
                    'montant_ht' => $this->factureMtHt[$value],
                    //'tva' => $this->tauxTva[$key],
                    'ventilation' => $this->listeCodeVentilation[$value],
                    'montant_tva' => $this->factureMtTva[$value],
                    'montant_ttc' => $this->factureMtTtc[$value],
                    'compte_comptable_ht_id' => $this->listeCompteHt[$value],
                    'compte_comptable_Tva_id' => $this->listeCompteTva[$value],
                ]);
            }

            $qteTotale = BonAchatLine::where('bon_achat_ref', $this->bcRef)->sum('qte');
            $coutRevientUnitaire =  ($this->totalHt / $qteTotale);

            $bonReceptionLignes = BonAchatLine::where('bon_achat_ref', $this->bcRef)->get();
            //dd(Produit::all());

            foreach($bonReceptionLignes as $ligne){
                $article =  Article::where('id', $ligne->article_id)->first();
                //dd($article->marge);
                Produit::where('article_id', $ligne->article_id)
                ->where('num_lot', $ligne->num_lot)
                ->update([
                    'prix_plus_charges_directes' => $ligne->prix_achat + $coutRevientUnitaire,
                    'prix_vente' => $ligne->prix_achat + $coutRevientUnitaire + $article->marge,
                ]);

            }

        });

        session()->flash('message', "Le charge directe $this->refCharge a été crée.");

        $this->reset(['refCharge', 'siteId','bcRef','date','fournisseurId','siteId','compteComptableFournisseur','numFacture','libelle','montant','tauxTva','ventilation','montantTva','montantTtc','compteComptableHT','compteComptableTVA','totalHt','totalTva','totalTtc','totalHt','totalTvas','totalHts','totalTtcs']);

        $this->emit('saved');
    }

    public function render()
    {

        $this->renderFournisseurs();

        $list_sites = Site::all()->sortBy('code');
        $comptes_comptable_fournisseur = CompteComptable::where('code', 'LIKE', '4411%')->get();
        $comptes_comptable_HT = CompteComptable::where('code', 'like', '611%')->whereRaw('LENGTH(code) = 4')->get();
        $comptes_comptable_TVA = CompteComptable::where('code', 'LIKE', '345%')->whereRaw('LENGTH(code) = 4')->get();

        $this->listTauxTva = [0,7,10,14,20];
        //$this->list_fournisseurs = Fournisseur::all()->sortBy('name');

        return view('livewire.compta-finance.create-charges', ['list_bc' =>  $this->list_bc,'comptes_comptable_fournisseur'=> $comptes_comptable_fournisseur,'list_sites'=>$list_sites,'comptes_comptable_HT'=> $comptes_comptable_HT,'comptes_comptable_TVA'=> $comptes_comptable_TVA,'listTauxTva' =>  $this->listTauxTva]);
    }
}
