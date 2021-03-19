<?php

namespace App\Http\Livewire\ComptaFinance;

use App\Models\Article;
use App\Models\BonAchat;
use App\Models\BonAchatLine;
use App\Models\BonLivraison;
use App\Models\BonLivraisonLine;
use App\Models\Charge;
use App\Models\ChargeLine;
use App\Models\Client;
use App\Models\Commerciale;
use App\Models\CompteComptable;
use App\Models\Fournisseur;
use App\Models\Produit;
use App\Models\Site;
use App\Models\Ventilation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;


class EditCharge extends Component
{
    use WithPagination;

    public $ida;
    public $numFacture = [];
    public $libelle = [];
    public $tva = [];
    public $montantHt = [];
    public $montantTva = [];
    public $montantTtc = [];
    public $linenumber;
    public $date=[];
    public $ref;
    public $lines_count;
    public $details_lines_count;
    public $ventilation = [];
    public $siteId;
    public $modeEdit = false;
    public $totalMts = [];
    public $totalTtcs = [];
    public $totalTvas = [];
    public $totalMt;
    public $totalTtc;
    public $totalTva;
    public $montant = [];

    public $tauxTva = [];
    public $compteComptable = [];
    public $totalHts = [];

    public $refCharge;
    public $bcRef;
    public $totalHt;

    public $fournisseurId = [];
    public $compteComptableFournisseur = [];
    public $compteComptableHT = [];
    public $compteComptableTVA = [];
    public $libelleCompteComptableHT = [];
    //public $list_bc = [];
    public $listVentilation=[];
    public $codeVentilation;
    public $ventilations=[];

    public $showlistVentilation = false;


    public $tvaInputs = [];

    public $inputs = [];
    public $detailsInputs  =[];
    public $i = 0;
    public $j = 0;

    public $facturedetails = [];

    public $mtHt=[];
    public $mtTva=[];
    public $mtTtc=[];
    public $compteHt=[];
    public $compteTva = [];
    public $numFactureLine=[];


    public $factureMtHt = [];
    public $factureMtTva = [];
    public $factureMtTtc = [];
    //public $codeVentilation = [];
    public $listeCodeVentilation = [];
    public $listeCompteHt = [];
    public $listeCompteTva = [];

    protected $rules = [
        'date' => 'required',
        'ref' => 'required',
        'clientId' => 'required|min:1',
        'commercialId' => 'required|min:1',
        'siteId' => 'required|min:1',
        'type' => 'required',
        'etat' => 'required',

    ];

