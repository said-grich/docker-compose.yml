<?php

namespace App\Http\Livewire\Parametrage;

use App\Models\Livraison;
use App\Models\Ville;
use Livewire\Component;
use Livewire\WithPagination;

class ListeLivraison extends Component
{

    use WithPagination;

    public $ville;
    public $heure;
    public $seuil_commande;
    public $seuil_livraison_gratuite;
    public $frais_livraison;
    public $jours_livraison = [];
    public $active = false;
    public $jours=[];

    public $Livraison_id;
    public $liste_villes = [];


    public $sortBy = 'ville_id';
    public $sortDirection = 'asc';
    public $perPage = 10;
    public $search = '';
    protected $listeners = ['saved'];



    public function render()
    {
        $items = Livraison::query()
        ->where('ville_id','ilike','%'.$this->search.'%')
        ->orderBy($this->sortBy, $this->sortDirection)
        ->paginate($this->perPage);

        return view('livewire.parametrage.liste-livraison',[
            'items'=> $items
        ]);
    }

    public function sortBy($field)
    {
        if ($this->sortDirection == 'asc') {
            $this->sortDirection = 'desc';
        } else {
            $this->sortDirection = 'asc';
        }

        return $this->sortBy = $field;
    }
    public function  mount(){
        $this->liste_villes = Ville::all();
        $this->jours = ['Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi','Dimanche'];
    }

    public function edit($id){
        $item = Livraison::where('id',$id)->firstOrFail();

        $this->Livraison_id =$item->id;
        $this->frais_livraison =$item->frais_livraison;
        $this->seuil_livraison_gratuite =$item->seuil_livraison_gratuite;
        $this->seuil_commande =$item->seuil_commande;
        $this->heure =$item->heure;
        $this->jours_livraison =$item->jours_livraison;
        $this->ville =$item->ville_id;
        $this->active =$item->active;

    }

    public function editLivraison(){

        Livraison::where('id', $this->Livraison_id)
            ->update([
                'frais_livraison' => $this->frais_livraison,
                'seuil_livraison_gratuite' => $this->seuil_livraison_gratuite,
                'seuil_commande' => $this->seuil_commande,
                'heure' => $this->heure,
                'jours_livraison' => $this->jours_livraison,
                'ville_id' => $this->ville,
                'active' => $this->active,
            ]);

            session()->flash('message', 'Livraison a éte crée');

        }


    public function deleteLivraison($id)
    {
        $this->render();
        $livraison = Livraison::findOrFail($id);
        $livraison->delete();
    }

    public function saved()
    {
        return $this->render();
    }

}
