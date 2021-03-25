<?php

namespace App\Http\Livewire\Parametrage;

use App\Models\Client;
use App\Models\ProfilClient;
use Livewire\Component;
use Livewire\WithPagination;

class ListeClients extends Component
{
    use WithPagination;

    public $client_id;
    public $nom;
    public $phone;
    public $email;
    public $profil_id;
    public $list_profils;

    public $sortBy = 'nom';
    public $sortDirection = 'asc';
    public $perPage = 5;
    public $search = '';
    protected $listeners = ['saved'];

    public function mount(){
        $this->list_profils = ProfilClient::all()->sortBy('nom');
    }

    public function render()
    {

        $items = Client::query()
        ->where('nom','ilike','%'.$this->search.'%')
        ->orderBy($this->sortBy, $this->sortDirection)
        ->paginate($this->perPage);

        return view('livewire.parametrage.liste-clients',[
            'items'=> $items
        ]);
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

        $item = Client::where('id',$id)->firstOrFail();
        $this->client_id =$item->id;
        $this->nom =$item->nom;
        $this->email =$item->email;
        $this->phone =$item->tel;
        $this->profil_id =$item->profil_id;
    }

    public function editClient(){

        Client::where('id', $this->client_id)
            ->update([
                'nom' => $this->nom,
                'email' => $this->email,
                'tel' => $this->tel,
                'profil_client_id' => $this->profil_id,
            ]);

        session()->flash('message', 'Dépôt "'.$this->nom.'" à été modifié');
        return redirect()->to('/depots');
    }

    public function deleteClient($id)
    {

        $client = Client::findOrFail($id);
        $client->delete();
        session()->flash('message', 'Client "'.$client->nom.'" à été supprimé');
    }

    public function saved()
    {
        $this->render();
    }

}
