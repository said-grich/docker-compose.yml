<?php

namespace App\Http\Livewire\Paramétrage;

use App\Models\Site;
use App\Models\Commerciale;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

use Livewire\WithPagination;

class ListeCommerciale extends Component
{
    use WithPagination;

    public $sortBy = 'name';
    public $sortDirection = 'asc';
    public $perPage = 5;
    public $search = '';
    protected $listeners = ['saved'];

    public function render()
    {
        $commerciale = Commerciale::query()
        ->where('name','ilike','%'.$this->search.'%')
        ->orderBy($this->sortBy, $this->sortDirection)
        ->paginate($this->perPage);
        $sites = [];
        //dd($list);

        foreach($commerciale as $l){
            foreach($l->site_id as $key => $value){
                $commercialeSites[$key] = DB::table('sites')
                ->where('id', $value)->get();
                $l->sites =$commercialeSites;

            }
            $commercialeSites = array();
        }
        return view('livewire.paramétrage.liste-commerciale',[
            'commerciale'=> $commerciale ,'sites' => $sites
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
    public function deleteCommerciale($id)
    {

        $commerciale = Commerciale::findOrFail($id);
        DB::table("commerciales")->where('id', $id)->delete();
        $commerciale->delete();



        return redirect()->to('/create-commerciale');

    }



    public function saved()
    {
        $this->render();
    }
    /*public function getAllSites($id){
        DB::table('sites')
            ->where('id', $id)->get();
    }*/


}
