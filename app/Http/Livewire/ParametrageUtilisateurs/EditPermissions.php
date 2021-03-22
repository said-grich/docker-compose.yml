<?php

namespace App\Http\Livewire\ParametrageUtilisateurs;

use App\Models\Permission;
use Illuminate\Support\Str;
use Livewire\Component;

class EditPermissions extends Component
{
    public $name;
    public $display_name;
    public $description;
    public $permission;
    public $ida;

    public function mount()
    {
        $this->ida = request()->ida;
        $this->permission = Permission::findOrFail($this->ida);
        $this->name= $this->permission->name;
        $this->display_name= $this->permission->display_name;
        $this->description= $this->permission->description;

    }

    public function editPermission()
    {

            $slug = Str::slug($this->display_name, '-');
            $this->permission->name = $slug;
            $this->permission->display_name = $this->display_name;
            $this->permission->description = $this->description;
            $this->permission->save();

            $permission = $this->permission;
            session()->flash('message', "L'autorisation $permission->display_name a été modifiée.");

            return redirect()->to('/create-permissions');

    }

    public function render()
    {
        return view('livewire.Parametrage-utilisateurs.edit-permissions');
    }
}
