<?php

namespace App\Http\Livewire\Vente;

use App\Models\Produit;
use App\Models\Stock;
use Livewire\Component;

class ModificationPrix extends Component
{
    public $produit =  [];

    public $sortBy = 'produit_id';
    public $sortDirection = 'asc';
    public $perPage = 5;
    public $search = '';
    protected $listeners = ['saved'];

    public function render()
    {

        $items = Stock::query()
            ->where('produit_id', 'ilike', '%' . $this->search . '%')
            ->orderBy($this->sortBy, $this->sortDirection)
            ->get()
            ->groupBy(['produit_id']);

        foreach ($items as $produit => $details) {
           $this->produit[$produit] = Produit::where('id',$produit)->first()->nom;
        }


        return view('livewire.vente.modification-prix', [
            'items' => $items,
        ]);
    }

    // public function render()
    // {
    //     $items = Stock::get()->groupBy(['produit_id']);
    //     foreach ($items as $produit => $details) {
    //        $this->produit[$produit] = Produit::where('id',$produit)->first()->nom;
    //     }
    //     //dd( $this->produit,$items);
    //     return view('livewire.vente.modification-prix',compact($items));
    // }
}
