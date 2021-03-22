<?php

namespace App\Http\Livewire\ParametrageUtilisateurs;

use App\Models\Permission;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ListePermissions extends Component
{

    public function deletePermission($id)
    {

        $permission = Permission::findOrFail($id);
        DB::table("permission_role")->where('permission_id', $id)->delete();
        $permission->delete();

        session()->flash('message', "La permission $permission->name a été supprimée.");

        return redirect()->to('/create-permissions');

    }
    protected $listeners = ['saved'];

    public function saved()
    {
        $this->render();
    }

    public function render()
    {
        $permissions = Permission::all();
        return view('livewire.Parametrage-utilisateurs.liste-permissions',[ 'permissions' => $permissions ]);
    }
}
