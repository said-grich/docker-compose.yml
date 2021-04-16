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
    public $isActive = false;

    public $sortBy = 'nom';
    public $sortDirection = 'asc';
    public $perPage = 10;
    public $search = '';
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

    public function edit($id){

        $item = Unite::where('id',$id)->firstOrFail();
        $this->unite_id =$item->id;
        $this->nom =$item->nom;
        $this->isActive =$item->active;
    }

    public function editUnite(){

        Unite::where('id', $this->unite_id)
            ->update([
                'nom' => $this->nom,
                'active' => $this->isActive,
            ]);


        session()->flash('message', 'Unité "'.$this->nom.'" à été modifiée');

        $this->emit('saved');
    }

    public function deleteUnite($id)
    {
        $this->render();
        $unite = Unite::findOrFail($id);
        DB::table("unites")->where('id', $id)->delete();

        $unite->delete();
        session()->flash('message', 'Unité "'.$unite->nom.'" à été supprimée');

       // return redirect()->to('/unites');
    }
    public function render()
    {
        $items = Unite::query()
        ->where('nom','ilike','%'.$this->search.'%')
        ->orderBy($this->sortBy, $this->sortDirection)
        ->paginate($this->perPage);

        return view('livewire.parametrage.liste-unite',[
            'items'=> $items
        ]);
    }


    public function saved()
    {
        return $this->render();
    }


}
