<?php

namespace App\Http\Livewire\Paramétrage;

use App\Models\Unite;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ListeUnite extends Component
{
    use WithPagination;

    public $sortBy = 'name';
    public $sortDirection = 'asc';
    public $perPage = 5;
    public $search = '';
    protected $listeners = ['saved'];

    public function render()
    {
        $items = Unite::query()
        ->where('name','ilike','%'.$this->search.'%')
        ->orderBy($this->sortBy, $this->sortDirection)
        ->paginate($this->perPage);

        return view('livewire.paramétrage.liste-unite',[
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

    public function deleteUnite($id)
    {
        $this->render();
        $unite = Unite::findOrFail($id);
        DB::table("unites")->where('id', $id)->delete();
        $unite->delete();
    }

    public function saved()
    {
        return $this->render();
    }


}
