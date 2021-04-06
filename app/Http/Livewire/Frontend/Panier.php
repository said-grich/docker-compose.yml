<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;

class Panier extends Component
{
    public function render()
    {
        return view('livewire.frontend.panier')->layout('layouts.frontend.app');
    }
}
