<?php

namespace App\Http\Livewire\Parametrage;

use App\Models\Fournisseur;
use Livewire\Component;

class Fournisseurs extends Component
{
    public $nom;
    public $phone;
    public $contact;

    public $inputs = [];
    public $i = 0;



    protected $rules = [
        'nom' => 'required|min:2',
        'phone' => 'required|min:2',
        'contact' => 'required|min:2',
    ];

    public function add()
    {
        $this->i++;
        array_push($this->inputs, $this->i);
        //dd($this->inputs);

    }


    public function createFournisseur()
    {
        $this->validate();

        $item = new Fournisseur();
        $item->nom = $this->nom;
        $item->tel = $this->phone;
        $item->contact = $this->contact;
        $item->save();

        session()->flash('message', 'Fournisseur "'.$this->nom. '" a été crée ');

        $this->reset(['nom','phone','contact']);

        $this->emit('saved');
    }

    public function render()
    {
        return view('livewire.parametrage.fournisseurs');
    }
}