    public function mount()
    {
        $this->ida = request()->ida;

        $list = ChargeLine::where('charge_ref', $this->ida)->get();


        $this->lines_count = count($list);
        $this->bcRef = $list[0]->charge->bon_reception_ref;
        $this->refCharge = $list[0]->charge->ref;
        $this->siteId = $list[0]->charge->site_id;

        $i = 0;
        foreach ($list as $value) {


            $this->date[$i] =$value->date;
            $this->numFacture[$i] = $value->num_facture;
            $this->libelle[$i] = $value->libelle;
            $this->montantHt[$i] = $value->montant_ht;

            $this->montantTva[$i] = $value->montant_tva;
            $this->montantTtc[$i] = $value->montant_ttc;
            $this->ventilations[$i] = $value->ventilation;

            $this->fournisseurId[$i] = $value->fournisseur_id;
            $this->compteComptableHT[$i] = $value->compte_comptable_ht_id;
            $this->compteComptableTVA[$i] = $value->compte_comptable_Tva_id;


            /*  if (isset($this->compteComptableHT[$i])) {
                $compte = CompteComptable::where('id', $this->compteComptableHT[$i])->first();
                $this->libelleCompteComptableHT[$i] = $compte->name;
            } */
            if (isset($this->fournisseurId[$i])) {

                $fournisseur = Fournisseur::where('id', $this->fournisseurId[$i])->first();
                $this->compteComptableFournisseur[$i] = $fournisseur->code_comptable;
            }

            array_push($this->inputs, $i);
            foreach($this->montantHt[$i] as $key=>$value){

                array_push($this->tvaInputs, $key);
                $this->facturedetails[$key] = [
                    "facture"=>$this->numFacture[$i],
                    "montantHt"=>$value,
                    "montantTva"=>$this->montantTva[$i],
                    "montantTtc"=>$this->montantTtc[$i],
                    "compte_comptable_ht"=>$this->compteComptableHT[$i],
                    "compte_comptable_tva" => $this->compteComptableTVA[$i],
                    "ventilation"=>$this->ventilations[$i],

                ];
            }


            $i++;
        }

        $k = 0;
        foreach($this->facturedetails as $key=>$value){


            $this->mtHt[$k] = number_format(floatval($value["montantHt"]), 2, ',', ' ');
            $this->mtTva[$k] = number_format(floatval($value["montantTva"][$key]), 2, ',', ' ');
            $this->mtTtc[$k] = number_format(floatval($value["montantTtc"][$key]), 2, ',', ' ');
            $this->compteHt[$k] = isset($value["compte_comptable_ht"]) ? $value["compte_comptable_ht"][$key] : 0;
            $this->numFactureLine[$k] = $value["facture"];
            $this->compteTva[$k] = isset($value["compte_comptable_tva"]) ? $value["compte_comptable_tva"][$key] : 0;
            $this->codeVentilation[$k] = isset($value["ventilation"]) ? $value["ventilation"][$key] : 0;

            /* if(isset($value["compte_comptable_ht"])){
                $compte = CompteComptable::where('id', $value["compte_comptable_ht"][$key])->first();
                $this->libelleCompteComptableHT[$k] = $compte->name;

            } */
            $v = Ventilation::firstWhere('taux', $key)->toArray();
            $this->listVentilation[$k] = $v['details'];

            if (isset($this->montantTtc[$k])) {
                $this->totalHt = 0;
                $this->totalTtc = 0;
                $this->totalTva = 0;

                $this->totalHts = [];
                $this->totalTtcs = [];
                $this->totalTvas = [];



                for ($i = 0; $i < count($this->tvaInputs); $i++) {

                    if (array_key_exists(strval($this->tvaInputs[$i]), $this->totalTvas)) {
                        $this->totalTvas[strval($this->tvaInputs[$i])] += $this->montantTva[$i][$key];

                        $this->totalHts[strval($this->tvaInputs[$i])] = $this->totalHts[strval($this->tvaInputs[$i])] + $this->montantHt[$i][$key];
                        $this->totalTtcs[strval($this->tvaInputs[$i])] = $this->totalHts[strval($this->tvaInputs[$i])] + $this->totalTvas[strval($this->tvaInputs[$i])];
                    } else {
                        //dd($this);

                        $this->totalTvas[strval($this->tvaInputs[$i])] = $this->montantTva[$k][$this->tvaInputs[$i]];

                        $this->totalHts[strval($this->tvaInputs[$i])] =  $this->montantHt[$k][$this->tvaInputs[$i]];
                        $this->totalTtcs[strval($this->tvaInputs[$i])] = floatval($this->totalHts[strval($this->tvaInputs[$i])]) + floatval($this->totalTvas[strval($this->tvaInputs[$i])]);
                    }
                }


                $this->totalHt = 0;
                $this->totalHt = array_sum($this->montantHt[$k]);


                $this->totalTva = 0;
                $this->totalTva = array_sum($this->montantTva[$k]);

                $this->totalTtc = $this->totalHt + $this->totalTva;
            }

            $k++;

        }



        $this->totalTvas = array_map(
            function($a) { return floatval($a); },
            $this->totalTvas
        );
        $this->totalHts = array_map(
            function($a) { return floatval($a); },
            $this->totalHts
        );
        $this->totalTtcs = array_map(
            function($a) { return floatval($a); },
            $this->totalTtcs
        );



        $this->details_lines_count = count(array_keys($this->montantHt));


        $j =0;
        $ventilationContent =[];
        $this->ventilation = [];

        /* foreach ($this->numFacture as $taux=> $mt) {

            //$ventilationContent = Ventilation::firstWhere('taux',$taux)->toArray();

            $this->montantHt[$j] = $mt;
            $this->tauxTva[$j] = $taux;
            //$this->ventilation[$j] = json_decode($ventilationContent['details'], true);;
            //$this->ventilation[$j] = $ventilationContent['details'];
            $this->montantTva[$j] =$this->montantTva[$taux];
            $this->montantTtc[$j] =$this->montantTtc[$taux];
            $j++;
        } */
        //dd(array_values($this->ventilation[1]));


        //$this->updateData(0);
    }

