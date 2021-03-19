<?php

namespace App\Http\Livewire\ParamétrageUtilisateurs;

use App\Models\Depot;
use App\Models\Permission;
use App\Models\Role;
use App\Models\Site;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class CreateUsers extends Component
{

    public $users, $email, $password, $name, $role_id, $site_id, $depot_id;
    //public $site;
    public $depots_site = [];
    public $autoriser_autres_depots = [];
    public $sites_autorise = [];

    public $selectedPermissions = [];
    public $list_autres_sites = [];





    protected $rules = [
        'name' => 'required|min:3|max:50',
        'email' => 'email',
        'password' => 'required|confirmed|min:6',
        'site_id' => 'required',
        'depot_id' => 'required',
        'sites_autorise' => 'required',
    ];

    public function saveUser()

    {
        // $this->validate();
        /* try { */

        $this->password = Hash::make($this->password);

        $user = User::create(['name' => $this->name, 'email' => $this->email, 'password' => $this->password, 'site_id' => $this->site_id, 'autoriser_autres_depots' => $this->autoriser_autres_depots, 'sites_autorise' => $this->sites_autorise, 'depots_site' => $this->depots_site, 'depot_id' => $this->depot_id]);

        if ($this->role_id) {
            $role = Role::find($this->role_id);
            $user->attachRole($role);
        } else {
            $user->syncPermissions($this->selectedPermissions ?? []);
        }

        session()->flash('message', 'L\'utilisteur ' . $this->name . 'a été crée');

        /* } catch(\Illuminate\Database\QueryException $ex){
            session()->flash('error', "Erreur: ".$ex->getMessage());
        } */
    }


    public function sitesAutorises()
    {

        $list_sites_au = [];

        $sites = null;
        $sites = isset($this->depot_id) ? Depot::select('sites_locataires')->where('id', $this->depot_id)->first()->sites_locataires : [] ;

        $list_sites_au = isset($sites) ? Depot::select('sites_locataires')->where('id', $this->depot_id)->first()->sites_locataires : [] ;

        if (isset($this->autoriser_autres_depots))
        foreach ($this->autoriser_autres_depots as $depot) {

            $d = Depot::select('sites_locataires')->where('id', $depot)->first();

            $list_sites_au = isset($d->sites_locataires) ? array_merge($list_sites_au, $d->sites_locataires) : [] ;
        }

        $this->list_autres_sites = Site::whereIn('id', $list_sites_au)->get()->sortBy('name');

    }

    public function render()
    {
        $list_roles = Role::all();
        $list_permissions = Permission::all()->sortBy('departement');
        $da_permissions = Permission::where('departement', "DA")->get();
        $dv_permissions = Permission::where('departement', "DV")->get();
        $user_permissions = Permission::where('departement', "")->get();
        $compta_permissions = Permission::whereIn('name', ["consultation-bon-livraison", "consultation-factures", "consultation-bon-reception"])->get();
        $list_sites = Site::all()->sortBy('name');
        $list_depots = Depot::all()->sortBy('name');
        $list_depots_autorises = Depot::where('id', '!=', $this->depot_id)->get()->sortBy('name');

        return view('livewire.paramétrage-utilisateurs.create-users', ['list_roles' => $list_roles, 'list_permissions' => $list_permissions, 'da_permissions' => $da_permissions, 'dv_permissions' => $dv_permissions, 'compta_permissions' => $compta_permissions, 'user_permissions' => $user_permissions, 'list_sites' => $list_sites, 'list_depots' => $list_depots, 'list_depots_autorises' => $list_depots_autorises]);
    }
}
