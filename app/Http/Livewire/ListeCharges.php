<?php

namespace App\Http\Livewire;

use App\Models\Charge;
use App\Models\ChargeLine;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ListeCharges extends Component
{
    use WithPagination;

    public $ref;
    public $ida;
    public $perPage = 10;
    //public $sortField = "created_at";
    public $sortAsc = true;
    public $search = '';

    protected $listeners = ['saved'];

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }



    public function deleteDevis($ref, $id)
    {
        $this->ida = $id;
        $this->ref = $ref;

        DB::transaction(function () {


            Charge::where('id', $this->ida)->delete();
            Charge::where('bon_reception_ref', $this->ref)->delete();
        });
    }


    public function saved()
    {
        $this->render();
    }

    public function render()
    {
        $list = Charge::search($this->search)
            //->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);
        $chargeLignes = ChargeLine::all();
        return view('livewire.compta-finance.liste-charges', ['list' => $list]);
    }

}
