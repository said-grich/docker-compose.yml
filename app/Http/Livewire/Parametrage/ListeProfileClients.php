<?php

namespace App\Http\Livewire\Parametrage;

use App\Models\ProfilClient;
use Livewire\Component;
use Livewire\WithPagination;

class ListeProfileClients extends Component
{
    use WithPagination;

    public $sortBy = 'nom';
    public $sortDirection = 'asc';
    public $perPage = 10;
    public $search = '';
    protected $listeners = ['saved'];

    public $nom;
    public $profil_id;

    public function sortBy($field)
    {
        if ($this->sortDirection == 'asc') {
            $this->sortDirection = 'desc';
        } else {
            $this->sortDirection = 'asc';
        }

        return $this->sortBy = $field;
    }
    public function edit($id){

        $item = ProfilClient::where('id',$id)->firstOrFail();
        $this->profil_id =$item->id;
        $this->nom =$item->nom;

    }

    public function editProfile(){
//dd("test");
        ProfilClient::where('id', $this->profil_id)
            ->update([
                'nom' => $this->nom,
            ]);

        session()->flash('message', 'Client "'.$this->nom.'" à été modifié');
        /* return redirect()->to('/depots'); */
    }
    public function deleteProfileClient($id)
    {

        $profile = ProfilClient::findOrFail($id);
        //DB::table("fournisseurs")->where('id', $id)->delete();

        $profile->delete();
        session()->flash('message', 'Profile client "'. $profile->nom.'" à été supprimé');

        //return redirect()->to('/familles');

    }
    public function render()
    {

        $items = ProfilClient::query()
        ->where('nom','ilike','%'.$this->search.'%')
        ->withCount('clients')
        ->orderBy($this->sortBy, $this->sortDirection)
        ->paginate($this->perPage);

        return view('livewire.parametrage.liste-profile-clients',[
            'items'=> $items
        ]);
    }
    public function saved()
    {
        return  $this->render();
    }

}
