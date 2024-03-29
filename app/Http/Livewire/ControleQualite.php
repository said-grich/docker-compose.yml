<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\BonReception;
use App\Models\Lot;
use App\Models\Qualite;
use App\Models\Stock;
use App\Models\StockKgPc;
use App\Models\StockPoidsPc;
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
        // $l_stock_poids_pc = $br->stockPoidsPc;
        // $l_stock_kg_pc = $br->stockKgPc;

        // $collection = collect();
        // foreach ($l_stock_poids_pc as $poids_pc)
        //     $collection->push($poids_pc);
        // foreach ($l_stock_kg_pc as $kg_pc)
        //     $collection->push($kg_pc);
        $this->lot_lignes = collect($br->stock)->groupBy('lot_num');
        $this->lot_num = $id;
    }

    public function edit($id){

        $br = BonReception::where('ref', $id)->first();
        // $l_stock_poids_pc = $br->stockPoidsPc;
        // $l_stock_kg_pc = $br->stockKgPc;

        // $collection = collect();
        // foreach ($l_stock_poids_pc as $poids_pc)
        //     $collection->push($poids_pc);
        // foreach ($l_stock_kg_pc as $kg_pc)
        //     $collection->push($kg_pc);

        $this->lot_lignes = collect($br->stock)->groupBy('lot_num');

        foreach ($this->lot_lignes as $key => $value) {


            $this->statut[$key]= $value->first()->lot->active;

            foreach ($value as $k => $v) {

                $this->qualite[$key][$k] = isset($v->qualite_id) ? $v->qualite_id :  $v->lot->qualite_id ;
                $this->code[$k] = isset($value[$k]->code) ? $value[$k]->code : '' ;
            }

            array_push($this->lots,$key);
        }
        $this->lot_num = $id;
    }

    public function editLot(){
        $code_piece =[];

        foreach ($this->lots as $key => $value) {
            Lot::where('lot_num', $value)
            ->update(['active' => $this->statut[$value]]);
        }
        foreach ($this->lot_lignes as $key => $value) {
            foreach ($value as $k => $v) {
               $code_piece[$key][] = isset($v['code']) ? $v['code'] : null;
            }

        }
        foreach ($code_piece as $lot => $code) {
            foreach ($code as $index => $c) {
                isset($c) ? Stock::where('lot_num', $lot)->where('code', $c)->update(['qualite_id' => $this->qualite[$lot][$index]]) :
                Lot::where('lot_num', $lot)->update(['qualite_id' => $this->qualite[$lot][$index]]);

            }


        }
        session()->flash('message', 'Modifacation est effectuée');
        return redirect()->to('/controle-qualite');
        //dd($code_piece, $this->qualite);


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
