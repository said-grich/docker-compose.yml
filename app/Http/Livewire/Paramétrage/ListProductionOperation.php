<?php

namespace App\Http\Livewire\Paramétrage;

use App\Models\ProductionOperation;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ListProductionOperation extends Component
{
    use WithPagination;

    public $sortBy = 'operation';
    public $sortDirection = 'asc';
    public $perPage = 5;
    public $search = '';
    protected $listeners = ['saved'];

    public function render()
    {
        $operation = ProductionOperation::query()
        ->where('operation','ilike','%'.$this->search.'%')
        ->orderBy($this->sortBy, $this->sortDirection)
        ->paginate($this->perPage);

        return view('livewire.paramétrage.list-production-operation',[
            'operation'=> $operation
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
    public function deleteProductionOperation($id)
    {
        $this->render();
        $oper = ProductionOperation::findOrFail($id);
        
        $oper->delete();
    }
    public function saved()
    {
        return $this->render();
    }
}
