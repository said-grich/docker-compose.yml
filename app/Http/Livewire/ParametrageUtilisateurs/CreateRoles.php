<?php

namespace App\Http\Livewire\ParametrageUtilisateurs;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;
use Illuminate\Http\Request;

class CreateRoles extends Component
{
    public $permissions = [];
    public $selectedPermissions = [];
    public $display_name;
    public $name;
    public $description;


    public function saveRole(Request $request){
        $role = new Role();
        $role->display_name = $this->display_name;
        $slug = Str::slug($this->display_name, '-');
        $role->name = $slug;
        $role->description = $this->description;

        $role->save();

        $this->reset(['permissions', 'selectedPermissions', 'display_name', 'name', 'description']);

        //dd($role->syncPermissions($this->selectedPermissions ?? []));
        $role->syncPermissions($this->selectedPermissions ?? []);

        session()->flash('message', 'Crée avec succès.');



    }

    public function render()
    {

        $this->permissions = Permission::all();


        return view('livewire.Parametrage-utilisateurs.create-roles',[ 'permissions' => $this->permissions[0] ?? null ]);
    }
}
