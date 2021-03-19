<?php

namespace App\Http\Livewire\Achat;

use App\Models\BonCommande;
use App\Models\BonCommandeLine;
use App\Models\DemandeAchat;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ListeBonCommande extends Component
{
    
    use WithPagination;

    public $ref;
    public $ida;
    public $refDemandeAchat;
    public $perPage=10;
    public $sortField ="date";
    public $sortAsc = true;
    public $search='';
    public $ShowDemandeAchat = false;

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

    public function show($id)
    {
        $record = DemandeAchat::findOrFail($id);

        $this->id = $id;
        //dd($record);
        $this->fname = $record->firstname;
        $this->lname = $record->lastname;
        $this->gender = $record->gender;
        $this->phone = $record->phone;

        $this->ShowDemandeAchat = true;
    }

    public function deleteBonCommande($ref, $id,$refDemandeAchat)
    {
        $this->ida=$id;
        $this->ref=$ref;
        $this->demande_achat_ref=$refDemandeAchat;

        DB::transaction(function (){

            DemandeAchat::where('ref', $this->demande_achat_ref)
                ->update(['validation' => 0]);

            BonCommande::where('id', $this->ida)->delete();
            BonCommandeLine::where('bon_commande_ref', $this->ref)->delete();


        });
    }
    protected $listeners = ['saved'];

    public function saved()
    {
        $this->render();
    }

    public function render()
    {

        $list = BonCommande::search($this->search)
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);

        return view('livewire.achat.liste-bon-commande', [ 'list' => $list ]);
    }

    /*public function render()
    {

        $list = BonCommande::all()->sortByDesc('created_at');
        return view('', [ 'list' => $list ]);
    }*/

}
