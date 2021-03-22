<?php

namespace App\Http\Livewire\Parametrage;

use App\Models\SousFamille;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ListeSousFamille extends Component
{
    use WithPagination;

    public $sortBy = 'name';
    public $sortDirection = 'asc';
    public $perPage = 5;
    public $search = '';
    protected $listeners = ['saved'];

    public function render()
    {
        $sousfamille = SousFamille::query()
        ->where('name','ilike','%'.$this->search.'%')
        ->orderBy($this->sortBy, $this->sortDirection)
        ->paginate($this->perPage);

        return view('livewire.Parametrage.liste-sous-famille',[
            'sousfamille'=> $sousfamille
        ]);
        //$list = SousFamille::all()->sortByDesc('created_at');
        //return view('livewire.Parametrage.liste-sous-famille', [ 'list' => $list ]);
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
    
    public function deleteSousFamille($id)
    {

        $sous_famille = SousFamille::findOrFail($id);
        DB::table("sous_familles")->where('id', $id)->delete();
        $sous_famille->delete();



        return redirect()->to('/create-sous-famille');

    }


    public function saved()
    {
        $this->render();
    }


}
