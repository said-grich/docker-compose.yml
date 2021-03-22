<?php

namespace App\Http\Livewire\Parametrage;

use App\Models\CompteComptable;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ListeComptesComptables extends Component
{
    use WithPagination;

    public $sortBy = 'name';
    public $sortDirection = 'asc';
    public $perPage = 5;
    public $search = '';
    protected $listeners = ['saved'];

    public function render()
    {
        $comptable = CompteComptable::query()
        ->where('name','ilike','%'.$this->search.'%')
        ->orderBy($this->sortBy, $this->sortDirection)
        ->paginate($this->perPage);

        return view('livewire.Parametrage.liste-comptes-comptables',[
            'comptable'=> $comptable
        ]);
        //$list = CompteComptable::all()->sortByDesc('created_at');
        //return view('livewire.Parametrage.liste-comptes-comptables', [ 'list' => $list]);
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

    public function deleteCompteComptable($id)
    {

        $compte_comptable = CompteComptable::findOrFail($id);
        DB::table("compte_comptables")->where('id', $id)->delete();
        $compte_comptable->delete();



        return redirect()->to('/create-compte-comptable');

    }



    public function saved()
    {
        $this->render();
    }


}
