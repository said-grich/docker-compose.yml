<?php

namespace App\Http\Livewire\Parametrage;

use App\Models\BonReception;
use App\Models\Lot;
use App\Models\Fournisseur;
use App\Models\Produit;
use App\Models\Depot;
use App\Models\Qualite;
use App\Models\StockKgPc;
use App\Models\StockPoidsPc;
use Livewire\Component;
use Livewire\WithPagination;

class ListeLotsArchive extends Component
{
    use WithPagination;
    public $tranche_id = [];

    public $lot_id;
    public $lot_num;
    public $article;
    public $mode_vente_id;
    public $mode_vente;
    public $nombre_piece;
    public $nom_tranche = [];
   // public $tranche_id = [];
    public $code;
    public $poids;
    public $isActive = false;

    public $list_fournisseurs = [];
    public $list_qualites = [];
    public $list_produits = [];
    public $list_lots = [];
    public $list_tranches = [];
    public $list_depots = [];
    public $showNbrPiece = false;

    public $countInputs;
    public $i = 0;

    public $qte = [];
    public $cr = [];
    public $depot = [];
    public $prix_achat = [];
    public $prix_vente_normal = [];
    public $prix_vente_fidele = [];
    public $prix_vente_business = [];
    public $bon_reception = [];


    public $sortBy = 'ref';
    public $sortDirection = 'asc';
    public $perPage = 5;
    public $search = '';
    protected $listeners = ['saved'];

    public function updatedNombrePiece($value){

        $this->countInputs = $value;

    }

    public function renderData()
    {
        $this->list_fournisseurs = Fournisseur::all()->sortBy('nom');
        $this->list_qualites = Qualite::all()->sortBy('nom');
        $this->list_produits = Produit::all()->sortBy('nom');
        $this->list_lots = Lot::all()->sortBy('not_num');
        $this->list_depots = Depot::all()->sortBy('nom');

    }



    public function sortBy($field)
    {
        if ($this->sortDirection == 'asc') {
            $this->sortDirection = 'desc';
        } else {
            $this->sortDirection = 'asc';
        }

        return $this->sortBy = $field;
    }

    public function edit($id){

        $item = Lot::where('id',$id)->firstOrFail();
        $this->livreur_id =$item->id;
        $this->nom =$item->nom;
        $this->cin =$item->cin;
        $this->phone =$item->tel;
        $this->type =$item->type;
        $this->ville_id =$item->ville_id;
        $this->isActive =$item->active;
    }

    public function deleteLot($id)
    {
        $this->render();
        $livreur = Lot::findOrFail($id);
        $livreur->delete();
    }

    public function render()
    {
        $this->renderData();
        $lot_stock_kg_pc = array_unique(StockKgPc::where('cr','!=',0)->pluck('br_num')->toArray());
        $lot_stock_poids_pc = array_unique(StockPoidsPc::where('cr','!=',0)->pluck('br_num')->toArray());

        $archived_lots_ids = array_merge($lot_stock_kg_pc, $lot_stock_poids_pc);
        //dd($archived_lots_ids);
        $in_progress_lots_ids = array_unique(BonReception::whereNotIn('ref', $archived_lots_ids)->pluck('ref')->toArray());

        $items = BonReception::query()
        ->whereNotIn('ref', $in_progress_lots_ids)
        ->where('ref', 'ilike', '%' . $this->search . '%')
        ->orderBy($this->sortBy, $this->sortDirection)
        ->paginate($this->perPage);

        return view('livewire.parametrage.liste-lots-archive',[
            'items'=> $items,
        ]);
    }
    public function saved()
    {
        return $this->render();
    }


}
