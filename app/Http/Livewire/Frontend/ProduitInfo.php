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
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;
use Livewire\Component;
use Session;

class ProduitInfo extends Component
{
    public $produit_id;
    public $produit;
    public $produit_photos;
    public $tranches_stock;
    public $items;
    public $stock;
    public $tranches = [];
    public $prix_total;
    public $val;
    public $pcs;

    protected $listeners = [
        'test' => 'testadd',
    ];
    
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

    public function increment($tranche_id){
        if(Session::has($this->produit_id.'-'.$tranche_id)){
            $this->val = count(Session::get($this->produit_id.'-'.$tranche_id))+1;
        }else{
            $this->val = 1;
        }
        $this->updateQte($this->val,$tranche_id);
    }

    public function decrement($tranche_id){
        if(Session::has($this->produit_id.'-'.$tranche_id)){
            $this->val = count(Session::get($this->produit_id.'-'.$tranche_id))-1;
        }else{
            $this->val = 0;
        }
        $this->updateQte($this->val,$tranche_id);
    }
    
    public function updateQte($value,$tranche_id){
        //dump(Session::all());
        if($this->produit[0]->mode_vente_id === 1){
            $this->tranches_stock = StockPoidsPc::select()->where('produit_id', $this->produit_id)->where('tranche_id', $tranche_id)->limit($value)->get();
        }
        else if($this->produit[0]->mode_vente_id === 2){
            $this->tranches_stock = StockKgPc::select()->where('produit_id', $this->produit_id)->where('tranche_id', $tranche_id)->limit($value)->get();
        }

        if(Session::has($this->produit_id.'-'.$tranche_id)){
            Session::pull($this->produit_id.'-'.$tranche_id);
        }elseif($value <= 0){
            Session::pull($this->produit_id.'-'.$tranche_id);
        }

        foreach ($this->tranches_stock as $item){
            Session::push($item->produit_id.'-'.$item->tranche_id, $item);
        }
    }

    public function deletePcs($tranche_id,$pcs_id){
        $session_name = $this->produit_id.'-'.$tranche_id.'.'.$pcs_id;
        Session::forget($session_name);
    }

    public function addToCart($productId){
        // dd(Session::all());
        $productId = explode(",", $productId);
        array_pop($productId);

        foreach($productId as $pcsId){
            $pcsId = (int)$pcsId;
            Cart::add(StockPoidsPc::where('id', $pcsId)->first());
            $this->emit('productAdded');
        }
    }

    public function render(){
        return view('livewire.frontend.produit')->layout('layouts.frontend.app');
    }
}
