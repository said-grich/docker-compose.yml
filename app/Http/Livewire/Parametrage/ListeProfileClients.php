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
    public $perPage = 5;
    public $search = '';
    protected $listeners = ['saved'];

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
    public function sortBy($field)
    {
        if ($this->sortDirection == 'asc') {
            $this->sortDirection = 'desc';
        } else {
            $this->sortDirection = 'asc';
        }

        return $this->sortBy = $field;
    }

    public function deleteProfileClient($id)
    {

        $profile = ProfilClient::findOrFail($id);
        //DB::table("fournisseurs")->where('id', $id)->delete();

        $profile->delete();
        session()->flash('message', 'Profile client "'. $profile->nom.'" à été supprimé');

        //return redirect()->to('/familles');

    }

    public function saved()
    {
        $this->render();
    }

}
