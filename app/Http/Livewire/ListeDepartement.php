<?php

namespace App\Http\Livewire;

use App\Models\Departement;
use App\Models\Famille;
use Livewire\Component;

class ListeDepartement extends Component
{
    protected $listeners = ['saved'];

    public function saved()
    {
        $this->render();
    }

    public function render()
    {
        $list = Departement::all()->sortByDesc('created_at');
        return view('livewire.liste-departement', [ 'list' => $list ]);
    }
}
