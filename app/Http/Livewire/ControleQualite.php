<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\BonReception;
use App\Models\Lot;
use Livewire\WithPagination;

class ControleQualite extends Component
{

    use WithPagination;
    public $tranche_id = [];

    public $lot_id;
    public $lot_num;
    public $article;
    public $produit_id = [];
    public $mode_vente_id;
    public $mode_vente;
    public $nombre_piece;
    public $nom_tranche = [];
    public $code = [];
    public $poids = [];
    public $isActive = false;

    public $list_fournisseurs = [];
    public $list_qualites = [];
    public $list_produits = [];
    public $liste_poids_pc = [];
    public $liste_kg_pc = [];
    public $list_tranches = [];
    public $list_depots = [];
    public $show_details = false;

    public $countInputs;
    public $i = 0;

    public $qte = [];
    public $prix_achat = [];
    public $montant = [];

    public $date_entree;
    public $fournisseur;
    public $depot;
    public $qualite;
    public $lot_lignes = [];



    public $sortBy = 'lot_num';
    public $sortDirection = 'asc';
    public $perPage = 5;
    public $search = '';
    protected $listeners = ['saved'];

    public function updatedNombrePiece($value)
    {

        $this->countInputs = $value;
    }


    public function render()
    {
         $items = Lot::query()
             ->where('lot_num', 'ilike', '%' . $this->search . '%')
             ->orderBy($this->sortBy, $this->sortDirection)
             ->paginate($this->perPage);

        /* $items = Lot::where('lot_num', 'ilike', '%' . $this->search . '%')
            ->orderBy($this->sortBy, $this->sortDirection)->paginate($this->perPage)->groupBy(function ($data) {
            return $data->lot_num;
        }); */



        return view('livewire.controle-qualite', compact(['items']));
    }

    public function sortBy($field){
        if ($this->sortDirection == 'asc') {
            $this->sortDirection = 'desc';
        } else {
            $this->sortDirection = 'asc';
        }

        return $this->sortBy = $field;
    }

    public function show($id){

        $lot = Lot::where('lot_num', $id)->first();
        $this->lot_lignes = count($lot->stockPoidPC) > 0 ? $lot->stockPoidPC : $lot->stockKgPC;
        $this->show_details = isset($this->lot_lignes->first()->code) ? true : false;
        $this->lot_num = $id;
    }

    public function edit($id){

        $item = Lot::where('lot_num', $id)->firstOrFail();
        dd($item);
        $this->lot_num = $id;
        $this->code = $item->nom;
        $this->date_entree = $item->date_entree;
        $this->active = $item->active;
        $this->qualite = $item->qualite_id;
        $this->produit = $item->produit_id;
    }

    public function deleteLivreur($id)
    {
        $this->render();
        $livreur = Lot::findOrFail($id);
        $livreur->delete();
    }

    public function saved()
    {
        return $this->render();
    }


}
