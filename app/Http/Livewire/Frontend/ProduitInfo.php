<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Lot;
use App\Models\Produit;
use App\Models\StockKgPc;
use App\Models\StockPoidsPc;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class ProduitInfo extends Component
{
    public $produit_id;
    public $qyt = [];
    public $key;

    public function upQyt($key)
    {
        $this->qyt[$key] = $this->qyt[$key];
        dd($key);
    }
    public function render()
    {
        $this->produit_id = request()->produit;
        $items = StockPoidsPc::select()->where('produit_id', $this->produit_id)->get();
        // dd($items);
        return view('livewire.frontend.produit',['items' => $items])->layout('layouts.frontend.app');
    }
}
