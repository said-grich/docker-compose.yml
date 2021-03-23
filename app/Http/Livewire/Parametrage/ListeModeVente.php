<?php

namespace App\Http\Livewire\Parametrage;

use App\Models\ModeVente;
use Livewire\Component;
use Livewire\WithPagination;

class ListeModeVente extends Component
{
    use WithPagination;

    public $sortBy = 'nom';
    public $sortDirection = 'asc';
    public $perPage = 5;
    public $search = '';
    protected $listeners = ['saved'];

    public function render()
    {
        $items = ModeVente::query()
        ->where('nom','ilike','%'.$this->search.'%')
        ->orderBy($this->sortBy, $this->sortDirection)
        ->paginate($this->perPage);

        return view('livewire.Parametrage.liste-mode-vente',[
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

    public function deleteModeVente($id)
    {
        $this->render();
        $unite = ModeVente::findOrFail($id);
        $unite->delete();
    }

    public function saved()
    {
        return $this->render();
    }


}
