<?php

namespace App\Http\Livewire\Achat;

use App\Models\DemandeAchat;
use App\Models\DemandeAchatLine;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ListeDemandeAchat extends Component
{
    use WithPagination;

    public $ref;
    public $ida;
    public $perPage=10;
    public $sortField ="date";
    public $sortAsc = true;
    public $search='';
    public $demande_achat_ref;

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

    public function deleteDemandeAchat($ref, $id)
    {
        $this->ida=$id;
        $this->ref=$ref;
        try{
        DB::transaction(function (){

            DemandeAchat::where('ref', $this->ref)->delete();
            DemandeAchatLine::where('id', $this->ida)->delete();

          });
            session()->flash('message', 'Demande achat ref: '.$this->ref." a été suprimée");
        }catch(\Illuminate\Database\QueryException $ex){
            session()->flash('error-message', "Erreur: ".$ex->getMessage());
        }
    }
    protected $listeners = ['saved'];

    public function saved()
    {
        $this->render();
    }

    public function render()
    {

        $list = DemandeAchat::search($this->search)
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);

        return view('livewire.achat.liste-demande-achat', [ 'list' => $list ]);
    }

}
