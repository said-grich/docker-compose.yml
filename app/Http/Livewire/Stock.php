<?php

namespace App\Http\Livewire;

use App\Models\BonReception;
use App\Models\BonReceptionLigne;
use App\Models\Depot;
use App\Models\Fournisseur;
use App\Models\Lot;
use App\Models\LotTranche;
use App\Models\ModeVente;
use App\Models\Produit;
use App\Models\ProduitTranche;
use App\Models\Qualite;
use App\Models\TranchesKgPc;
use App\Models\TranchesPoidsPc;
use App\Models\Unite;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Stock extends Component
{
    //public $lot_num;
    public $date_capture;
    public $date_entree;
    public $date_preemption;
    public $fournisseur;
    /* public $pas;
    public $qualite;
    public $produit; */
    public $active = false;

    public $lot_id;
    public $tranches = [];
    public $depot;
    /* public $prix_achat;
    public $qte; */
    public $cr;
    public $prix_vente_normal;
    public $prix_vente_fidele;
    public $prix_vente_business;
    public $active_stock =  false;

    public $list_fournisseurs = [];
    public $list_qualites = [];
    public $list_produits = [];
    public $list_lots = [];
    public $list_tranches = [];
    public $list_depots = [];
    public $list_unites = [];

    public $ref_br;
    public $date;
    public $pas = [];
    public $qualite = [];
    public $produit = [];
    public $prix_achat = [];
    public $qte = [];
    public $nbr_pc = [];
    public $lot_num = [];
    public $unite = [];
    public $mode_vente_produit = [];
    public $bon_recption_details;


    public $inputs = [];
    public $i = 0;

    public function add()
    {
        $this->i++;
        array_push($this->inputs, $this->i);
    }

    public function remove($i)
    {
        array_splice($this->inputs, $i - 1, 1);
        $this->i--;
    }


    public function updated(){
        $this->dispatchBrowserEvent('contentChanged');
    }

    public function updatedFournisseur($value){
        $uniqueNumLot =  random_int(100, 999);
        $fournisseur = Fournisseur::where('id',$value)->first(['nom']);
        $fournisseur_nom = substr($fournisseur->nom, 0, 3);
        $this->lot_num = $fournisseur_nom.$uniqueNumLot;


    }

    public function renderData()
    {
        $this->list_fournisseurs = Fournisseur::all()->sortBy('nom');
        $this->list_qualites = Qualite::all()->sortBy('nom');
        $this->list_produits = Produit::all()->sortBy('nom');
        $this->list_lots = Lot::all()->sortBy('not_num');
        $this->list_depots = Depot::all()->sortBy('nom');
        $this->list_unites = Unite::whereIn('nom', array("Kg", "Pièce"))->get();


    }

    public function updatedProduit($value,$index){

        $produit = Produit::where('id',$value)->first();
        $produit_tranches = ProduitTranche::where('produit_id', $value)->get();
        $this->mode_vente_produit[$index] = $produit->modeVente->id;
        $mode_vente = $produit->modeVente->id;

        foreach($produit_tranches as $key=>$value){
            $this->list_tranches[$index][$key] = $this->mode_vente_produit[$index] == 1 ? $this->list_tranches[$index][$key] = TranchesPoidsPc::where('uid',$value->tranche_id)->get()->toArray() : TranchesKgPc::where('uid',$value->tranche_id)->get()->toArray();
        }

        //dd($this->list_tranches);

    }

    public function updatedLotId($value){

        $lot = Lot::where('lot_num',$value)->first();
        $produit_tranches = ProduitTranche::where('produit_id', $lot->produit->id)->get();
        $mode_vente = $lot->produit->mode_vente_id;

        foreach($produit_tranches as $key=>$value){
            $this->list_tranches[$key] = $mode_vente == 1 ? TranchesPoidsPc::where('uid',$value->tranche_id)->get()->toArray() : TranchesKgPc::where('uid',$value->tranche_id)->get()->toArray();
        }

    }

    protected $messages = [
        'lot_num.required' => "Le numéro de lot ne peut pas être vide.",
        'pas.required' => "Le pas ne peut pas être vide.",
    ];

    public function createLots(){
        $this->validate([
            'ref_br' => 'required',
            'date_entree' => 'required',
            //'nbr_pc' => 'exclude_if:mode_vente_produit,1|required',
        ]);

        DB::transaction(function () {

            $item = new BonReception();
            $item->ref = $this->ref_br;
            $item->date = $this->date_entree;
            $item->depot_id = $this->depot;
            $item->fournisseur_id = $this->fournisseur;
            $item->save();

            // if (array_key_exists('premier', $search_array)) {
            //     echo "L'élément 'premier' existe dans le tableau";
            // }
            $produits_prix = [];
            //dump($this->produit);
            // dump($this->produit);
            $produit_qte = [];
            $qte = 0;
            // foreach ($this->produit as $key => $value) {
            //     $produit_qte[$value][$this->prix_achat[$key]]= $this->qte[$key];
            //     if (array_key_exists($value, $produit_qte) && in_array($value[$this->prix_achat[$key]], $produit_qte)) {
            //         dump($key);
            // //         dump("Key exists!",$this->produit[$i]) ;
            // //         $qte +=  $this->qte[$i];
            // //         $produit_qte[$this->produit[$i]] = $this->qte[$i];
            // //         //dump("value exists!", $this->prix_achat[$i]);
            // //         //dump("qte",$i);
            // //     }
            // }}

            // for ($i = 0; $i < count($this->produit); $i++) {
            //     $produits_prix[$this->produit[$i]][$this->prix_achat[$i]] = $this->qte[$i];
            // }
            // dd($produits_prix);
            // for ($i=0; $i < count($this->produit) ; $i++) {
            //     //$produit_qte[strval($this->produit[$i])] = $this->qte[$i];

            //    // dump($i,$this->qte[$i]);
            //     if (array_key_exists($this->produit[$i], $produits_prix) && in_array($this->prix_achat[$i], $produits_prix)) {
            //         dump("Key exists!",$this->produit[$i]) ;
            //         $produits_prix[$this->produit[$i]] = $this->qte[$i];
            //         //dump("value exists!", $this->prix_achat[$i]);
            //         //dump("qte",$i);
            //     } else {
            //         dump("DIDNT FIND IT IN!",$i);

            //         $produits_prix[strval($this->produit[$i])] = $this->prix_achat[$i];
            //         //$produit_qte[$this->produit[$i]] += $this->qte[$i];

            //     }

            //  }

            // $distinct = array();
            // $distinct2 = array();
            // foreach ($this->produit as $index => $product) {
            //     dump($index);

            //     dump($distinct[$product]);
            //     if (!isset($distinct[$product]) && !isset($distinct[$product][$index])) {
            //         $distinct[$product][$index] = $this->prix_achat[$index];
            //         //$distinct2[$product][] = $this->prix_achat[$index];


            //     } else {
            //         $distinct[$product][] += $this->prix_achat[$index];
            //         //$distinct2[$product][] += $this->prix_achat[$index];

            //     }
            // }


            // foreach ($this->produit as $key => $value) {

            //         $test[strval($value)] = $this->prix_achat[$key];

            // }
            // dd($produits_prix, $produit_qte, $qte);









            foreach ($this->produit as $key => $value) {
                $item = new Lot();
                $item->produit_id = $this->produit[$key];
                $item->lot_num = $this->lot_num[$key];
                $item->date_entree = $this->date_entree;
                $item->pas = $this->pas[$key];
                $item->fournisseur_id = $this->fournisseur;
                $item->qualite_id = $this->qualite[$key];
                $item->active = true;
                $item->save();
                //dd($this->tranches);


                if (BonReceptionLigne::where('bon_reception_ref', '=', $this->ref_br)
                ->where('produit_id', '=', $this->produit[$key])
                ->where('prix_achat', '=', $this->prix_achat[$key])
                ->exists()) {
                    $previous_row_qte = BonReceptionLigne::where('bon_reception_ref', '=', $this->ref_br)
                    ->where('produit_id', '=', $this->produit[$key])
                    ->where('prix_achat', '=', $this->prix_achat[$key])
                    ->first(['qte'])->qte;
                    BonReceptionLigne::where('bon_reception_ref', '=', $this->ref_br)
                    ->where('produit_id', $this->produit[$key])
                    ->where('prix_achat', $this->prix_achat[$key])
                    ->update(['qte' => $previous_row_qte + intval($this->qte[$key]) ]);
                }else{
                    $item = new BonReceptionLigne();
                    $item->bon_reception_ref = $this->ref_br;
                    $item->produit_id = $this->produit[$key];
                    $item->qte = $this->qte[$key];
                    $item->prix_achat = $this->prix_achat[$key];
                    $item->montant = $this->qte[$key] * $this->prix_achat[$key];
                    $item->save();
                }

                foreach ($this->tranches[$key] as $ke => $value) {
                        LotTranche::create([
                            'lot_num' => $this->lot_num[$key],
                            'tranche_id' => $value,
                        ]);
                }

                //$this->bon_recption_details = $item;

            }

        });
    }

    public function createStock(){
        dd($this->tranches,$this->date_capture);

    }


    public function createLot(){

        //$this->validate();

        $this->validate([
            'pas' => 'required',
            'fournisseur' => 'required',
            'produit' => 'required',
            'lot_num' => 'required',
            'date_capture' => 'required',
            'date_entree' => 'required',
            'date_preemption' => 'required',
            'qualite' => 'required',
        ]);

        DB::transaction(function () {

            $item = new Lot();
            $item->lot_num = $this->lot_num;
            $item->date_capture = $this->date_capture;
            $item->date_entree = $this->date_entree;
            $item->date_preemption = $this->date_preemption;
            $item->pas = $this->pas;
            $item->fournisseur_id = $this->fournisseur;
            $item->qualite_id = $this->qualite;
            $item->produit_id = $this->produit;
            $item->active = $this->active;

            $item->save();

            foreach ($this->tranches as $key => $value) {
                LotTranche::create([
                    'lot_num' => $this->lot_num,
                    'tranche_id' =>$this->tranches[$key],
                ]);
            }
        });

        session()->flash('message', 'Lot numéro "' . $this->lot_num . '" a été crée');
        $this->reset(['lot_num','date_capture','date_entree','date_preemption','pas','fournisseur','qualite','produit','active']);

        $this->emit('saved');
    }

    public function render()
    {
        $this->renderData();
        return view('livewire.stock');
    }
}
