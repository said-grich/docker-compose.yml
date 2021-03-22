<?php

namespace App\Http\Livewire\Parametrage;

use App\Models\Caisse;
use App\Models\Site;
use Livewire\Component;

class EditCaisse extends Component
{
    public $code_comptable_caisse;
    public $name;
    public $adresse;
    public $siteId;
    public $caisse;
    public $ida;

    protected $rules = [
        'name' => 'required',
        'adresse' => 'required',
        'siteId' => 'required',
    ];

    public function mount()
    {
        $this->ida = request()->ida;
        $this->caisse = Caisse::findOrFail($this->ida);
        $this->code_comptable_caisse= $this->caisse->code_comptable_caisse;
        $this->name= $this->caisse->name;
        $this->adresse= $this->caisse->adresse;
        $this->siteId= $this->caisse->site_id;
    }

    public function editCaisse()
    {

            $this->caisse->code_comptable_caisse = $this->code_comptable_caisse;
            $this->caisse->name = $this->name;
            $this->caisse->adresse = $this->adresse;
            $this->caisse->site_id =$this->siteId;
            $this->caisse->save();

            return redirect()->to('/create-caisse');

    }

    public function render()
    {
        $list_sites = Site::all()->sortBy('name');
        return view('livewire.Parametrage.edit-caisse', [ 'list_sites' => $list_sites ]);
    }
}
