<?php

namespace App\Http\Livewire\Paramétrage;

use App\Models\Site;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class ListeSite extends Component
{
    use WithPagination;

    public $sortBy = 'code';
    public $sortDirection = 'asc';
    public $perPage = 5;
    public $search = '';
    protected $listeners = ['saved'];

    public function render()
    {
        $sites= Site::query()
        ->where('code','ilike','%'.$this->search.'%')
        ->orderBy($this->sortBy, $this->sortDirection)
        ->paginate($this->perPage);

        return view('livewire.paramétrage.liste-site',[
            'sites'=> $sites
        ]);

       // return view('livewire.paramétrage.liste-site', ['list' => $list, 'site' => $site]);
       // return view('livewire.paramétrage.liste-site', ['list' => $list,'site'=> $site]);
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
    public function deleteSite($id)
    {

        $site = Site::findOrFail($id);
        DB::table("sites")->where('id', $id)->delete();
        $site->delete();
        return redirect()->to('/create-site');

    }
    public function saved()
    {
        $this->render();
    }
}
