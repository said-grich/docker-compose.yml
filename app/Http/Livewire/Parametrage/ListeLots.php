<?php

namespace App\Http\Livewire\Parametrage;

use App\Models\Livreur;
use App\Models\Lot;
use App\Models\Fournisseur;
use App\Models\Produit;
use App\Models\Depot;
use App\Models\Qualite;

use Livewire\Component;
use Livewire\WithPagination;

class ListeLots extends Component
{
    use WithPagination;

    public $lot_id;
    public $lot_num;
    public $article;
    public $mode_vente;
    public $phone;
    public $type;
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


    public $sortBy = 'lot_num';
    public $sortDirection = 'asc';
    public $perPage = 5;
    public $search = '';
    protected $listeners = ['saved'];

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

        $item = Lot::where('id',$id)->firstOrFail();
/*         dd($item->produit->modeVente->id);
 */        $this->lot_id =$item->id;
        $this->lot_num =$item->lot_num;
        $this->article =$item->produit->nom;
        $this->mode_vente =$item->produit->modeVente->nom;

        /* $this->date_capture =$item->date_capture;
        $this->date_entree =$item->date_entree;
        $this->date_preemption =$item->date_preemption;
        $this->pas =$item->pas;
        $this->active =$item->active; */
    }

    public function edit($id){

        $item = Livreur::where('id',$id)->firstOrFail();
        $this->showNbrPiece = true;
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
