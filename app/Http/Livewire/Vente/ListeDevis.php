<?php

namespace App\Http\Livewire\Vente;

use App\Models\Devis;
use App\Models\DevisLine;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ListeDevis extends Component
{
    use WithPagination;

    public $ref;
    public $ida;
    public $sortBy = 'ref';
    public $sortDirection = 'asc';
    public $perPage = 5;
    // public $sortField = "date";
    // public $sortAsc = true;
    public $search = '';

    protected $listeners = ['saved'];

    public function sortBy($field)
    {
        if ($this->sortDirection == 'asc') {
            $this->sortDirection = 'desc';
        } else {
            $this->sortDirection = 'asc';
        }

        return $this->sortBy = $field;
    }

    public function deleteDevis($ref, $id)
    {
        $this->ida = $id;
        $this->ref = $ref;

        DB::transaction(function () {


            Devis::where('id', $this->ida)->delete();
            DevisLine::where('devis_ref', $this->ref)->delete();
        });
    }


    public function saved()
    {
        $this->render();
    }

    public function render()
    {
        $list = Devis::query($this->search)
            ->where('ref','ilike','%'.$this->search.'%')
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->perPage);
        // dd($list);
        return view('livewire.vente.liste-devis', ['list' => $list]);
    }
}
