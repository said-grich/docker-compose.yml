<?php

namespace App\Http\Livewire\Frontend;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Deconnecter extends Component
{
    public function deconnecter()
    {
        Auth::logout();
        return redirect(route('connexion'));
    }

    public function render()
    {
        return view('livewire.frontend.deconnecter');
    }
}
