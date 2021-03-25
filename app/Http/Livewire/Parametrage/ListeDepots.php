<?php

namespace App\Http\Livewire\Parametrage;

use App\Models\Depot;
use App\Models\Ville;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ListeDepots extends Component
{

    use WithPagination;

    public $depot_id;
    public $nom;
    public $ville_id;
    public $list_villes;

    public $sortBy = 'nom';
    public $sortDirection = 'asc';
    public $perPage = 5;
    public $search = '';
    protected $listeners = ['saved'];

    public function mount(){
        $this->list_villes = Ville::all()->sortBy('nom');
    }

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

    public function edit($id){

        $item = Depot::where('id',$id)->firstOrFail();
        $this->depot_id =$item->id;
        $this->nom =$item->nom;
        $this->ville_id =$item->ville_id;
    }

    public function editModeDepot(){

        Depot::where('id', $this->depot_id)
            ->update([
                'nom' => $this->nom,
                'ville_id' => $this->ville_id,
            ]);

        session()->flash('message', 'Dépôt "'.$this->nom.'" à été modifié');
        return redirect()->to('/depots');
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
