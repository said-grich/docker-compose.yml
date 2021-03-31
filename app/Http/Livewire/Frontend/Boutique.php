<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;

class Boutique extends Component
{
    public function render()
    {
        return view('livewire.frontend.boutique')->layout('layouts.frontend.app');
    }
}
