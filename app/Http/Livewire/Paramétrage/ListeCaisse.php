<?php

namespace App\Http\Livewire\Paramétrage;

use App\Models\Caisse;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ListeCaisse extends Component
{
    use WithPagination;

    public $sortBy = 'name';
    public $sortDirection = 'asc';
    public $perPage = 5;
    public $search = '';
    protected $listeners = ['saved'];

    public function render()
    {
        $caisse = Caisse::query()
        ->where('name','ilike','%'.$this->search.'%')
        ->orderBy($this->sortBy, $this->sortDirection)
        ->paginate($this->perPage);

        return view('livewire.paramétrage.liste-caisse',[
            'caisse'=> $caisse
        ]);

        /*$caisse = Caisse::all();
        $list = Caisse::all()->sortByDesc('created_at');
        return view('livewire.paramétrage.liste-caisse', ['list' => $list, 'caisse' => $caisse]);*/
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
    
    public function deleteCaisse($id)
    {

        $caisse = Caisse::findOrFail($id);
        DB::table("caisses")->where('id', $id)->delete();
        $caisse->delete();



        return redirect()->to('/create-caisse');

    }



    public function saved()
    {
        $this->render();
    }


}
