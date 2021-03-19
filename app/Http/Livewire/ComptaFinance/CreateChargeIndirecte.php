<?php

namespace App\Http\Livewire\ComptaFinance;

use App\Models\ChargeDirecte;
use App\Models\ChargeDirecteLine;
use App\Models\ChargeIndirecte;
use App\Models\ChargeIndirecteLine;
use App\Models\CompteComptable;
use App\Models\Fournisseur;
use App\Models\Site;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CreateChargeIndirecte extends Component
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
    public $listVentilation;
    public $ventilation=[];
    public $codeVentilation;
    public $showlistVentilation = false;



    protected $rules = [
        'libelle' => 'required',
        'montant' => 'required',
        'refCharge' => 'required',
    ];

    public $inputs = [];
    public $i = 0;

    public function updatedCodeVentilation($value)
    {
        $this->ventilation[$this->i] = $value;
        $this->showlistVentilation = false;

    }

    public function updatedTauxTva($value)
    {
        isset($value) & ($value != 0) ? $this->showlistVentilation = true : $this->showlistVentilation = false;

        $ventilation7 = collect([
            ['ACHATS NON IMMOBILISÉS' =>
                ['151' => "7% ACHAT A L'IMPORTATION",
                '152' => " 7% ACHAT A L'INTÉRIEUR
                ",
                '169' => "7% AUTRES IMMOBILISATIONS",
                ],
            ],
        ]);

        $ventilation10 = collect([
            ['ACHATS NON IMMOBILISÉS' =>
                ['142' => "10% OPÉRATION DE BANQUE",
                '143' => "10% HÔTELS & IMMOBILIER TOURISTIQUE",
                '144' => "10% OPÉRATIONS AVOCATS, INTERPRÈTES, NOTAIRES, VÉTÉRINAIRES",
                '153' => "10% AUTRES PRESTATIONS DE SERVICES ",
                '149' => "10% ACHAT A L'IMPORTATION",
                '150' => "10% ACHAT A L'INTERIEUR",
                ],
            ],
        ]);

        $ventilation14 = collect([
            ['ACHATS NON IMMOBILISÉS' =>
                ['141' => "14% TRANSPORT",
                '147' => "14% ACHAT A L'IMPORTATION",
                '148' => "14% ACHAT A L'INTERIEUR",
                ],
            ],
            ['IMMOBILISATIONS' =>
                [' 168 ' => "14% AUTRES IMMOBILISATIONS"],
            ],
        ]);

        $ventilation20 = collect([
            ['ACHATS NON IMMOBILISÉS' =>
                ['140' => "20% PRESTATION DE SERVICES",
                '145' => "20% ACHAT A L'IMPORTATION",
                '146' => "20% ACHAT A L'INTERIEUR",
                '155' => "20% TRAVAUX A FAÇON",
                '156' => "20% SOUS TRAITANCE (TRAVAUX IMMOBILIERS)",
                ],
            ],
            ['IMMOBILISATIONS' =>
                ['162' => "20% ACHAT A L'IMPORTATION",
                '163' => "20% ACHAT A L'INTERIEUR",
                '164' => "20% LIVRAISON A SOI-MEME AUTRE QUE LES CONSTRUCTIONS",
                '165' => "20% INSTALLATION & POSE",
                '166' => "20% CONSTRUCTIONS",
                '167' => "20% LIVRAISON A SOI-MEME DE CONSTRUCTIONS"

                ],

            ],
        ]);


        switch ($value) {
            case "7":
                $this->listVentilation = $ventilation7->toArray();
                break;
            case "10":
                $this->listVentilation = $ventilation10->toArray();
                break;
            case "14":
                $this->listVentilation = $ventilation14->toArray();
                break;
            case "20":
                $this->listVentilation = $ventilation20->toArray();
                break;
        }

    }




    public function updateData($i)
    {
        if (isset($this->fournisseurId[$i])) {

            $fournisseur = Fournisseur::where('id', $this->fournisseurId[$i])->first();
            $this->compteComptableFournisseur[$i] = $fournisseur->code_comptable;
        }

        if (isset($this->compteComptableHT[$i])) {
            $compte = CompteComptable::where('id', $this->compteComptableHT[$i])->first();
            $this->libelleCompteComptableHT[$i] = $compte->name;
        }

        if (!isset($this->tauxTva[$i])) {
            $this->tauxTva[$i] = 0;
            $this->totalTvas[$i] = 0;

        }

        $this->totalHt = 0;
        for ($i = 0; $i < count($this->montant); $i++) {

            $this->montantTtc[$i] = $this->montant[$i] * (1+($this->tauxTva[$i]/100));
            $this->montantTva[$i] = $this->montantTtc[$i] - $this->montant[$i];
            $this->totalHt += $this->montant[$i];

        }

        $this->totalHts = [];
        $this->totalTtcs = [];
        $this->totalTvas = [];

        for ($i = 0; $i < count($this->tauxTva); $i++) {
            if (array_key_exists(strval($this->tauxTva[$i]), $this->totalTvas)) {
                $this->totalTvas[strval($this->tauxTva[$i])] += $this->montantTva[$i];

                $this->totalHts[strval($this->tauxTva[$i])] = $this->totalHts[strval($this->tauxTva[$i])] + $this->montant[$i];
                $this->totalTtcs[strval($this->tauxTva[$i])] = $this->totalHts[strval($this->tauxTva[$i])] + $this->totalTvas[strval($this->tauxTva[$i])];
            } else {
                $this->totalTvas[strval($this->tauxTva[$i])] = isset($this->montantTva[$i]) ? $this->montantTva[$i] : 0;

                $this->totalHts[strval($this->tauxTva[$i])] =  isset($this->montant[$i]) ? $this->montant[$i] : 0;
                $this->totalTtcs[strval($this->tauxTva[$i])] = $this->totalHts[strval($this->tauxTva[$i])] + $this->totalTvas[strval($this->tauxTva[$i])];
            }
        }

        $this->totalTva = 0;
        for ($i = 0; $i < count($this->montantTva); $i++) {
            $this->totalTva += $this->montantTva[$i];
        }

        $this->totalTtc = 0;
        for ($i = 0; $i < count($this->montantTtc); $i++) {
            $this->totalTtc += $this->montantTtc[$i];
        }
    }

    public function add()
    {
        if ($this->i < count($this->montant)) {
            $this->i++;
            array_push($this->inputs, $this->i);
        }
    }

    public function remove($i)
    {
        array_splice($this->inputs, $i - 1, 1);
        $this->i--;
        array_splice($this->libelle, $i, 1);
        array_splice($this->montant, $i, 1);
        $this->updateData(0);
    }

    public function saveChargeDirect()
    {

        //$this->validate();

        DB::transaction(function () {
            $item = new ChargeIndirecte();
            $item->ref = $this->refCharge;
            $item->montant_total = $this->totalHt;
            $item->site_id = $this->siteId;
            $item->bon_reception_ref = $this->bcRef;
            $item->user_id = Auth::user()->id;
            $item->save();

            foreach ($this->numFacture as $key => $value) {

                ChargeIndirecteLine::create(['charge_ref' => $this->refCharge, 'fournisseur_id' => $this->fournisseurId[$key], 'date' => $this->date[$key], 'num_facture' => $this->numFacture[$key], 'libelle' => $this->libelle[$key], 'montant_ht' => $this->montant[$key], 'montant_tva' => $this->montantTva[$key], 'montant_ttc' => $this->montantTtc[$key], 'compte_comptable_ht_id' => $this->compteComptableHT[$key], 'compte_comptable_Tva_id' => $this->compteComptableTVA[$key],'ventilation' => $this->ventilation[$key]]);
            }

            /* $qteTotale = BonAchatLine::where('bon_achat_ref', $this->bcRef)->sum('qte');
            $coutRevientUnitaire =  ($this->totalHt / $qteTotale);

            $bonReceptionLignes = BonAchatLine::where('bon_achat_ref', $this->bcRef)->get();

            foreach($bonReceptionLignes as $ligne){
                Produit::where('article_id', $ligne->article_id)
                ->where('num_lot', $ligne->num_lot)
                ->update(['prix_plus_charges_directes' => $ligne->prix_achat + $coutRevientUnitaire]);

            } */

        });

        session()->flash('message', "Le charge indirecte $this->refCharge a été crée.");

        /* $this->reset(['refCharge', 'siteId','bcRef','date','fournisseurId','siteId','compteComptableFournisseur','numFacture','libelle','montant','tauxTva','ventilation','montantTva','montantTtc','compteComptableHT','libelleCompteComptableHT','compteComptableTVA','totalHt','totalTva','totalTtc','totalHt','totalTvas','totalHts','totalTtcs']); */

        $this->emit('saved');
    }

    public function render()
    {

        $list_sites = Site::all()->sortBy('code');
        $comptes_comptable_fournisseur = CompteComptable::where('code', 'LIKE', '4411%')->get();
        $comptes_comptable_HT = CompteComptable::where('code', 'like', '611%')->whereRaw('LENGTH(code) = 4')->get();
        $comptes_comptable_TVA = CompteComptable::where('code', 'LIKE', '345%')->whereRaw('LENGTH(code) = 4')->get();
        $list_fournisseurs = Fournisseur::all()->sortBy('name');

        return view('livewire.compta-finance.create-charge-indirecte', ['comptes_comptable_fournisseur'=> $comptes_comptable_fournisseur,'list_sites'=>$list_sites,'list_fournisseurs'=>$list_fournisseurs,'comptes_comptable_HT'=> $comptes_comptable_HT,'comptes_comptable_TVA'=> $comptes_comptable_TVA]);
    }

}
