<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Lot;
use App\Models\Produit;
use App\Models\ProduitPhoto;
use App\Models\StockKgPc;
use App\Models\StockPoidsPc;
use App\Models\TranchesPoidsPc;
use App\Models\TranchesKgPc;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class ProduitInfo extends Component
{
    public $produit_id;
    public $produit;
    public $produit_photos;
    public $items;
    public $stock;
    public $prix_total;
    public $poids_total;
    public $tranches = [];
    public $qte = [];
    public $prix = [];
    public $count_rows = [];
    
    public function mount(){
        $this->produit_id = request()->produit;
        $this->produit = Produit::select()->where('id', $this->produit_id)->get();
        $this->produit_photos = ProduitPhoto::select()->where('produit_id', $this->produit_id)->get();

        if($this->produit[0]->mode_vente_id === 1){
            $this->items = StockPoidsPc::select()->where('produit_id', $this->produit_id)->get();
        }
        else if($this->produit[0]->mode_vente_id === 2){
            $this->items = StockKgPc::select()->where('produit_id', $this->produit_id)->get();
        }

        $collection = collect();
        foreach ($this->items as $item)
            $collection->push($item);
        $this->stock = $collection->groupBy('tranche_id');

        foreach ($this->stock as $tranche_uid => $tranche) {
            //dd($produits);
            $this->tranches[$tranche_uid] = ['nom' => isset(TranchesPoidsPc::where('uid', $tranche_uid)->first()->nom) ? TranchesPoidsPc::where('uid', $tranche_uid)->first()->nom : TranchesKgPc::where('uid', $tranche_uid)->first()->nom, 'prix' => $tranche[0]->prix_n, "qte" => count($tranche)];
        }
        //dd($this->tranches);
    } 
    
    public function updatedQte($value,$index){
        $this->qte[$index] = $value;
        $this->count_rows[$index] = $value;

        // foreach($this->items as $key => $item){
        //     if(!empty($this->qte[$key])){
        //         $this->prix[$key] = $item->poids*$item->prix_n*$this->qte[$key]; 
        //     }else{
        //         $this->prix[$key] = 0;
        //     }
        // }
        // $this->prix_total = array_sum($this->prix);
    }

    public function render()
    {
        return view('livewire.frontend.produit')->layout('layouts.frontend.app');
    }
}
