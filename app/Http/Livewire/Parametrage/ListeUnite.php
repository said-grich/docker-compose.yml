<?php

namespace App\Http\Livewire\Parametrage;

use App\Models\Unite;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ListeUnite extends Component
{
    use WithPagination;

    public $unite_id;
    public $nom;

    public $sortBy = 'nom';
    public $sortDirection = 'asc';
    public $perPage = 10;
    public $search = '';
    protected $listeners = ['saved'];

    public function render()
    {
        $items = Unite::query()
        ->where('nom','ilike','%'.$this->search.'%')
        ->orderBy($this->sortBy, $this->sortDirection)
        ->paginate($this->perPage);

        return view('livewire.Parametrage.liste-unite',[
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

        $item = Unite::where('id',$id)->firstOrFail();
        $this->unite_id =$item->id;
        $this->nom =$item->nom;
    }

    public function editUnite(){
        
        Unite::where('id', $this->unite_id)
            ->update([
                'nom' => $this->nom,
            ]);

        session()->flash('message', 'Unité "'.$this->nom.'" à été modifiée');
    }

    public function deleteUnite($id)
    {
        $this->render();
        $unite = Unite::findOrFail($id);
        DB::table("unites")->where('id', $id)->delete();
        $unite->delete();
    }

    public function saved()
    {
        return $this->render();
    }


}
