<?php

namespace App\Http\Livewire\Parametrage;

use App\Models\Livreur;
use App\Models\Ville;
use Livewire\Component;
use Livewire\WithPagination;

class ListeLivreurs extends Component
{
    use WithPagination;

    public $livreur_id;
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


    public $sortBy = 'nom';
    public $sortDirection = 'asc';
    public $perPage = 10;
    public $search = '';
    protected $listeners = ['saved'];


    public function sortBy($field)
    {
        if ($this->sortDirection == 'asc') {
            $this->sortDirection = 'desc';
        } else {
            $this->sortDirection = 'asc';
        }

        return $this->sortBy = $field;
    }

    public function edit($id){

        $item = Livreur::where('id',$id)->firstOrFail();
        $this->livreur_id =$item->id;
        $this->nom =$item->nom;
        $this->cin =$item->cin;
        $this->phone =$item->tel;
        $this->type =$item->type;
        $this->ville_id =$item->ville_id;
        $this->isActive =$item->active;
    }

    public function editLivreur(){

        Livreur::where('id', $this->livreur_id)
            ->update([
                'nom' => $this->nom,
                'cin' => $this->cin,
                'tel' => $this->phone,
                'type' => $this->type,
                'ville_id' => $this->ville_id,
                'active' => $this->isActive,
            ]);

        session()->flash('message', 'Livreur "'.$this->nom.'" à été modifié');
        //return redirect()->to('/livreurs');
    }

    public function deleteLivreur($id)
    {
        $this->render();
        $livreur = Livreur::findOrFail($id);
        $livreur->delete();
    }

    public function render()
    {
        $items = Livreur::query()
        ->where('nom','ilike','%'.$this->search.'%')
        ->orderBy($this->sortBy, $this->sortDirection)
        ->paginate($this->perPage);

        return view('livewire.parametrage.liste-livreurs',[
            'items'=> $items
        ]);
    }


    public function saved()
    {
        return $this->render();
    }


}
