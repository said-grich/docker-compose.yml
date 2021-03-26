<?php

namespace App\Http\Livewire\Parametrage;

use App\Models\Livreur;
use App\Models\Lot;
use App\Models\Fournisseur;
use App\Models\Produit;
use App\Models\Depot;
use App\Models\LotTranche;
use App\Models\Qualite;
use App\Models\TranchesKgPc;
use App\Models\TranchesPoidsPc;
use Livewire\Component;
use Livewire\WithPagination;

class ListeLots extends Component
{
    use WithPagination;

    public $lot_id;
    public $lot_num;
    public $article;
    public $mode_vente;
    public $nombre_piece;
    public $nom_tranche = [];
    public $ville_id;
    public $list_villes;
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

        $items = Lot::query()
        ->where('lot_num','ilike','%'.$this->search.'%')
        ->orderBy($this->sortBy, $this->sortDirection)
        ->paginate($this->perPage);

        return view('livewire.Parametrage.liste-lots',[
            'items'=> $items
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

    public function getStock($id){

        $lot = Lot::where('id',$id)->firstOrFail();
        $lot->produit->modeVente->id == 1 ? $this->showNbrPiece = true :  $this->showNbrPiece = false;

        $mode_vente  = $lot->produit->modeVente->id;

        $lot_tranches = LotTranche::where('lot_num', $lot->lot_num)->get();
        //dd($lot,count($lot_tranches),$lot_tranches);

        $lot->produit->modeVente->id != 1 ? $this->countInputs = count($lot_tranches) :  '';

        $this->lot_id =$lot->id;
        $this->lot_num =$lot->lot_num;
        $this->article =$lot->produit->nom;
        $this->mode_vente =$lot->produit->modeVente->nom;



        foreach ($lot_tranches as $key => $value) {
            $this->list_tranches[$key] = $mode_vente == 1 ? TranchesPoidsPc::where('uid',$value->tranche_id)->get() : TranchesKgPc::where('uid',$value->tranche_id)->get();
            $this->nom_tranche[$key] =$lot->produit->modeVente->nom;


        }
        /* foreach ($this->list_tranches as $key => $value) {
            dd($key,$value->get($key)->nom);
        } */


        /* $this->date_capture =$item->date_capture;
        $this->date_entree =$item->date_entree;
        $this->date_preemption =$item->date_preemption;
        $this->pas =$item->pas;
        $this->active =$item->active; */
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
