<?php

namespace App\Http\Livewire\Parametrage;

use App\Models\Livreur;
use App\Models\Ville;
use Livewire\Component;

class Livreurs extends Component
{

    public $nom;
    public $cin;
    public $phone;
    public $type;
    public $ville_id;
    public $list_villes;

    public $isActive = false;

    public function mount(){
        $this->list_villes = Ville::all()->sortBy('nom');
    }


    protected $rules = [
        'nom' => 'required',
        'cin' => 'required',
        'phone' => 'required',
        'ville_id' => 'required',
        'type' => 'required',
    ];

    public function createLivreur()
    {
        $this->validate();

        $item = new Livreur();
        $item->nom = $this->nom;
        $item->cin = $this->cin;
        $item->tel = $this->phone;
        $item->type = $this->type;
        $item->ville_id = $this->ville_id;
        $item->active = $this->isActive;
        $item->save();


        session()->flash('message', 'Livreur "' . $this->nom . '" a été crée');
        $this->reset(['nom','cin','phone','ville_id','type','isActive']);

        $this->emit('saved');
    }

    public function render()
    {
        return view('livewire.parametrage.livreurs');
    }
}
