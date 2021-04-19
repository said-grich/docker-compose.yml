<?php

namespace App\Http\Livewire\Parametrage;

use App\Models\User;
use App\Models\ProfilClient;
use Livewire\Component;
use Livewire\WithPagination;

class ListeClients extends Component
{
    use WithPagination;

    public $client_id;
    public $name;
    public $tel;
    public $email;
    public $profil_id;
    public $list_profils;

    public $sortBy = 'name';
    public $sortDirection = 'asc';
    public $perPage = 10;
    public $search = '';
    protected $listeners = ['saved'];

    public function mount(){
        $this->list_profils = ProfilClient::all()->sortBy('name');
    }


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

        $item = User::where('id',$id)->firstOrFail();
        $this->client_id = $item->id;
        $this->name = $item->name;
        $this->email = $item->email;
        $this->tel = $item->tel;
        $this->profil_id = $item->profil_client_id;
    }

    public function editClient(){
//dd("test");
        User::where('id', $this->client_id)
            ->update([
                'name' => $this->name,
                'email' => $this->email,
                'tel' => $this->tel,
                'profil_client_id' => $this->profil_id,
            ]);+

        session()->flash('message', 'Client "'.$this->name.'" à été modifié');
        /* return redirect()->to('/depots'); */
        $this->emit('saved');
    }

    public function deleteClient($id)
    {

        $client = User::findOrFail($id);
        $client->delete();
        session()->flash('message', 'Client "'.$client->name.'" à été supprimé');
    }

    public function render()
    {

        $items = User::query()
        ->where('type','client')
        ->where('name','ilike','%'.$this->search.'%')
        ->orderBy($this->sortBy, $this->sortDirection)
        ->paginate($this->perPage);

        return view('livewire.parametrage.liste-clients',[
            'items'=> $items
        ]);
    }
    public function saved()
    {
        return $this->render();
    }

}
