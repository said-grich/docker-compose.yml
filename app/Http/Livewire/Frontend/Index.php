<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Lot;
use App\Models\Produit;
use App\Models\StockKgPc;
use App\Models\StockPoidsPc;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $items = StockPoidsPc::select('lot_num', DB::raw('MIN(prix_n) as prix'))->groupBy('lot_num')->get();     

        foreach ($items as &$item) {
            $item['photo_url'] = Storage::url($item->lot->produit->photo_principale);
        }

        return view('livewire.frontend.index',['items' => $items])->layout('layouts.frontend.app');
    }
}
