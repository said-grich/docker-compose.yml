<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;

class Apropos extends Component
{
    public function render()
    {
        return view('livewire.frontend.apropos')->layout('layouts.frontend.app');
    }
}
