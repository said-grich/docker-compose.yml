<?php

namespace App\Http\Livewire\Paramétrage;

use App\Models\Compte;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;



class ListeCompte extends Component
{
    use WithPagination;

    public $sortBy = 'name';
    public $sortDirection = 'asc';
    public $perPage = 5;
    public $search = '';
    protected $listeners = ['saved'];

    public function render()
    {
        $compte = Compte::query()
        ->where('name','ilike','%'.$this->search.'%')
        ->orderBy($this->sortBy, $this->sortDirection)
        ->paginate($this->perPage);

        return view('livewire.paramétrage.liste-compte',[
            'compte'=> $compte
        ]);
        /*$compte = Compte::all();
        $list = Compte::all()->sortByDesc('created_at');
        //dd($list);
        return view('livewire.paramétrage.liste-compte', [ 'list' => $list, 'compte' => $compte ]);*/
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
    public function deleteCompte($id)
    {

        $compte = Compte::findOrFail($id);
        DB::table("comptes")->where('id', $id)->delete();
        $compte->delete();



        return redirect()->to('/create-compte');

    }



    public function saved()
    {
        $this->render();
    }


}
