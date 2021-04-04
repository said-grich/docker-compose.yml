<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Lot;
use App\Models\Produit;
use App\Models\ProduitPhoto;
use App\Models\StockKgPc;
use App\Models\StockPoidsPc;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class ProduitInfo extends Component
{
    public $produit_id;
    public $produit_photos;
    public $items;
    public $prix_total;
    public $poids_total;
    public $qte = [];
    public $prix = [];
    public $count_rows = [];
    
    public function mount(){
        $this->produit_id = request()->produit;
        $this->items = StockPoidsPc::select()->where('produit_id', $this->produit_id)->get();
        $this->produit_photos = ProduitPhoto::select()->where('produit_id', $this->produit_id)->get();
    } 
    
    public function updatedQte($value,$index){
        $this->qte[$index] = $value;
        $this->count_rows[$index] = $value;

        foreach($this->items as $key => $item){
            if(!empty($this->qte[$key])){
                $this->prix[$key] = $item->poids*$item->prix_n*$this->qte[$key]; 
            }else{
                $this->prix[$key] = 0;
            }
        }
        $this->prix_total = array_sum($this->prix);
    }

    public function render()
    {
        return view('livewire.frontend.produit')->layout('layouts.frontend.app');
    }
}
