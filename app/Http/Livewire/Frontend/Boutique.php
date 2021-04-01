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
    
    public $produit_id;
    public $mode;
    // public function produit($produit_id, $mode)
    // {
    //     $mode == 1 ?  $this->produit = StockPoidsPc::where('id', $produit_id)->first() : $this->produit = StockKgPc::where('id', $produit_id)->first();
    //     //dd($this->produit->lot->produit->nom);
    // }
    public function render()
    {
        $items = StockPoidsPc::select('lot_num', DB::raw('MIN(prix_n) as prix'))->groupBy('lot_num')->get();
        // $items = StockPoidsPc::select('produit_id')->groupBy('produit_id')->get(); 

        foreach ($items as &$item) {
            $item['photo_url'] = Storage::url($item->lot->produit->photo_principale);
        }

        return view('livewire.frontend.boutique',['items' => $items])->layout('layouts.frontend.app');
    }
}
