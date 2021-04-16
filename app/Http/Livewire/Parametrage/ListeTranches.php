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

    public $tranche_id;
    public $mode_vente_id;
    public $min_poids;
    public $max_poids;
    public $uid;
    public $nom;

    public function render()
    {

        /* $tranchePoidsPc = DB::table('tranches_poids_pcs')
            ->select(['uid','id','nom']);

        $list = DB::table('tranches_kg_pcs')
                    ->select(['uid','id','nom'])
                    ->union($tranchePoidsPc); */

        $items = Tranche::where('nom','ilike','%'.$this->search.'%')
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

    public function edit($id){

        $item = Tranche::where('id',$id)->firstOrFail();
        $this->tranche_id =$item->id;
        $this->nom =$item->nom;
        $this->mode_vente_id =$item->mode_vente_id;
        $this->min_poids =$item->min_poids;
        $this->max_poids =$item->max_poids;
        $this->uid =$item->uid;
    }

    public function editTranche(){

        Tranche::where('id', $this->tranche_id)
            ->update([
                'nom' => $this->nom,
                'mode_vente_id' => $this->mode_vente_id,
                'min_poids' => $this->min_poids,
                'max_poids' => $this->max_poids,
                'uid' => $this->uid,
            ]);


        session()->flash('message', 'Tranche "'.$this->nom.'" à été modifiée');
        $this->emit('saved');
    }
    public function deleteTranche($uid)
    {
        $this->render();
        /* $tranche = TranchesKgPc::where('uid',$uid)->first();

        $tranche == null ? $tranche = TranchesPoidsPc::where('uid',$uid)->first() : ''; */
        $tranche = Tranche::where('uid',$uid)->first();

        $tranche->delete();
        session()->flash('message', 'Tranche "'.$tranche->nom.'" est supprimée');

    }

    public function saved()
    {
        return $this->render();
    }


}
