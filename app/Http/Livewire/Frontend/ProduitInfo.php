<?php

namespace App\Http\Livewire\Frontend;

use App\Facades\Cart;
use App\Models\Lot;
use App\Models\Produit;
use App\Models\ProduitPhoto;
use App\Models\Stock;
use App\Models\Tranche;
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
    
    public function mount(){
        $this->produit_id = request()->produit;
        $this->produit = Produit::select()->where('id', $this->produit_id)->get();
        $this->produit_photos = ProduitPhoto::select()->where('produit_id', $this->produit_id)->get();

        $this->items = Stock::select()->where('produit_id', $this->produit_id)->get();
        // if($this->produit[0]->mode_vente_id === 1){
        //     $this->items = Stock::select()->where('produit_id', $this->produit_id)->get();
        // }
        // else if($this->produit[0]->mode_vente_id === 2){
        //     $this->items = Stock::select()->where('produit_id', $this->produit_id)->get();
        // }

        $collection = collect();
        foreach ($this->items as $item){
            $collection->push($item);
        }
        $this->stock = $collection->groupBy('tranche_id');

        foreach ($this->stock as $tranche_uid => $tranche){
            $this->tranches[$tranche_uid] = ['nom' => Tranche::where('uid', $tranche_uid)->first()->nom, 'prix' => $tranche[0]->prix_n, "qte" => count($tranche)];
        }
    }

    public function increment($tranche_id){
        $te = Stock::select()->where('produit_id', $this->produit_id)->where('tranche_id', $tranche_id)->get();
        // dd(count(Session::get($this->produit_id.'-'.$tranche_id)));
        if(Session::has($this->produit_id.'-'.$tranche_id) && count(Session::get($this->produit_id.'-'.$tranche_id)) < count($te)){
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
        $array = [];
        if(Session::has($this->produit_id.'-'.$tranche_id)){
            foreach(Session::get($this->produit_id.'-'.$tranche_id) as $item){
                array_push($array, $item['id']);
            }
        }
        $this->tranches_stock = Stock::select()->where('produit_id', $this->produit_id)->where('tranche_id', $tranche_id)->whereNotIn('id', $array)->get();
        // if($this->produit[0]->mode_vente_id === 1){
        //     $this->tranches_stock = Stock::select()->where('produit_id', $this->produit_id)->where('tranche_id', $tranche_id)->limit($value)->get();
        // }
        // else if($this->produit[0]->mode_vente_id === 2){
        //     $this->tranches_stock = Stock::select()->where('produit_id', $this->produit_id)->where('tranche_id', $tranche_id)->limit($value)->get();
        // }

        // if(Session::has($this->produit_id.'-'.$tranche_id)){
        //     Session::pull($this->produit_id.'-'.$tranche_id);
        // }elseif($value <= 0){
        //     Session::pull($this->produit_id.'-'.$tranche_id);
        // }

        // dd($this->tranches_stock);

        // foreach($this->tranches_stock as $item){
        if(count($this->tranches_stock) > 0){
            Session::push($this->produit_id.'-'.$tranche_id, ["id" => $this->tranches_stock->random()->id]);
        }
        // }
    }

    public function deletePcs($tranche_id,$pcs_id){
        $session_name = $this->produit_id.'-'.$tranche_id.'.'.$pcs_id;
        Session::forget($session_name);
    }

    public function addToCart($productId){
        $productId = explode(",", $productId);
        array_pop($productId);

        foreach($productId as $pcsId){
            $pcsId = (int)$pcsId;
            Cart::add(Stock::where('id', $pcsId)->first());
            $this->emit('productAdded');
        }
    }

    public function render(){
        return view('livewire.frontend.produit')->layout('layouts.frontend.app');
    }
}
