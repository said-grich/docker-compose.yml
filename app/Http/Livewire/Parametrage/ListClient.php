<?php

namespace App\Http\Livewire\Parametrage;

use App\Models\Client;
use Livewire\Component;
use Livewire\WithPagination;
class ListClient extends Component
{
    use WithPagination;

    public $sortBy = 'name';
    public $sortDirection = 'asc';
    public $perPage = 5;
    public $search = '';
    protected $listeners = ['saved'];

    public function render()

    {
        $clients = Client::query()
        ->where('name','ilike','%'.$this->search.'%')
        ->orderBy($this->sortBy, $this->sortDirection)
        ->paginate($this->perPage);

        return view('livewire.Parametrage.list-client',[
            'clients'=> $clients
        ]);
        /*$clients = Client::all()->sortByDesc('created_at');
        // dd($client);
        return view('livewire.Parametrage.list-client', [ 'clients' => $clients ]);*/

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
    public function delete($id)
    {
        // dd(Client::find($id));
        Client::find($id)->delete();
    }



}
