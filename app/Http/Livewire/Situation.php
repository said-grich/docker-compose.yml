<?php

namespace App\Http\Livewire;

use App\Models\BonAchat;
use App\Models\BonAchatLine;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Situation extends Component
{
    use WithPagination;

    public $ref;
    public $ida;
    public $perPage=10;
    public $sortField ="date";
    public $sortAsc = true;
    public $search='';
    public $articles=[];
    public $libelle=[];
    public $famille=[];
    public $qte=[];
    public $code=[];
    public $linenumber;
    public $date;
    public $dateBlFournisseur;
    public $depotId;
    public $siteId;
    public $fournisseurId;
    public $lines_count;
    public $articleId=[];
    public $prixAchat=[];
    public $montant=[];
    public $numLot;
    public $modeEdit = false;
    public $inputs = [];
    public $i = 0;

 public function mount()
    {
        $this->ida = request()->ida;

        $this->list = BonAchat::where('fournisseur_id', $this->ida)->get();
        //dd($list);
        //$this->lines_count = count($list);
        $this->ref= $this->list[0]->bon_achat_ref;
        $this->date= $this->list[0]->date;
        $this->dateBlFournisseur= $this->list[0]->date_bl_fournisseur;
        $this->siteId= $this->list[0]->site_id;
        $this->depotId= $this->list[0]->depot_id;
        $this->numLot= $this->list[0]->num_lot;
        $this->fournisseurId= $this->list[0]->fournisseur_id;


    }
    public function sortBy($field)
    {
        if($this->sortField === $field)
        {
            $this->sortAsc = ! $this->sortAsc;
        }

        else
        {
            $this->sortAsc=true;
        }

        $this->sortField = $field;
    }


    public function deleteBonCommande($ref, $id)
    {
        $this->ida=$id;
        $this->ref=$ref;

        DB::transaction(function (){

            BonAchat::where('id', $this->ida)->delete();
                BonAchatLine::where('bon_achat_ref', $this->ref)->delete();


        });
    }
    public function render()
    {


        return view('livewire.situation', [ 'list' => $this->list ]);
    }
}
