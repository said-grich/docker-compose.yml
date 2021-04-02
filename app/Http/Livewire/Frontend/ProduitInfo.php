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
    public $prix_total;
    public $poids_total;
    public $qyt = [];
    public $key;

    public function upQyt($key)
    {
        $this->qyt[$key] = $this->qyt.[$key];
        dd($key);
    }
    public function render()
    {
        $this->produit_id = request()->produit;
        $items = StockPoidsPc::select()->where('produit_id', $this->produit_id)->get();
        $this->produit_photos = ProduitPhoto::select()->where('produit_id', $this->produit_id)->get();

        foreach($items as $item){
            $this->poids_total += $item->poids;
            $this->prix_total += $item->poids*$item->prix_n;
        }

        // dd($items);
        return view('livewire.frontend.produit',['items' => $items,'photos' => $this->produit_photos])->layout('layouts.frontend.app');
    }
}
