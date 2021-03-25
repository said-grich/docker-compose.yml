<?php

namespace App\Http\Livewire\Parametrage;

use App\Models\Fournisseur;
use App\Models\FournisseurContact;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Fournisseurs extends Component
{
    public $nom;
    public $tel;
    public $contact;

    public $contact_tel = [];
    public $contact_email = [];
    public $contact_fonction = [];
    public $contact_nom = [];


    public $inputs = [];
    public $i = 0;



    protected $rules = [
        'nom' => 'required|min:2',
        'tel' => 'required|email|min:2',
    ];

    public function add()
    {
        $this->i++;
        array_push($this->inputs, $this->i);
        //dd($this->inputs);

    }

    public function remove($i)
    {
        array_splice($this->inputs, $i - 1, 1);
        $this->i--;
    }




    public function createFournisseur()
    {

        //$this->validate();
        DB::transaction(function () {

            $fournisseur = new Fournisseur();
            $fournisseur->nom = $this->nom;
            $fournisseur->tel = $this->tel;
            $fournisseur->save();

            foreach ($this->contact_tel as $key => $value) {
                FournisseurContact::create([
                    'nom'=> $this->contact_nom[$key],
                    'tel'=> $this->contact_tel[$key],
                    'email'=> $this->contact_email[$key],
                    'fonction'=> $this->contact_fonction[$key],
                    'fournisseur_id'=> $fournisseur->id,
                ]);
            }

        });



        session()->flash('message', 'Fournisseur "'.$this->nom. '" a été crée ');

        $this->reset(['nom','tel','contact_nom','contact_tel','contact_email','contact_fonction']);

        $this->emit('saved');
    }

    public function render()
    {
        return view('livewire.parametrage.fournisseurs');
    }
}
