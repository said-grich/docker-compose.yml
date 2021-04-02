<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\BonReception;
use App\Models\Lot;
use App\Models\Qualite;
use Livewire\WithPagination;

class ControleQualite extends Component
{

    use WithPagination;
    public $tranche_id = [];

    public $lot_id;
    public $lot_num;
    public $article;
    public $produit_id = [];
    public $active = false;

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
    public $qualite= [];
    public $lot_lignes = [];
    public $statut = [];
    public $lot = [];
    public $code = [];
    public $lots = [];


    public $sortBy = 'ref';
    public $sortDirection = 'asc';
    public $perPage = 5;
    public $search = '';
    protected $listeners = ['saved'];


    public function renderData()
    {
        $this->list_qualites = Qualite::all()->sortBy('nom');
    }


    public function render()
    {
        /* $items = Lot::query()
            ->where('lot_num', 'ilike', '%' . $this->search . '%')
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage); */
            $this->renderData();

            $items = BonReception::query()
            //->where('ref', $archived_lots_ids)
            ->where('ref','ilike','%'.$this->search.'%')
            ->where('valide',true)
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);

            /* return view('livewire.vente.designation-prix',[
                'items'=> $items,
          ]); */



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

        $br = BonReception::where('ref', $id)->first();
        $l_stock_poids_pc = $br->stockPoidsPc;
        $l_stock_kg_pc = $br->stockKgPc;

        $collection = collect();
        foreach ($l_stock_poids_pc as $poids_pc)
            $collection->push($poids_pc);
        foreach ($l_stock_kg_pc as $kg_pc)
            $collection->push($kg_pc);
            $this->lot_lignes = $collection->groupBy('lot_num');
        /* $this->show_details = isset($this->lot_lignes->first()->code) ? true : false;*/
        $this->lot_num = $id;
    }

    public function edit($id){

        $br = BonReception::where('ref', $id)->first();
        $l_stock_poids_pc = $br->stockPoidsPc;
        $l_stock_kg_pc = $br->stockKgPc;

        $collection = collect();
        foreach ($l_stock_poids_pc as $poids_pc)
            $collection->push($poids_pc);
        foreach ($l_stock_kg_pc as $kg_pc)
            $collection->push($kg_pc);

        $this->lot_lignes = $collection->groupBy('lot_num');

        foreach ($this->lot_lignes as $key => $value) {

            $this->statut[$key]= $value->first()->lot->active;

            foreach ($value as $k => $v) {
                $this->qualite[$k] = isset($v->qualite_id) ? $v->qualite_id :  $v->lot->qualite_id ;
                $this->code[$k] = $v->code ;
            }

            array_push($this->lots,$key);
        }
        $this->lot_num = $id;
    }

    public function editLot(){
        dd($this->code);

        foreach ($this->lots as $key => $value) {
            Lot::where('lot_num', $value)
            ->update(['active' => $this->statut[$value]]);
        }
        //

    }

    /* public function deleteLivreur($id)
    {
        $this->render();
        $livreur = Lot::findOrFail($id);
        $livreur->delete();
    } */

    public function saved()
    {
        return $this->render();
    }


}
