<?php

namespace App\Http\Livewire\ParametrageUtilisateurs;

use App\Models\Role;
use Livewire\Component;

class ListeRoles extends Component
{

    protected $listeners = ['saved'];

    public function saved()
    {
        $this->render();
    }
    
    public function render()
    {
        $roles = Role::all();
        return view('livewire.Parametrage-utilisateurs.liste-roles',[ 'roles' => $roles ]);
    }
}
