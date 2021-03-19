<?php

namespace App\Http\Livewire\ParamétrageUtilisateurs;

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
        return view('livewire.paramétrage-utilisateurs.liste-roles',[ 'roles' => $roles ]);
    }
}
