<?php

namespace App\Http\Livewire;

use Livewire\Component;

class MultiSelect extends Component
{
    public $selectId;
    public $selectTitle;
    public $selectType;
    public $selectOptions;
    public $selected;

    public function render()
    {
        return view('livewire.multi-select');
    }
}
