<?php

namespace App\Http\Livewire\Stock;

use App\Models\Stock ;
use Livewire\Component;

class EtatStock extends Component
{

    public $sortBy = 'lot_num';
    public $sortDirection = 'asc';
    public $perPage = 5;
    public $search = '';

    public function render()
    {

        $items = Stock::query()
        ->where('lot_num','ilike','%'.$this->search.'%')
        ->orderBy($this->sortBy, $this->sortDirection)
        ->paginate($this->perPage);

        return view('livewire.stock.etat-stock',[
            'items'=> $items,
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

}
