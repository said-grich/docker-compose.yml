<?php

namespace App\Http\Livewire\Parametrage;

use App\Models\Fournisseur;
use App\Models\BonAchat;
use Livewire\Component;
use Livewire\WithPagination;

class ListFournisseurs extends Component
{
    use WithPagination;

    public $sortBy = 'name';
    public $sortDirection = 'asc';
    public $perPage = 5;
    public $search = '';
    protected $listeners = ['saved'];

    public function render()
    {
        $fournisseur = Fournisseur::query()
        ->where('name','ilike','%'.$this->search.'%')
        ->orderBy($this->sortBy, $this->sortDirection)
        ->paginate($this->perPage);

        return view('livewire.Parametrage.list-fournisseurs',[
            'fournisseur'=> $fournisseur
        ]);
        /*$situationFourniseur = BonAchat::where('fournisseur_id', '1')->get();
        $list = Fournisseur::all()->sortByDesc('created_at');
        return view('livewire.Parametrage.list-fournisseurs', [ 'list' => $list, 'situationFourniseur'=> $situationFourniseur ]);*/
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

    public function saved()
    {
        $this->render();
    }



}
