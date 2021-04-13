<?php

namespace App\Http\Livewire\Parametrage;

use App\Models\ModePreparation;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ListeModePreparation extends Component
{
    use WithPagination;

    public $mode_preparation_id;
    public $nom;

    public $sortBy = 'nom';
    public $sortDirection = 'asc';
    public $perPage = 10;
    public $search = '';
    protected $listeners = ['saved'];

    public function render()
    {
        $items = ModePreparation::query()
        ->where('nom','ilike','%'.$this->search.'%')
        ->orderBy($this->sortBy, $this->sortDirection)
        ->paginate($this->perPage);

        return view('livewire.Parametrage.liste-mode-preparation',[
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

    public function edit($id){

        $item = ModePreparation::where('id',$id)->firstOrFail();
        $this->mode_preparation_id =$item->id;
        $this->nom =$item->nom;
    }

    public function editModePreparation(){

        ModePreparation::where('id', $this->mode_preparation_id)
            ->update([
                'nom' => $this->nom,
            ]);

        session()->flash('message', 'Mode préparation "'.$this->nom.'" à été modifié');
    }

    public function deleteModePreparation($id)
    {

        $mode = ModePreparation::findOrFail($id);
        $mode->delete();

        session()->flash('message', 'Le mode de préparation "'.$mode->nom.'" à été supprimée');


        return redirect()->to('/preparations');

    }



    public function saved()
    {
        $this->render();
    }


}
