<?php

namespace App\Http\Livewire\Parametrage;

use Illuminate\Support\Facades\DB;
use App\Models\ProductionOperation;
use Livewire\Component;

class CreateProductionOpération extends Component
{
    public $operation;

    protected $rules = [
        'operation' => 'required',
    ];

    public function createProductionOperation()
    {
        $this->validate();

        $item = new ProductionOperation();
        $item->operation = $this->operation;
        $item->save();

        $this->reset(['operation']);

        $this->emit('saved');
    }
    public function render()
    {
        return view('livewire.Parametrage.create-production-opération');
    }
}
