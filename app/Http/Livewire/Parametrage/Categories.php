<?php

namespace App\Http\Livewire\Parametrage;

use App\Models\Categorie;
use App\Models\SousCategorie;
use Livewire\Component;

class Categories extends Component
{

    public $categorie_name;
    public $sous_categorie_name;
    public $categorie_id;
    public $list_categories;

    protected $listeners = ['categorieAdded' => 'renderCategories'];


    protected $rules = [
        'categorie_name' => 'required',
        'categorie_name' => 'required',
    ];

    public function renderCategories()
    {
        $this->list_categories = Categorie::all()->sortBy('nom');
    }

    /* public function mount(){
        $this->list_categories = Categorie::all();
    } */

    public function createCategorie()
    {
        //$this->validate();

        $item = new Categorie();
        $item->nom = $this->categorie_name;
        $item->save();

        session()->flash('message', 'Catégorie "'.$this->categorie_name. '" a été créée ');
        $this->reset(['categorie_name']);

        $this->emit('saved');
    }

    public function createSousCategorie()
    {
        //$this->validate();
        $souscategorie = SousCategorie::where('nom', $this->sous_categorie_name)
                                        ->where('categorie_id', $this->categorie_id)
                                        ->first();
        if ($souscategorie === null) {
            $item = new SousCategorie();
            $item->nom = $this->sous_categorie_name;
            $item->categorie_id = $this->categorie_id;
            $item->save();

            $categorie = Categorie::findOrFail($this->categorie_id);
            session()->flash('message', 'Sous catégorie "' . $this->sous_categorie_name . '" a été créée dans la catégorie ' . $categorie->nom);
            $this->reset(['sous_categorie_name','categorie_id']);

            $this->emit('saved');

        }else {
            session()->flash('message', 'Sous catégorie "' . $this->sous_categorie_name . '" est déja existe ');
        }
/*
        $item = new SousCategorie();
        $item->nom = $this->sous_categorie_name;
        $item->categorie_id = $this->categorie_id;
        $item->save(); */


    }



    public function render()
    {
        $this->renderCategories();

        return view('livewire.parametrage.categories');
    }
}
