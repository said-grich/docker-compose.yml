<?php

namespace App\Http\Livewire\Parametrage;

use App\Models\Livreur;
use Livewire\Component;
use Livewire\WithPagination;

class ListeLivreurs extends Component
{
    use WithPagination;

    public $sortBy = 'nom';
    public $sortDirection = 'asc';
    public $perPage = 5;
    public $search = '';
    protected $listeners = ['saved'];

    public function render()
    {
        $items = Livreur::query()
        ->where('nom','ilike','%'.$this->search.'%')
        ->orderBy($this->sortBy, $this->sortDirection)
        ->paginate($this->perPage);

        return view('livewire.Parametrage.liste-livreurs',[
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

    public function deleteLivreur($id)
    {
        $this->render();
        $unite = Livreur::findOrFail($id);
        $unite->delete();
    }

    public function saved()
    {
        return $this->render();
    }


}
