<?php

namespace App\Http\Livewire\Paramétrage;

use App\Models\Caisse;
use App\Models\Site;
use Livewire\Component;

class CreateCaisse extends Component
{

    public $code_comptable_caisse;
    public $name;
    public $adresse;
    public $siteId;

    protected $rules = [
        'name' => 'required',
        'adresse' => 'required',
        'siteId' => 'required|min:1',
    ];

    public function createCaisse()
    {
        $this->validate();

        $item = new Caisse();
        $item->code_comptable_caisse = $this->code_comptable_caisse;
        $item->name = $this->name;
        $item->adresse = $this->adresse;
        $item->site_id = $this->siteId;
        $item->save();

        $this->reset(['name','code_comptable_caisse','adresse','siteId']);

        $this->emit('saved');
    }

    public function render()
    {
        $list_sites = Site::all()->sortBy('name');
        return view('livewire.paramétrage.create-caisse', [ 'list_sites' => $list_sites ]);
    }
}
