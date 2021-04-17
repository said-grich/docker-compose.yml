<?php

namespace App\Http\Livewire\Vente;

use App\Models\Produit;
use App\Models\Stock;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ModificationPrix extends Component
{
    public $produit =  [];
    public $nom_produit;
    public $liste_produits =  [];
    public $prix_n = [];
    public $prix_f = [];
    public $prix_p = [];
    public $produit_id = [];

    public $sortBy = 'produit_id';
    public $sortDirection = 'asc';
    public $perPage = 5;
    public $search = '';
    protected $listeners = ['saved'];

    public function modificationPrix($produit){
        $this->nom_produit = Produit::where('id',$produit)->first()->nom;
        $this->liste_produits = Stock::where('produit_id',$produit)->get(['qte_restante','qte_vendue','prix_n','prix_p','prix_f','pas','categorie_id','tranche_id']);
        foreach ($this->liste_produits as $key => $value) {
            $this->produit_id[$key] = $value->id;
            $this->prix_n[$key] = $value->prix_n;
            $this->prix_f[$key] = $value->prix_f;
            $this->prix_p[$key] = $value->prix_p;
        }
        //dd($this->liste_produits);

    }

    public function edit(){

        DB::transaction( function () {
            
        });

    }

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
