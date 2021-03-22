<?php

namespace App\Http\Livewire\Parametrage;

use App\Models\ModePreparation;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ListeModePreparation extends Component
{
    use WithPagination;

    public $sortBy = 'nom';
    public $sortDirection = 'asc';
    public $perPage = 5;
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

    public function deleteModePreparation($id)
    {

        $mode = ModePreparation::findOrFail($id);
        DB::table("mode_preparations")->where('id', $id)->delete();

        $mode->delete();
        session()->flash('message', 'Le mode de préparation "'.$mode->nom.'" à été supprimée');


        return redirect()->to('/preparations');

    }



    public function saved()
    {
        $this->render();
    }


}
