<?php

namespace App\Http\Livewire;

use App\Models\EtatReglement;
use Livewire\Component;

class ReglementImpaye extends Component
{
    protected $listeners = ['saved'];

    public function saved()
    {
        $this->render();
    }
    
    public function render()
    {
        $list = EtatReglement::all()->sortByDesc('created_at');
        return view('livewire.reglement-impaye', ['list' => $list]);
    }
}
