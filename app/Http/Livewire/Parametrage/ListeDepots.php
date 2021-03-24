<?php

namespace App\Http\Livewire\Parametrage;

use App\Models\Depot;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ListeDepots extends Component
{

    use WithPagination;

    public $sortBy = 'nom';
    public $sortDirection = 'asc';
    public $perPage = 5;
    public $search = '';
    protected $listeners = ['saved'];

    public function render()
    {

        $items= Depot::query()
        ->where('nom','ilike','%'.$this->search.'%')
        ->orderBy($this->sortBy, $this->sortDirection)
        ->paginate($this->perPage);

        return view('livewire.parametrage.liste-depots',[
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
    
    public function deleteDepot($id)
    {

        $depot = Depot::findOrFail($id);
        $depot->delete();
        session()->flash('message', 'Dépôt "'.$depot->nom.'" à été supprimé');
        return redirect()->to('/depots');

    }



    public function saved()
    {
        $this->render();
    }

}
