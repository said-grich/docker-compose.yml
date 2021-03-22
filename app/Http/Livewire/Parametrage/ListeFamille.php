<?php

namespace App\Http\Livewire\Parametrage;

use App\Models\Famille;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ListeFamille extends Component
{
    use WithPagination;

    public $sortBy = 'code';
    public $sortDirection = 'asc';
    public $perPage = 5;
    public $search = '';
    protected $listeners = ['saved'];

    public function render()
    {
        $famille = Famille::query()
        ->where('code','ilike','%'.$this->search.'%')
        ->orderBy($this->sortBy, $this->sortDirection)
        ->paginate($this->perPage);

        return view('livewire.Parametrage.liste-famille',[
            'famille'=> $famille
        ]);
        /*$famille = Famille::all();
        $list = Famille::all()->sortByDesc('created_at');
        return view('livewire.Parametrage.liste-famille', [ 'list' => $list , 'famille' => $famille]);*/
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

    public function deleteFamille($id)
    {

        $famille = Famille::findOrFail($id);
        DB::table("familles")->where('id', $id)->delete();
        $famille->delete();



        return redirect()->to('/create-famille');

    }



    public function saved()
    {
        $this->render();
    }


}
