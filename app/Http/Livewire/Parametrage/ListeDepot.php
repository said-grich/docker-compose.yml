<?php

namespace App\Http\Livewire\Parametrage;

use App\Models\Depot;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ListeDepot extends Component
{
    use WithPagination;

    public $sortBy = 'code';
    public $sortDirection = 'asc';
    public $perPage = 5;
    public $search = '';
    protected $listeners = ['saved'];

    public function render()
    {

        $depots= Depot::query()
        ->where('code','ilike','%'.$this->search.'%')
        ->orderBy($this->sortBy, $this->sortDirection)
        ->paginate($this->perPage);

        return view('livewire.Parametrage.liste-depot',[
            'depots'=> $depots
        ]);
        //$depot = Depot::all();
        //$list = Depot::all()->sortByDesc('created_at');
        //return view('livewire.Parametrage.liste-depot', ['list' => $list, 'depot' => $depot]);
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
    public function deleteDepot($id)
    {

        $depot = Depot::findOrFail($id);
        DB::table("depots")->where('id', $id)->delete();
        $depot->delete();



        return redirect()->to('/create-depot');

    }



    public function saved()
    {
        $this->render();
    }


}
