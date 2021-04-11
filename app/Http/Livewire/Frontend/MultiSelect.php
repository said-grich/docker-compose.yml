<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;

class MultiSelect extends Component
{
    public $selectId;
    public $selectTitle;
    public $selectType;
    public $selectOptions;

    public function render()
    {
        return view('livewire.frontend.multi-select');
    }
}
