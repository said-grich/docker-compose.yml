<?php

namespace App\Http\Livewire\Frontend;

use App\Facades\Cart;
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
    public $tranches_stock;
    public $items;
    public $stock;
    public $prix_total;
    public $poids_total;
    public $tranche_items = [];
    public $tranches = [];
    public $qte = [];
    public $prix = [];
    public $count_rows = [];
    public $index;
    
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
        foreach ($this->items as $item){
            $collection->push($item);
        }
        $this->stock = $collection->groupBy('tranche_id');

        foreach ($this->stock as $tranche_uid => $tranche){
            $this->tranches[$tranche_uid] = ['nom' => isset(TranchesPoidsPc::where('uid', $tranche_uid)->first()->nom) ? TranchesPoidsPc::where('uid', $tranche_uid)->first()->nom : TranchesKgPc::where('uid', $tranche_uid)->first()->nom, 'prix' => $tranche[0]->prix_n, "qte" => count($tranche)];
        }
    } 
    
    public function updatedQte($value,$index){
        $this->index = $index;

        $this->count_rows[$index] = $value;
        
        if($this->produit[0]->mode_vente_id === 1){
            $this->tranches_stock = StockPoidsPc::select()->where('produit_id', $this->produit_id)->where('tranche_id', $index)->limit($value)->get();
        }
        else if($this->produit[0]->mode_vente_id === 2){
            $this->tranches_stock = StockKgPc::select()->where('produit_id', $this->produit_id)->where('tranche_id', $index)->limit($value)->get();
        }

        foreach ($this->tranches_stock as $item){
            array_push($this->tranche_items, $item);
        }

        

        //dd($this->test);
        // foreach($this->items as $key => $item){
        //     if(!empty($this->qte[$key])){
        //         $this->prix[$key] = $item->poids*$item->prix_n*$this->qte[$key]; 
        //     }else{
        //         $this->prix[$key] = 0;
        //     }
        // }
        // $this->prix_total = array_sum($this->prix);
    }

    public function addToCart(int $productId)
    {
        Cart::add(Produit::where('id', $productId)->first());
        $this->emit('productAdded');
    }

    public function clear()
    {
        Cart::clear();
        $this->emit('clearCart');
        $this->cart = Cart::get();
    }

    public function render(){
        return view('livewire.frontend.produit')->layout('layouts.frontend.app');
    }
}