    public function updatedTauxTva($value,$tauxTva)
    {
        isset($value) && ($value != 0) ? $this->showlistVentilation = true : $this->showlistVentilation = false;

        $this->ventilation[$tauxTva] = Ventilation::firstWhere('taux',$value)->toArray();

        $this->ventilationTaux = $value;
        //$this->listVentilation = json_decode($this->ventilation[$tauxTva]['details'], true);
        $this->listVentilation = $this->ventilation[$tauxTva]['details'];

    }

    /* public function updatedCompteHT($value,$compteHt)
    {
        $compte = CompteComptable::where('id',$value)->first();
        $this->libelleCompteComptableHT[$compteHt] = $compte->name;
    } */

    public function editCharge()
    {
        $this->factureMtHt = [];
        $this->factureMtTva = [];
        $this->factureMtTtc = [];
        $this->listeCodeVentilation = [];
        $this->listeCompteHt = [];
        $this->listeCompteTva = [];


        foreach ($this->numFactureLine as $key => $value) {


            if (array_key_exists(strval($this->numFactureLine[$key]), $this->factureMtHt) && array_key_exists(strval($this->tvaInputs[$key]), $this->factureMtHt[strval($this->numFactureLine[$key])])) {
                $this->factureMtHt[strval($value)][strval($this->tvaInputs[$key])] += $this->mtHt[$key];
            } else {
                $this->factureMtHt[strval($value)][strval($this->tvaInputs[$key])] = $this->mtHt[$key];
            }

            if (array_key_exists(strval($this->numFactureLine[$key]), $this->factureMtTva) && array_key_exists(strval($this->tvaInputs[$key]), $this->factureMtTva[strval($this->numFactureLine[$key])])) {
                $this->factureMtTva[strval($value)][strval($this->tvaInputs[$key])] += $this->mtTva[$key];
            } else {
                $this->factureMtTva[strval($value)][strval($this->tvaInputs[$key])] = $this->mtTva[$key];
            }

            if (array_key_exists(strval($this->numFactureLine[$key]), $this->factureMtTtc) && array_key_exists(strval($this->tvaInputs[$key]), $this->factureMtTtc[strval($this->numFactureLine[$key])])) {
                $this->factureMtTtc[strval($value)][strval($this->tvaInputs[$key])] += $this->mtTtc[$key];
            } else {
                $this->factureMtTtc[strval($value)][strval($this->tvaInputs[$key])] = $this->mtTtc[$key];
            }

            $this->listeCodeVentilation[$value][strval($this->tvaInputs[$key])] = $this->codeVentilation[$key];
            $this->listeCompteHt[$value][strval($this->tvaInputs[$key])] = $this->compteHt[$key];
            $this->listeCompteTva[$value][strval($this->tvaInputs[$key])] = $this->compteTva[$key];
        }

        //$this->validate();

        DB::transaction(function () {
            //dd($this->totalTtc);

            foreach ($this->numFacture as $key => $value) {

                if(isset($this->listeCodeVentilation[$value])){
                    Charge::where('ref', $this->refCharge)
                    ->update([
                        'montant_total_ttc' => $this->totalTtc,
                        'montant_total_ht' => $this->totalHt,
                        'is_valid' => true,
                    ]);
                }

                ChargeLine::where('charge_ref', $this->refCharge)
                    ->where('num_facture', $value)
                    ->update([
                        'montant_ht' => $this->factureMtHt[$value],
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

            foreach ($bonReceptionLignes as $ligne) {
                $article =  Article::where('id', $ligne->article_id)->first();

                Produit::where('article_id', $ligne->article_id)
                    ->where('num_lot', $ligne->num_lot)
                    ->update([
                        'prix_plus_charges_directes' => $ligne->prix_achat + $coutRevientUnitaire,
                        'prix_vente' => $ligne->prix_achat + $coutRevientUnitaire + $article->marge,
                    ]);
            }
        });

        session()->flash('message', "Le charge directe $this->refCharge a été modifiée.");



        $this->emit('saved');
    }

    public function add()
    {
        $this->i++;
        array_push($this->inputs, $this->i);
    }

    public function addDetails($i)
    {
        $i = count($this->inputs) +$this->details_lines_count + 1;
        $this->i = $i;
        array_push($this->inputs , $i);
    }


    public function remove($i)
    {
        $this->lines_count--;

    }

    public function removeDetails($i)
    {
        //array_splice($this->inputs, $i-1, 1);
        array_pop($this->inputs);
        $this->i --;

    }


    public function updateData($i)
    {

        /* if (isset($this->compteComptableHT[$i])) {
            $compte = CompteComptable::where('id', $this->compteComptableHT[$i])->first();
            $this->libelleCompteComptableHT[$i] = $compte->name;
        } */

        if (!isset($this->tva[$i])) {
            $this->tva[$i] = 0;
        }

        if (isset($this->prix[$i]) && isset($this->qte[$i])) {

            array_splice($this->montant, $i, 1, $this->prix[$i] > 0 ? $this->qte[$i] * $this->prix[$i] : $this->qte[$i] * 0);

            array_splice($this->montanttva, $i, 1, $this->tva[$i] > 0 ? $this->qte[$i] * ($this->prix[$i] * ($this->tva[$i] / 100)) : $this->tva[$i] * 0);

            $this->totalMts = [];
            $this->totalTtcs = [];
            $this->totalTvas = [];

            for ($i = 0; $i < count($this->tva); $i++) {
                if (array_key_exists(strval($this->tva[$i]), $this->totalTvas)) {
                    $this->totalTvas[strval($this->tva[$i])] += $this->montanttva[$i];

                    $this->totalMts[strval($this->tva[$i])] = $this->totalMts[strval($this->tva[$i])] + $this->montant[$i];
                    $this->totalTtcs[strval($this->tva[$i])] = $this->totalMts[strval($this->tva[$i])] + $this->totalTvas[strval($this->tva[$i])];
                } else {
                    $this->totalTvas[strval($this->tva[$i])] = $this->montanttva[$i];

                    $this->totalMts[strval($this->tva[$i])] =  $this->montant[$i];
                    $this->totalTtcs[strval($this->tva[$i])] = $this->totalMts[strval($this->tva[$i])] + $this->totalTvas[strval($this->tva[$i])];
                }
            }

            $this->totalMt = 0;
            for ($i = 0; $i < count($this->montant); $i++) {
                $this->totalMt += $this->montant[$i];
            }

            $this->totalTva = 0;
            for ($i = 0; $i < count($this->montanttva); $i++) {
                $this->totalTva += $this->montanttva[$i];
            }

            $this->totalTtc = $this->totalMt + $this->totalTva;
        }
    }



    public function render()
    {

        $list_sites = Site::all()->sortBy('code');
        $list_bc = BonAchat::all()->sortBy('ref');
        $comptes_comptable_fournisseur = CompteComptable::where('code', 'LIKE', '4411%')->get();
        $comptes_comptable_HT = CompteComptable::where('code', 'like', '611%')->whereRaw('LENGTH(code) = 4')->get();
        $comptes_comptable_TVA = CompteComptable::where('code', 'LIKE', '345%')->whereRaw('LENGTH(code) = 4')->get();
        $list_fournisseurs = Fournisseur::all()->sortBy('name');

        return view('livewire.compta-finance.edit-charge', ['list_bc' =>  $list_bc,'comptes_comptable_fournisseur'=> $comptes_comptable_fournisseur,'list_sites'=>$list_sites,'list_fournisseurs'=>$list_fournisseurs,'comptes_comptable_HT'=> $comptes_comptable_HT,'comptes_comptable_TVA'=> $comptes_comptable_TVA,'lines_count' => $this->lines_count]);



    }
}
