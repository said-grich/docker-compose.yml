<?php

namespace App\Http\Livewire\Parametrage;

use App\Models\ModePreparation;
use App\Models\Preparation;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ListePreparation extends Component
{
    use WithPagination;

    public $mode_preparation;
    public $nom;
    public $preparation_id;
    public $list_mode_preparations = [];

    public $sortBy = 'nom';
    public $sortDirection = 'asc';
    public $perPage = 5;
    public $search = '';
    protected $listeners = ['saved'];

    public function renderModePreparations()
    {
        $this->list_mode_preparations = ModePreparation::all()->sortBy('nom');
    }

    public function render()
    {
        $this->renderModePreparations();

        $items = Preparation::query()
        ->where('nom','ilike','%'.$this->search.'%')
        ->orderBy($this->sortBy, $this->sortDirection)
        ->paginate($this->perPage);

        return view('livewire.Parametrage.liste-preparation',compact('items'));

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

        $item = Preparation::where('id',$id)->firstOrFail();
        $this->preparation_id =$item->id;
        $this->nom =$item->nom;
        $this->mode_preparation =$item->mode_preparation_id;
    }

    public function editPreparation(){

        Preparation::where('id', $this->preparation_id)
            ->update([
                'nom' => $this->nom,
                'mode_preparation_id' => $this->mode_preparation,
            ]);

        session()->flash('message', 'Sous mode prépartion "'.$this->nom.'" à été modifié');
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
