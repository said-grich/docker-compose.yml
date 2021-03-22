<?php

namespace App\Http\Livewire\ParametrageUtilisateurs;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Livewire\Component;

class EditRoles extends Component
{
    public $name;
    public $display_name;
    public $description;
    public $role;
    public $ida;
    public $listPermissions= [];
    public $selectedPermissions = [];

    public $array = [];


    public function mount()
    {
        $this->ida = request()->ida;
        $this->role = Role::findOrFail($this->ida);
        $this->name= $this->role->name;
        $this->display_name= $this->role->display_name;
        $this->description= $this->role->description;

        $user_pr = $this->user;
        $this->listPermissions = Permission::all()
            ->map(function ($permission) use ($user_pr) {
                $permission->assigned = $user_pr->permissions
                    ->pluck('id')
                    ->contains($permission->id);

                return $permission;


            });

        $t = [];


        foreach($this->listPermissions as $value){
            //dd($value->assigned);
            if($value->assigned){
                array_push($t, $value->id);
            }
        }

        $this->selectedPermissions = $t;
    }

    public function editRole(Request $request)
    {



        $slug = Str::slug($this->display_name, '-');
        $this->role->name = $slug;

        $this->role->display_name = $this->display_name;
        $this->role->description = $this->description;


        $this->role->save();

        $this->role->syncPermissions($this->selectedPermissions ?? []);
        $role = $this->role;
        session()->flash('message', "Le role $role->name a été modifié.");

    }

    public function render()
    {
        return view('livewire.Parametrage-utilisateurs.edit-roles',['permissions'=>$this->listPermissions]);
    }
}
