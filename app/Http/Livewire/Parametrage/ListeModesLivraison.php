<?php

namespace App\Http\Livewire\Parametrage;

use App\Models\ModeLivraison;
use App\Models\ModePaiement;
use Livewire\Component;
use Livewire\WithPagination;

class ListeModesLivraison extends Component
{

    use WithPagination;

    public $sortBy = 'nom';
    public $sortDirection = 'asc';
    public $perPage = 5;
    public $search = '';
    protected $listeners = ['saved'];

    public function render()
    {
        $items = ModeLivraison::query()
        ->where('nom','ilike','%'.$this->search.'%')
        ->orderBy($this->sortBy, $this->sortDirection)
        ->paginate($this->perPage);

        return view('livewire.parametrage.liste-modes-livraison',[
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

    public function deleteModeLivraison($id)
    {

        $mode = ModeLivraison::findOrFail($id);
        $mode->delete();

        session()->flash('message', 'Le mode de livraison "'.$mode->nom.'" à été supprimé');
        return redirect()->to('/modes-livraison');

    }

    public function saved()
    {
        $this->render();
    }


}
