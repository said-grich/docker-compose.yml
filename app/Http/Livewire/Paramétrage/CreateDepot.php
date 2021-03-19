<?php

namespace App\Http\Livewire\Paramétrage;

use App\Models\Depot;
use App\Models\Site;
use Livewire\Component;

class CreateDepot extends Component
{

    public $code;
    public $name;
    public $siteId;
    public $adresse;
    public $ville;
    public $pays;
    public $mode_stockage;
    public $sites_locataires;
    //public $phone;
    public $mobile = false;

    protected $rules = [
        'code' => 'required|min:2',
        'name' => 'required',
        'siteId' => 'required|min:1',
        'adresse' => 'required',
        'ville' => 'required',
        'pays' => 'required',
        //'phone' => 'required',
        //'activer' => 'required',
    ];


    public function createDepot()
    {
        $this->validate();

        $item = new Depot();
        $item->code = $this->code;
        $item->name = $this->name;
        $item->site_id = $this->siteId;
        $item->adresse = $this->adresse;
        $item->ville = $this->ville;
        $item->pays = $this->pays;
        $item->mode_stockage = $this->mode_stockage;
        $item->sites_locataires = $this->sites_locataires;


        //$item->phone = $this->phone;
        $item->mobile = $this->mobile;
        $item->save();

        $this->reset(['code', 'name','adresse','ville','pays','mode_stockage','siteId','mobile','sites_locataires']);

        $this->emit('saved');
    }

    public function render()
    {
        $list_sites = Site::all()->sortBy('name');
        $list_sites_locataires = Site::where('id', '!=',$this->siteId)->get()->sortBy('name');
        return view('livewire.paramétrage.create-depot', [ 'list_sites' => $list_sites, 'list_sites_locataires' => $list_sites_locataires  ]);
    }
}
