<?php

namespace App\Http\Livewire\Parametrage;

use App\Models\Client;
use App\Models\ProfilClient;
use Livewire\Component;

class Clients extends Component
{
    public $profil_name;
    public $client_name;
    public $phone;
    public $email;
    public $profil_client;
    public $list_profils;

    protected $listeners = ['profilAdded' => 'renderProfilesClients'];


    /* protected $rules = [
        'categorie_name' => 'required',
        'categorie_name' => 'required',
    ]; */

    public function renderProfilesClients()
    {
        $this->list_profils = ProfilClient::all()->sortBy('id');
    }


    public function createProfileClient()
    {
        //$this->validate();

        $item = new ProfilClient();
        $item->nom = $this->profil_name;
        $item->save();



        $this->dispatchBrowserEvent('swal:modal',
            [
                'title' => "success",
                'title' => 'Profile "'.$this->profil_name. '" a été crée',
                'text' => "",
            ]);



        session()->flash('message', 'Profile "'.$this->profil_name. '" a été crée ');
        $this->reset(['profil_name']);

        $this->emit('saved');
    }

    public function createClient()
    {
        //$this->validate();

        $item = new Client();
        $item->nom = $this->client_name;
        $item->tel = $this->phone;
        $item->email = $this->email;
        $item->password = bcrypt('password');
        $item->profil_client_id = $this->profil_client;
        $item->save();

        $profil = ProfilClient::findOrFail($this->profil_client);
        session()->flash('message', 'Client "' . $this->client_name . '" a été crée comme étant un client ' . $profil->nom);
        $this->reset(['client_name','phone', 'email','profil_client']);

        $this->emit('saved');
    }



    public function render()
    {
        $this->renderProfilesClients();
        return view('livewire.parametrage.clients');
    }
}
