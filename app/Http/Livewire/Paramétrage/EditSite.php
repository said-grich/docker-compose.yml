<?php

namespace App\Http\Livewire\Paramétrage;

use App\Models\Site;
use Livewire\Component;

class EditSite extends Component
{

    public $code;
    public $name;
    public $adresse;
    public $ville;
    public $pays;
    public $site;
    public $ida;


    protected $rules = [
        'code' => 'required|min:2',
        'name' => 'required',
        'adresse' => 'required',
        'ville' => 'required',
        'pays' => 'required',
    ];

    public function mount()
    {
        $this->ida = request()->ida;
        $this->site = Site::findOrFail($this->ida);
        $this->code= $this->site->code;
        $this->name= $this->site->name;
        $this->adresse= $this->site->adresse;
        $this->ville= $this->site->ville;
        $this->pays= $this->site->pays;
    }

    public function editSite()
    {

            $this->site->code =$this->code;
            $this->site->name = $this->name;
            $this->site->adresse = $this->adresse;
            $this->site->ville = $this->ville;
            $this->site->pays = $this->pays;
            $this->site->save();

            return redirect()->to('/create-site');

    }


    public function render()
    {
        return view('livewire.paramétrage.edit-site');
    }
}
