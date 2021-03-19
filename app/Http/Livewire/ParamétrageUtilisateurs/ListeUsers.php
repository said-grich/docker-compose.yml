<?php

namespace App\Http\Livewire\ParamétrageUtilisateurs;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ListeUsers extends Component
{

    public function deleteUser($id)
    {

        $user = User::findOrFail($id);
        $user->delete();

        session()->flash('message', "L'utilisateur $user->name a été supprimé.");

        return redirect()->to('/create-users');

    }

    protected $listeners = ['saved'];

    public function saved()
    {
        $this->render();
    }
    
    public function render()
    {
        //$user = Auth::user();
        //$user->roles->first()->name;
        //dump($user->allPermissions());
        $list_users = User::all();
        return view('livewire.paramétrage-utilisateurs.liste-users',['list_users'=> $list_users]);
    }
}
