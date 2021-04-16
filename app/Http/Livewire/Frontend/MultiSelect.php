<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
use Session;

class MultiSelect extends Component
{
    public $selectId;
    public $selectTitle;
    public $selectType;
    public $selectOptions;
    public $mode;
    public $key;
    public $test;

    public function updatedTest($value, $index){
        $index = explode("_", $index);
        $hhh = Session::get($index[0]);
        if(count($hhh[$index[1]]) > 1){
            array_pop($hhh[$index[1]]);
        }
        array_push($hhh[$index[1]], ['preparations' => $value]);
        Session::put($index[0], $hhh);
        // dump(Session::get($index[0]));
    }

    public function render()
    {
        // dump(Session::all());
        return view('livewire.frontend.multi-select');
    }
}
