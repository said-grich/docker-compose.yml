<?php

namespace App\Http\Livewire\Parametrage;

use App\Models\Client;
use Livewire\Component;
use Livewire\WithPagination;

class ListeClients extends Component
{
    use WithPagination;

    public $sortBy = 'nom';
    public $sortDirection = 'asc';
    public $perPage = 5;
    public $search = '';
    protected $listeners = ['saved'];

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

    public function deleteClient($id)
    {

        $client = Client::findOrFail($id);
        //DB::table("fournisseurs")->where('id', $id)->delete();

        $client->delete();
        session()->flash('message', 'Client "'.$client->nom.'" à été supprimé');

        //return redirect()->to('/familles');

    }

    public function saved()
    {
        $this->render();
    }

}
