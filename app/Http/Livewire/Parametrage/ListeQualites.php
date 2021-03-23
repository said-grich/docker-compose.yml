<?php

namespace App\Http\Livewire\Parametrage;

use App\Models\Qualite;
use Livewire\Component;
use Livewire\WithPagination;

class ListeQualites extends Component
{
    use WithPagination;

    public $sortBy = 'nom';
    public $sortDirection = 'asc';
    public $perPage = 5;
    public $search = '';
    protected $listeners = ['saved'];

    public function render()
    {
        $items = Qualite::query()
        ->where('nom','ilike','%'.$this->search.'%')
        ->orderBy($this->sortBy, $this->sortDirection)
        ->paginate($this->perPage);

        return view('livewire.parametrage.liste-qualites',[
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

    public function deleteQualite($id)
    {

        $qualite = Qualite::findOrFail($id);
        //DB::table("fournisseurs")->where('id', $id)->delete();

        $qualite->delete();
        session()->flash('message', 'Qualité "'.$qualite->nom.'" à été supprimé');

        //return redirect()->to('/familles');

    }

    public function saved()
    {
        $this->render();
    }

}
