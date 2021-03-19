<?php

namespace App\Http\Livewire\ParamétrageUtilisateurs;

use App\Models\Depot;
use App\Models\Permission;
use App\Models\Role;
use App\Models\Site;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class EditUser extends Component
{
    public $user, $users, $email, $name, $role,$listPermissions=[],$selectedPermissions=[], $ida,$updated=[], $site_id, $depot_id;
    public $depots_site = [];
    public $sites_autorise = [];
    public $autoriser_autres_depots = [];
    public $list_autres_sites = [];

    protected $rules = [
        'name' => 'required|min:3|max:50',
        'email' => 'email',
        'site_id' => 'required',
        'depot_id' => 'required',
    ];

    public function mount()
    {
        $this->ida = request()->ida;
        $this->user = User::findOrFail($this->ida);

        $this->site_id = $this->user->site_id;
        $this->depot_id = $this->user->depot_id;
        $this->autoriser_autres_depots = $this->user->autoriser_autres_depots;
        $this->sites_autorise = $this->user->sites_autorise;

        $role = $this->user->roles;
        $this->name= $this->user->name;
        $this->email= $this->user->email;
        $this->role= $role[0]->id ?? null;

        $user_pr = $this->user;
        $this->listPermissions = Permission::all()
            ->map(function ($permission) use ($user_pr) {
                $permission->assigned = $user_pr->allPermissions()
                    ->pluck('id')
                    ->contains($permission->id);

                return $permission;


            });

            $this->sitesAutorises();
        /* $da = DB::table('permissions')
                ->where('departement', "DA")
                ->get();

        $da_permissions = $da->map(function ($permission) use ($user) {
            $permission->assigned = $user->allPermissions()
                ->pluck('id')
                ->contains($permission->id);

            return $permission;


        }); */



        /* $assignedPermissions = [];
        foreach($this->listPermissions as $value){
            //dd($value->assigned);
            if($value->assigned){
                array_push($assignedPermissions, $value->id);
            }
        }
        $this->selectedPermissions = $assignedPermissions; */
    }





    public function editUser()
    {
       //db transacction
        $this->validate();
        try{
            DB::transaction(function () {

        $this->user->name = $this->name;
        $this->user->email = $this->email;
        $this->user->site_id = $this->site_id;
        $this->user->depot_id = $this->depot_id;
        $this->user->autoriser_autres_depots = $this->autoriser_autres_depots;
        $this->user->sites_autorise = $this->sites_autorise;
        $this->user->save();

        $user = $this->user;
        $this->listPermissions = Permission::all()
        ->map(function ($permission) use ($user) {
            $permission->assigned = $user->allPermissions()
                ->pluck('id')
                ->contains($permission->id);

            return $permission;


        });
        $user->syncRoles([$this->role]);
        $user->syncPermissions($this->selectedPermissions ?? []);
        return redirect()->to('/create-users');

        session()->flash('message', "L'utilisateur $user->name a été modifié.");

    });



        }
        catch(\Illuminate\Database\QueryException $ex){
            session()->flash('error-message', "Erreur: ".$ex->getMessage());

        }
    }


    public function sitesAutorises()
    {

        $list_sites_auth = [];
        $sites = null;
        $sites = isset($this->depot_id) ?  Depot::select('sites_locataires')->where('id', $this->depot_id)->first()->sites_locataires : [] ;

        $list_sites_auth = isset($sites) ? Depot::select('sites_locataires')->where('id', $this->depot_id)->first()->sites_locataires : [] ;

        if (isset($this->autoriser_autres_depots)){
        foreach ($this->autoriser_autres_depots as $depot) {
            $d = Depot::select('sites_locataires')->where('id', $depot)->first();
           $list_sites_auth = isset($d->sites_locataires) ?  array_merge($list_sites_auth, $d->sites_locataires) : [] ;
        }}

        $this->list_autres_sites = Site::whereIn('id', $list_sites_auth)->get()->sortBy('name');

    }

    public function render()
    {

        $list_roles = Role::all();
        $user_permissions = Permission::where('departement', "")->get();
       // $da_permissions = Permission:: where('departement',"DA")->get();

       $da = DB::table('permissions')
                ->where('departement', "DA")
                ->get();
        $dv = DB::table('permissions')
        ->where('departement', "DV")
        ->get();

        $users = DB::table('permissions')
                ->where('departement', "")
                ->get();

        $compta = DB::table('permissions')
                ->whereIn('name', ["consultation-bon-livraison","consultation-factures","consultation-bon-reception"])
                ->get();

        $user = $this->user;


        $da_permissions = $da->map(function ($permission) use ($user) {
            $permission->assigned = $user->allPermissions()
                ->pluck('id')
                ->contains($permission->id);

            return $permission;


        });

        $dv_permissions = $dv->map(function ($permission) use ($user) {
            $permission->assigned = $user->allPermissions()
                ->pluck('id')
                ->contains($permission->id);

            return $permission;


        });

        $user_permissions = $users->map(function ($permission) use ($user) {
            $permission->assigned = $user->allPermissions()
                ->pluck('id')
                ->contains($permission->id);

            return $permission;


        });

        $compta_permissions = $compta->map(function ($permission) use ($user) {
            $permission->assigned = $user->allPermissions()
                ->pluck('id')
                ->contains($permission->id);

            return $permission;


        });
        $list_sites = Site::all()->sortBy('name');
        $list_depots = Depot::all()->sortBy('name');
        $list_depots_autorises = Depot::where('id', '!=', $this->depot_id)->get()->sortBy('name');


        return view('livewire.paramétrage-utilisateurs.edit-user',['list_roles'=>$list_roles,'da_permissions' =>$da_permissions, 'dv_permissions' => $dv_permissions,'compta_permissions'=>$compta_permissions,'user_permissions'=>$user_permissions, 'list_sites' => $list_sites, 'list_depots' => $list_depots, 'list_depots_autorises' => $list_depots_autorises]);
    }
}
