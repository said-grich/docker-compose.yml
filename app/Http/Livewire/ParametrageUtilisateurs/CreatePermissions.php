<?php

namespace App\Http\Livewire\ParametrageUtilisateurs;

use App\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;

class CreatePermissions extends Component
{
    public $name;
    public $display_name;
    public $description;


    public function createPermission()
    {

        $item = new Permission();
        $slug = Str::slug($this->display_name, '-');
        $item->name = $slug;
        $item->display_name = $this->display_name;
        $item->description = $this->description;
        $item->save();

        $this->reset(['name', 'display_name', 'description']);

        session()->flash('message', 'Permission successfully added.');
        $this->emit('saved');
    }


    public function render()
    {
        return view('livewire.Parametrage-utilisateurs.create-permissions');
    }
}
