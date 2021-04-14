<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Lot;
use App\Models\Produit;
use App\Models\Stock;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Session;

class Boutique extends Component
{
    public $cat_id;
    public $title;
    public $produits;
    public $ville;

    protected $listeners = ['villeRefrish' => 'test'];

    public function mount(){
        $this->cat_id = request()->cat;
        $this->ville = Session::get('villeLivraison');
        
        $this->produits = Stock::select('produit_id','categorie_id')->groupBy(['produit_id','categorie_id'])->where('categorie_id',  $this->cat_id)->whereHas('depot', function (Builder $query) {
            $query->where('ville_id', $this->ville);
        })->get();
    }

    public function test(){
        redirect('boutique?cat='.$this->cat_id);
    }
    
    public function render(){
        return view('livewire.frontend.boutique')->layout('layouts.frontend.app');
    }
}
