<?php

namespace App\Http\Livewire\Parametrage;

use App\Models\Tranche;
use App\Models\TranchesKgPc;
use App\Models\TranchesPoidsPc;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ListeTranches extends Component
{
    use WithPagination;

    public $sortBy = 'nom';
    public $sortDirection = 'asc';
    public $perPage = 5;
    public $search = '';
    protected $listeners = ['saved'];

    public function render()
    {

        $tranchePoidsPc = DB::table('tranches_poids_pcs')
            ->select(['uid','id','nom']);

        $list = DB::table('tranches_kg_pcs')
                    ->select(['uid','id','nom'])
                    ->union($tranchePoidsPc);

        $items = $list->where('nom','ilike','%'.$this->search.'%')
        ->orderBy($this->sortBy, $this->sortDirection)
        ->paginate($this->perPage);

        return view('livewire.Parametrage.liste-tranches',[
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

    public function deleteTranche($uid)
    {
        $this->render();
        $tranche = TranchesKgPc::where('uid',$uid)->first();

        $tranche == null ? $tranche = TranchesPoidsPc::where('uid',$uid)->first() : '';

        $tranche->delete();
    }

    public function saved()
    {
        return $this->render();
    }


}
