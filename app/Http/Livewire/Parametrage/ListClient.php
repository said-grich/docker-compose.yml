<?php

namespace App\Http\Livewire\Parametrage;

use App\Models\Client;
use App\Models\ProfilClient;
use Livewire\Component;
use Livewire\WithPagination;
class ListClient extends Component
{
    use WithPagination;

    public $client_id;
    public $nom;
    public $tel;
    public $email;
    public $profil_id;
    public $list_profils;

    public $sortBy = 'name';
    public $sortDirection = 'asc';
    public $perPage = 5;
    public $search = '';
    protected $listeners = ['saved'];

    public function mount(){
        $this->list_profils = ProfilClient::all()->sortBy('nom');
    }

    public function render()

    {
        $clients = Client::query()
        ->where('name','ilike','%'.$this->search.'%')
        ->orderBy($this->sortBy, $this->sortDirection)
        ->paginate($this->perPage);

        return view('livewire.Parametrage.list-client',[
            'clients'=> $clients
        ]);
    }

    public function sortBy($field){

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
        $this->profil_id =$item->profil_id;
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

    public function delete($id)
    {
        // dd(Client::find($id));
        Client::find($id)->delete();
    }



}
