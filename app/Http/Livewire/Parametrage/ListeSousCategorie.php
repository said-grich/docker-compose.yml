<?php

namespace App\Http\Livewire\Parametrage;

use App\Models\Categorie;
use App\Models\SousCategorie;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ListeSousCategorie extends Component
{
    use WithPagination;

    public $sortBy = 'nom';
    public $sortDirection = 'asc';
    public $perPage = 5;
    public $search = '';
    protected $listeners = ['saved'];

    public function render()
    {
        $items = SousCategorie::query()
        ->where('nom','ilike','%'.$this->search.'%')
        ->orderBy($this->sortBy, $this->sortDirection)
        ->paginate($this->perPage);

        return view('livewire.Parametrage.liste-sous-categorie',[
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

    public function deleteSousCategorie($id)
    {
        $this->render();
        $sousCategorie = SousCategorie::findOrFail($id);
        DB::table("categories")->where('id', $id)->delete();
        $sousCategorie->delete();
    }

    public function saved()
    {
        return $this->render();
    }


}
