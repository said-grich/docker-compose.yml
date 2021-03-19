<?php

namespace App\Http\Livewire\Vente;

use App\Models\BonLivraison;
use App\Models\BonLivraisonLine;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ListeBonLivraison extends Component
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

    public function deleteBonLivraison($ref, $id)
    {
        $this->ida=$id;
        $this->ref=$ref;

        DB::transaction(function (){


            BonLivraison::where('id', $this->ida)->delete();
            BonLivraisonLine::where('bon_livraison_ref', $this->ref)->delete();


        });
    }

    public function saved()
    {
        $this->render();
    }

    public function render()
    {
        $list = BonLivraison::search($this->search)
        ->where('ref','ilike','%'.$this->search.'%')
        ->orderBy($this->sortBy, $this->sortDirection)
        ->paginate($this->perPage);
        //dd($list);
        return view('livewire.vente.liste-bon-livraison', [ 'list' => $list ]);
    }
}
