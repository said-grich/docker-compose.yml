<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Lot;
use App\Models\Produit;
use App\Models\StockKgPc;
use App\Models\StockPoidsPc;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Boutique extends Component
{
    public function render()
    {
        // $items = StockPoidsPc::select('stock_poids_pcs.*')->get()->groupBy(['produit_id','categorie_id']);
        // $items = StockKgPc::select('lot_num', DB::raw('MIN(prix_n) as prix'))->groupBy('lot_num')->get();
        $items = StockPoidsPc::select('produit_id','categorie_id')->groupBy(['produit_id','categorie_id'])->get();

        return view('livewire.frontend.boutique',['items' => $items])->layout('layouts.frontend.app');
    }
}
