<?php

namespace App\Http\Livewire\Achat;

use App\Models\BonAchat;
use App\Models\BonAchatLine;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ListeBonAchat extends Component
{

    use WithPagination;

    public $ref;
    public $ida;
    public $perPage=10;
    public $sortField ="date";
    public $sortAsc = true;
    public $search='';
    public $etat;

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
        try{
            DB::transaction(function (){

                BonAchat::where('id', $this->ida)->delete();
                BonAchatLine::where('bon_achat_ref', $this->ref)->delete();


            });

            session()->flash('message', "Le bon réception $this->ref a été suprimée.");

            } catch(\Illuminate\Database\QueryException $ex){
        session()->flash('error-message', "Erreur: ".$ex->getMessage());
        }

    }

    public function render()
    {

       // $list = BonAchat::search($this->search)
            //->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ///->orderByDesc('created_at')
            //->paginate($this->perPage);
        $list = BonAchat::search($this->search)
            ->where('validation','like','%'.$this->etat.'%')
            ->orderByDesc('created_at')
            ->paginate($this->perPage);

        return view('livewire.achat.liste-bon-achat', [ 'list' => $list ]);
    }

}
