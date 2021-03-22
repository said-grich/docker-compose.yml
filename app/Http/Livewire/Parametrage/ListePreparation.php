<?php

namespace App\Http\Livewire\Parametrage;

use App\Models\Preparation;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ListePreparation extends Component
{
    use WithPagination;

    public $sortBy = 'nom';
    public $sortDirection = 'asc';
    public $perPage = 5;
    public $search = '';
    protected $listeners = ['saved'];

    public function render()
    {
        $items = Preparation::query()
        ->where('nom','ilike','%'.$this->search.'%')
        ->orderBy($this->sortBy, $this->sortDirection)
        ->paginate($this->perPage);

        return view('livewire.Parametrage.liste-preparation',[
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

    public function deletePreparation($id)
    {

        $preparation = Preparation::findOrFail($id);
        $preparation->delete();
        session()->flash('message', 'Le mode de préparation "'.$preparation->nom.'" à été supprimée');


        return redirect()->to('/preparations');

    }



    public function saved()
    {
        $this->render();
    }


}
