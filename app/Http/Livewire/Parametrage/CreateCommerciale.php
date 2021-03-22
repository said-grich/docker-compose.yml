<?php

namespace App\Http\Livewire\Parametrage;

use App\Models\Commerciale;
use App\Models\Site;
use Livewire\Component;

class CreateCommerciale extends Component
{
    public $name;
    public $phone;
    public $email;
    public $siteId=[];
    public $activer = false;

    protected $rules = [
        'name' => 'required|min:2',
        'phone' => 'required|min:10',
        'email' => 'required',
        'siteId' => 'required',
    ];

    public function createCommerciale()
    {
        $this->validate();

        $item = new Commerciale();
        $item->name = $this->name;
        $item->phone = $this->phone;
        $item->email = $this->email;
        $item->site_id = $this->siteId;
        $item->activer = $this->activer;
        //dd($item);
        $item->save();

        $this->reset(['name','phone','email','siteId','activer']);

        session()->flash('message', 'Commerciale successfully added.');
        $this->emit('saved');
    }

    public function render()
    {

        $list_sites = Site::all()->sortBy('name');
        return view('livewire.Parametrage.create-commerciale', [ 'list_sites' => $list_sites ]);
    }
}
