<?php

namespace App\Http\Livewire\Parametrage;

use App\Models\Livraison as ModelsLivraison;
use App\Models\Ville;
use Livewire\Component;

class Livraison extends Component
{
    public $liste_villes = [];
    public $ville;
    public $heure;
    public $seuil_commande;
    public $seuil_livraison_gratuite;
    public $frais_livraison;
    public $jours=[];
    public $jours_livraison = [];
    public $active = false;

    public function renderData()
    {
        $this->liste_villes = Ville::all()->sortBy('nom');
        $this->jours = ['Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi','Dimanche'];
    }

    public function createLivraison()
    {

        $this->validate([
            'seuil_commande' => 'required',
            'seuil_livraison_gratuite' => 'required',
            'frais_livraison' => 'required',
            'heure' => 'required',
            'jours_livraison' => 'required',
            'ville' => 'required',
        ]);

        $livraison = new ModelsLivraison();
        $livraison->seuil_commande = $this->seuil_commande;
        $livraison->seuil_livraison_gratuite = $this->seuil_livraison_gratuite;
        $livraison->frais_livraison = $this->frais_livraison;
        $livraison->heure = $this->heure;
        $livraison->jours_livraison = $this->jours_livraison;
        $livraison->ville_id = $this->ville;
        $livraison->active = $this->active;
        $livraison->save();

        $this->emit('saved');

        session()->flash('message', 'Livraison a éte crée');
        $this->reset(['seuil_commande','seuil_livraison_gratuite', 'frais_livraison', 'heure', 'jours_livraison', 'ville', 'active']);
    }

    public function render()
    {
        $this->renderData();
        return view('livewire.parametrage.livraison');
    }
}
