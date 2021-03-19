<?php

namespace App\Http\Livewire\Achat;

use App\Models\ReglementFournisseur;
use Livewire\Component;

class ListeReglementFournisseur extends Component
{

    protected $listeners = ['saved'];

    public function saved()
    {
        $this->render();
    }
    
    public function render()
    {
        $list = ReglementFournisseur::all()->sortByDesc('created_at');
        return view('livewire.achat.liste-reglement-fournisseur', ['list' => $list]);
    }
}
