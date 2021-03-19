<?php

namespace App\Http\Livewire\Vente;

use App\Models\BonCommandeVente;
use App\Models\BonCommandeVenteLine;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ListeBonCommandeVente extends Component
{
    use WithPagination;

    public $ref;
    public $ida;
    public $sortBy = 'ref';
    public $sortDirection = 'asc';
    public $perPage=5;
    // public $sortField ="created_at";
    // public $sortAsc = true;
    public $search='';

    protected $listeners = ['saved'];

    public function sortBy($field)
    {
        if ($this->sortDirection == 'asc') {
            $this->sortDirection = 'desc';
        } else {
            $this->sortDirection = 'asc';
        }

        return $this->sortBy = $field;
    }

    public function deleteBonCommandeVente($ref, $id)
    {
        $this->ida=$id;
        $this->ref=$ref;

        DB::transaction(function (){


            BonCommandeVente::where('id', $this->ida)->delete();
            BonCommandeVenteLine::where('bon_commande_ref', $this->ref)->delete();


        });
    }

    public function saved()
    {
        $this->render();
    }

    public function render()
    {
        $list = BonCommandeVente::query($this->search)
            ->where('ref','ilike','%'.$this->search.'%')
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);
            //dd($list);
        return view('livewire.vente.liste-bon-commande-vente', [ 'list' => $list ]);
    }
}
