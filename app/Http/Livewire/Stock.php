<?php

namespace App\Http\Livewire;

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
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Stock extends Component
{
    public $lot_num;
    public $date_capture;
    public $date_entree;
    public $date_preemption;
    public $pas;
    public $fournisseur;
    public $qualite;
    public $produit;
    public $active = false;

    public $lot_id;
    public $tranches = [];
    public $depot;
    public $prix_achat;
    public $qte;
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


    public function updated(){
        $this->dispatchBrowserEvent('contentChanged');
    }

    public function renderData()
    {
        $this->list_fournisseurs = Fournisseur::all()->sortBy('nom');
        $this->list_qualites = Qualite::all()->sortBy('nom');
        $this->list_produits = Produit::all()->sortBy('nom');
        $this->list_lots = Lot::all()->sortBy('not_num');
        $this->list_depots = Depot::all()->sortBy('nom');

    }

    public function updatedProduit($value){

        $produit = Produit::where('id',$value)->first();
        $produit_tranches = ProduitTranche::where('produit_id', $value)->get();

        $mode_vente = $produit->modeVente->id;

        foreach($produit_tranches as $key=>$value){
            $this->list_tranches[$key] = $mode_vente == 1 ? TranchesPoidsPc::where('uid',$value->tranche_id)->get()->toArray() : TranchesKgPc::where('uid',$value->tranche_id)->get()->toArray();
        }

    }

    public function updatedLotId($value){

        $lot = Lot::where('lot_num',$value)->first();
        $produit_tranches = ProduitTranche::where('produit_id', $lot->produit->id)->get();
        $mode_vente = $lot->produit->mode_vente_id;

        foreach($produit_tranches as $key=>$value){
            $this->list_tranches[$key] = $mode_vente == 1 ? TranchesPoidsPc::where('uid',$value->tranche_id)->get()->toArray() : TranchesKgPc::where('uid',$value->tranche_id)->get()->toArray();
        }

    }

    public function createStock(){
        dd($this->tranches,$this->date_capture);

    }

    protected $messages = [
        'lot_num.required' => "Le numéro de lot ne peut pas être vide.",
        'pas.required' => "Le pas ne peut pas être vide.",
    ];

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
