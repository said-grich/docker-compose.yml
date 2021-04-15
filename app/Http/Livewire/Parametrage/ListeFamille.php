<?php

namespace App\Http\Livewire\Parametrage;

use App\Models\Famille;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ListeFamille extends Component
{
    use WithPagination;

    public $famille_id;
    public $nom;

    public $sortBy = 'nom';
    public $sortDirection = 'asc';
    public $perPage = 10;
    public $search = '';
    protected $listeners = ['saved'];

    public function render()
    {
        $famille = Famille::query()
        ->where('nom','ilike','%'.$this->search.'%')
        ->orderBy($this->sortBy, $this->sortDirection)
        ->paginate($this->perPage);

        return view('livewire.Parametrage.liste-famille',[
            'famille'=> $famille
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

        $item = Famille::where('id',$id)->firstOrFail();
        $this->famille_id =$item->id;
        $this->nom =$item->nom;
    }

    public function editFamille(){

        Famille::where('id', $this->famille_id)
            ->update([
                'nom' => $this->nom,
            ]);

        session()->flash('message', 'Famille "'.$this->nom.'" à été modifiée');
        $this->emit('saved');
    }

    public function deleteFamille($id)
    {

        $famille = Famille::findOrFail($id);
        $famille->delete();

        session()->flash('message', 'Famille "'.$famille->nom.'" à été supprimée');
       // return redirect()->to('/familles');

    }


    public function saved(){

        $this->render();
    }


}
