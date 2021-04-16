<?php

namespace App\Http\Livewire\Parametrage;

use App\Models\Categorie;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ListeCategorie extends Component
{
    use WithPagination;

    public $categorie_id;
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

        $item = Categorie::where('id',$id)->firstOrFail();
        $this->categorie_id =$item->id;
        $this->nom =$item->nom;
        $this->isActive =$item->active;
    }

    public function editCategorie(){

        Categorie::where('id', $this->categorie_id)
            ->update([
                'nom' => $this->nom,
                'active' => $this->isActive,
            ]);

        session()->flash('message', 'Catégorie "'.$this->nom.'" à été modifiée');
        $this->emit('saved');
    }

    public function deleteCategorie($id)
    {
        $this->render();
        $unite = Categorie::findOrFail($id);
        DB::table("categories")->where('id', $id)->delete();
        $unite->delete();
        session()->flash('message', 'Catégorie "'.$this->nom.'" à été supprimée');
    }

    public function render()
    {
        $items = Categorie::query()
        ->where('nom','ilike','%'.$this->search.'%')
        ->orderBy($this->sortBy, $this->sortDirection)
        ->paginate($this->perPage);

        return view('livewire.parametrage.liste-categorie',[
            'items'=> $items
        ]);
    }

    public function saved()
    {
        return $this->render();
    }


}
