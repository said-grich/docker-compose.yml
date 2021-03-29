<?php

namespace App\Http\Livewire\Parametrage;

use App\Models\Livreur;
use App\Models\Lot;
use App\Models\Fournisseur;
use App\Models\Produit;
use App\Models\Depot;
use App\Models\LotTranche;
use App\Models\Qualite;
use App\Models\StockKgPc;
use App\Models\StockPoidsPc;
use App\Models\TranchesKgPc;
use App\Models\TranchesPoidsPc;
use Livewire\Component;
use Livewire\WithPagination;

class ListeStockKgPc  extends Component
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


    public $sortBy = 'lot_num';
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

    public function render()
    {
        $this->renderData();
        // $items = StockPoidsPc::first();
        // dd($items->lot->produit->nom);

        $items = StockKgPc::query()
        ->where('lot_num','ilike','%'.$this->search.'%')
        ->orderBy($this->sortBy, $this->sortDirection)
        ->paginate($this->perPage);

        return view('livewire.Parametrage.liste-stock-kg-pc',[
            'items'=> $items,
        ]);
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

        $item = Livreur::where('id',$id)->firstOrFail();
        $this->livreur_id =$item->id;
        $this->nom =$item->nom;
        $this->cin =$item->cin;
        $this->phone =$item->tel;
        $this->type =$item->type;
        $this->ville_id =$item->ville_id;
        $this->isActive =$item->active;
    }

    public function editLivreur(){

        Livreur::where('id', $this->livreur_id)
            ->update([
                'nom' => $this->nom,
                'cin' => $this->cin,
                'tel' => $this->phone,
                'type' => $this->type,
                'ville_id' => $this->ville_id,
                'active' => $this->isActive,
            ]);

        session()->flash('message', 'Livreur "'.$this->nom.'" à été modifié');
        //return redirect()->to('/livreurs');
    }

    public function deleteLivreur($id)
    {
        $this->render();
        $livreur = Livreur::findOrFail($id);
        $livreur->delete();
    }

    public function saved()
    {
        return $this->render();
    }


}
