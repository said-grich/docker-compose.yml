<?php

namespace App\Http\Livewire\Paramétrage;

use App\Models\Depot;
use App\Models\Site;
use Livewire\Component;

class EditDepot extends Component
{

    public $code;
    public $name;
    public $siteId;
    public $adresse;
    public $ville;
    public $pays;
    public $mode_stockage;
    public $sites_locataires;
    public $depot;
    public $ida;

    protected $rules = [
        'code' => 'required|min:2',
        'name' => 'required',
        'siteId' => 'required',
        'adresse' => 'required',
        'ville' => 'required',
        'pays' => 'required',
    ];

    public function mount()
    {
        $this->ida = request()->ida;
        $this->depot = Depot::findOrFail($this->ida);
        $this->code= $this->depot->code;
        $this->name= $this->depot->name;
        $this->siteId= $this->depot->site_id;
        $this->adresse= $this->depot->adresse;
        $this->ville= $this->depot->ville;
        $this->pays= $this->depot->pays;
        $this->mode_stockage= $this->depot->mode_stockage;
        $this->sites_locataires= $this->depot->sites_locataires;
    }

    public function editDepot()
    {

            $this->depot->code =$this->code;
            $this->depot->name = $this->name;
            $this->depot->site_id =$this->siteId;
            $this->depot->adresse = $this->adresse;
            $this->depot->ville = $this->ville;
            $this->depot->pays = $this->pays;
            $this->depot->mode_stockage = $this->mode_stockage;
            $this->depot->sites_locataires = $this->sites_locataires;
            $this->depot->save();

            return redirect()->to('/create-depot');

    }

    public function render()
    {
        $list_sites = Site::all()->sortBy('name');

        $list_sites_locataires = Site::where('id', '!=',$this->siteId)->get()->sortBy('name');
        return view('livewire.paramétrage.edit-depot', [ 'list_sites' => $list_sites, 'list_sites_locataires' => $list_sites_locataires ]);
    }
}
