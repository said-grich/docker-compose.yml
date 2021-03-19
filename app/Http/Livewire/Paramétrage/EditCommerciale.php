<?php

namespace App\Http\Livewire\Paramétrage;

use App\Models\Commerciale;
use App\Models\Site;
use Livewire\Component;

class EditCommerciale extends Component
{

    public $name;
    public $phone;
    public $email;
    public $siteId=[];
    public $ida;

    protected $rules = [
        'name' => 'required|min:2',
        'phone' => 'required|min:10',
        'email' => 'required',
        'siteId' => 'required',

    ];

    public function mount()
    {
        $this->ida = request()->ida;
        $commerciale = Commerciale::findOrFail($this->ida);
        $this->name= $commerciale->name;
        $this->phone= $commerciale->phone;
        $this->name= $commerciale->name;
        $this->siteId= $commerciale->site_id;
    }

    public function editCommerciale()
    {

            $commerciale = Commerciale::findOrFail($this->ida);
            $commerciale->name = $this->name;
            $commerciale->phone = $this->phone;
            $commerciale->email =$this->email;
            $commerciale->site_id =$this->siteId;



            $commerciale->save();

            return redirect()->to('/create-commerciale');

    }


    public function render()
    {
        $list_sites = Site::all()->sortBy('name');
        return view('livewire.paramétrage.edit-commerciale', [ 'list_sites' => $list_sites ]);
    }
}
